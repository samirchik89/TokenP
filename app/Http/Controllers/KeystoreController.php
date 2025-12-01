<?php

namespace App\Http\Controllers;

use App\KeystoreModel;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\BlockchainModel as Blockchain;


class KeystoreController extends Controller
{

    /**
     * Show all keystores.
     */
    public function index()
    {
        $user = auth()->user();
        // Retrieve keystores with simple pagination for the authenticated user
        $keystores = KeystoreModel::where('user_id', $user->id)->simplePaginate(10);
        $blockchains = Blockchain::all()->toArray();
        return view('issuer.keystore.index', compact('keystores','blockchains'));
    }


    public function retrieve($id, Request $request)
    {
        try {
            $user = auth()->user();
    
            $keystore = KeystoreModel::where('id', $id)->where('user_id', $user->id)->first();
    
            if (!$keystore) {
                return back()->with('error', 'Keystore not found.');
            }
    
            $password = $request->input('password');
            $isPassCorrect = $keystore->verifyPassword($password);
    
            if (!$isPassCorrect) {
                return back()->with('error', 'Incorrect password.');
            }
    
            $data = [
                "filename" => $keystore->keystore_file_path,
                "password" => $password,
            ];
    
            $result = callNodeOperations('read', $data);
    
            if (isset($result['status']) && $result['status'] === 'success') {
                return back()->with([
                    'success' => 'Private key retrieved successfully.',
                    'private_key' => $result['privatekey'],
                ]);
            }
    
            return back()->with('error', 'Failed to retrieve private key.');
        } catch (\Throwable $e) {
            logException($e, [
                'keystore_id' => $id,
                'user_id' => auth()->id(),
            ]);
    
            return back()->with('error', 'Something went wrong while retrieving the private key.');
        }
    }
    


    /**
     * Store a new keystore.
     */
    public function create(Request $request)
    {
        $user = auth()->user();
    
        // Handle validation (Laravel will redirect back with errors if this fails)
        $method = $request->input('method');
    
        // Base validation rules
        $rules = [
            'title' => 'required|string|max:255',
        ];
    
        if ($method === 'manual') {
            $rules['private_key'] = 'required|string';
            $rules['password'] = 'required|string|min:6';
        } elseif ($method === 'generate') {
            $rules['generate_password'] = 'required|string|min:6';
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid method selected.']);
        }
    
        $validated = $request->validate($rules);
    
        try {
            // Generate private key if method is 'generate'
            if ($method === 'generate') {
                $result = callNodeOperations('generate');
                if (!isset($result['privateKey']) || !isset($result['address'])) {
                    return redirect()->back()->withErrors(['error' => 'Failed to generate private key.']);
                }
    
                $validated['private_key'] = $result['privateKey'];
                $validated['password'] = $validated['generate_password'];
                $validated['address'] = $result['address'];
            }
    
            // Save keystore file
            $result = $this->createAndSavekeyStoreFile($validated);
    
            // Save to DB
            KeystoreModel::create([
                'user_id' => $user->id,
                'title' => $validated['title'],
                'keystore_file_path' => $result['filename'],
                'encrypted_password' => $validated['password'],
                'public_address' => $result['address'],
            ]);
    
            $message = $method === 'generate'
                ? "Private key generated successfully!<br><strong>Private Key:</strong> {$validated['private_key']}<br><strong>Address:</strong> {$result['address']}"
                : "Key created successfully!";
    
            return redirect()->back()->with('success', $message);
    
        } catch (\Throwable $e) {
            logException($e, [
                'user_id' => auth()->id(),
                'method' => $request->input('method'),
            ]);
            return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again later.']);
        }
    }
    


    /**
     * Update the keystore title.
     */
    public function edit($id, Request $request)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
            ]);
    
            // Find and update
            $keystore = KeystoreModel::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
    
            $keystore->update(['title' => $validated['title']]);
            
            return back()->with('success', 'Keystore updated successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    

    /**
     * Delete the specified keystore.
     */
    public function destroy($id)
    {
        // Find and delete the keystore
        $keystore = KeystoreModel::findOrFail($id);
        $keystore->delete();

        // Redirect or return a success response
        return redirect()->route('keystores.index')->with('success', 'KeystoreModel deleted successfully!');
    }

    /**
     * Display a specific keystore that belongs to the logged-in user.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, $id)
    {
        $userId = auth()->id(); 
        $password = $request->query('password'); 

        // Check if password was provided
        if (!$password) 
            return redirect()->route('keystores.index')->with('error', 'Password is required to view this keystore.');
        
        $keystore = KeystoreModel::where('id', $id)->where('user_id', $userId)->first();

        if (!$keystore) 
            return redirect()->route('keystores.index')->with('error', 'KeystoreModel not found or unauthorized access.');
        
        if (!$keystore->verifyPassword($password)) 
            return redirect()->route('keystores.index')->with('error', 'Incorrect password.');
        
        try {
            // Attempt to decrypt and retrieve private key
            $privateKey = $this->retrieveAndDecryptKeystore($userId, $keystore->title, $password);
        } catch (\Exception $e) {
            return redirect()->route('keystores.index')->with('error', 'Incorrect password or corrupted keystore.');
        }

        // Show the keystore detail view
        return view('keystores.show', compact('keystore'));
    }
    public function createAndSaveKeyStoreFile($data)
    {
      
        $privateKey = $data['private_key'];
        $response =callNodeOperations('getPublicKey', ['privateKey' => $privateKey]);
        if(!isset($response['publicAddress']) || empty($response['publicAddress'])){
            throw new \Exception("Node Error for getPublicKey Operation");
        }
        $data['privatekey'] = $privateKey; 
        $data['address'] = $response['publicAddress'];

        $saveResponse = callNodeOperations('save', $data);
        if(!isset($saveResponse['filename']) || empty($saveResponse['filename'])){
            throw new \Exception("Node Error for Keystore file save");
        }
        return [
            'filename' => $saveResponse['filename'],
            'address' => $data['address'],
        ];
    }
    
    public function generate()
    {
        $data = callNodeOperations('generate');
        return $data;
    }


    public function getForm(){
        return  view('issuer.keystore.create');
    }

    public function retrieveForm(Request $request)
    {
        $user = auth()->user();
    
        $keystore = KeystoreModel::where('user_id', $user->id)
            ->where('id', $request->id)
            ->first();
    
        return view('issuer.keystore.retrieve', compact('keystore'));
    }
    

    public function editForm(Request $request)
    {
        $user = auth()->user();
    
        $keystore = KeystoreModel::where('user_id', $user->id)
            ->where('id', $request->id)
            ->firstOrFail();
    
        return view('issuer.keystore.edit', compact('keystore'));
    }
    
    
}
