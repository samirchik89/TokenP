<?php

namespace App\Http\Controllers\Resource;


use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Exception;
use Storage;
use Setting;
use Auth;
use App\User;
use App\UserDetails;
use App\UserCompanyDetails;

class UserResource extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('demo', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type)
    {
        try {
            $users = User::getUser();

            if($request->ajax()){
                if($type == 'Issuer'){
                    $users = User::where('user_type',2)->get();    
                }elseif ($type == 'Investor') {
                    $users = User::where('user_type',1)->get();
                }elseif($type == 'All'){
                    $users = User::getUser();
                }
                return response()->json(['users'=>$users]);
            }
            return view('admin.user.index', compact('users'));
        } catch (\Throwable $th) {
            \Log::info($th);
            return back()->with('flash_error', 'Unable to get user details');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:users,email|email|max:255',
            'mobile' => 'digits_between:6,13|regex:/^[0-9+]+$/u',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:70000',
            'password' => 'required|min:6|confirmed',
        ]);
        try {

            $user = $request->all();

            $user['payment_mode'] = 'CASH';
            $user['password'] = bcrypt($request->password);
            if ($request->hasFile('picture')) {
                $user['picture'] = $request->picture->store('user/profile');
            }

            $user = User::create($user);

            return back()->with('flash_success', 'User Details Saved Successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'User Not Found');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::getUser($id);
            return view('admin.user.user-details', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = User::getUser($id);
            return view('admin.user.edit', compact('user'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'mobile' => 'digits_between:6,13|regex:/^[0-9+]+$/u',
            'picture' => 'mimes:jpeg,jpg,bmp,png|max:70000',
        ]);
        try {
            $user = User::getUser($id);
            if ($request->hasFile('picture')) {
                Storage::delete($user->picture);
                $user->picture = $request->picture->store('user/profile');
            }

            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->mobile = $request->mobile;
            $user->save();

            return redirect()->route('admin.user.index')->with('flash_success', 'User Updated Successfully');
        } catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'User Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            User::getUser($id)->delete();
            return back()->with('message', 'User deleted successfully');
        } catch (Exception $e) {
            return back()->with('flash_error', 'User Not Found');
        }
    }

    public function details($id)
    {
        try {
            $user = User::getUser($id);
            $user_detail = UserDetails::where('user_id', $id)->first();
            $user_detail_company = UserCompanyDetails::where('user_id', $id)->first();
            return view('admin.user.details', compact('user', 'user_detail', 'user_detail_company'));
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->with('flash_error', 'Something Went Wrong!');
        }
    }
}
