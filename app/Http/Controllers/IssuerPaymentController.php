<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IssuerBankAccounts;
use App\UserContract;
use App\BlockchainModel as Blockchain;
use App\BlockchainStablecoin;
use App\Stablecoin;
use App\IssuerStablecoinWalletAddress;


class IssuerPaymentController extends Controller
{
    public function index(Request $request){
        $user = Auth()->user();

        // Get all active contracts (assets) for this issuer
        $contracts = UserContract::with('property')
            ->where('issued_by', $user->id)
            ->where('status', 1)
            ->get();

        // Determine the selected asset ID
        $selectedAssetId = $request->input('asset_id');
        if (!$selectedAssetId && $contracts->isNotEmpty()) {
            // Default to the first asset if none is selected
            $selectedAssetId = $contracts->first()->id;
        }

        // Get banks for the selected asset
        $banks = IssuerBankAccounts::where('issuer_id', $user->id)
            ->where('user_contract_id', $selectedAssetId)
            ->simplePaginate(10);

        // $banks = IssuerBankAccounts::where('issuer_id', $user->id)->simplePaginate(10);

        return view('issuer.payments.show', compact('banks','contracts','selectedAssetId'));
    }


    public function cryptoIndex(Request $request)
    {
        try {
            $issuerId = auth()->user()->id;

            // Get all active contracts for this issuer
            $contracts = UserContract::with('property')
                ->where('issued_by', $issuerId)
                ->where('status', 1)
                ->get();

            // Determine the selected contract ID
            $selectedContractId = $request->input('contract_id');
            if (!$selectedContractId && $contracts->isNotEmpty()) {
                $selectedContractId = $contracts->first()->id;
            }

            // Get all blockchains and group their stablecoins
            $walletTypes = BlockchainStablecoin::with(['stablecoin', 'blockchain'])
                ->get()
                ->groupBy('blockchain_id');

            $blockchains = Blockchain::all();

            // Load saved addresses for the selected contract only
            $savedAddresses = IssuerStablecoinWalletAddress::with([
                    'blockchainStablecoin.blockchain',
                    'blockchainStablecoin.stablecoin'
                ])
                ->where('issuer_id', $issuerId)
                ->where('user_contract_id', $selectedContractId)
                ->get()
                ->keyBy('blockchain_stablecoin_id');

            // Determine selected blockchain ID (default to first blockchain if any)
            $selectedBlockchainId = $request->input('blockchain_id');
            if (!$selectedBlockchainId && !$blockchains->isEmpty()) {
                $selectedBlockchainId = $blockchains->first()->id;
            }

            return view('issuer.payments.crypto-show', compact(
                'contracts',
                'selectedContractId',
                'blockchains',
                'savedAddresses',
                'selectedBlockchainId',
                'walletTypes'
            ));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('flash_error', trans('api.something_went_wrong'));
        }
    }


    public function saveCryptoAddresses(Request $request)
    {
        $request->validate([
            'contract_id'   => 'required|exists:usercontract,id',
            'blockchain_id' => 'required|exists:blockchains,id',
            'addresses'     => 'required|array',
            'addresses.*'   => 'nullable|string',
        ]);

        $issuerId = auth()->user()->id;
        foreach ($request->addresses as $bcStableWalletTypeId => $address) {
            if (!empty($address)) {
                IssuerStablecoinWalletAddress::updateOrCreate(
                    [
                        'issuer_id' => $issuerId,
                        'user_contract_id' => $request->contract_id,
                        'blockchain_stablecoin_id' => $bcStableWalletTypeId,
                    ],
                    [
                        'address' => $address,
                    ]
                );
            } else {
                // If the address is empty, delete existing entry for this stablecoin
                IssuerStablecoinWalletAddress::where('issuer_id', $issuerId)
                    ->where('user_contract_id', $request->contract_id)
                    ->where('blockchain_stablecoin_id', $bcStableWalletTypeId)
                    ->delete();
            }
        }

        return redirect()->route('crypto.payments', [
            'contract_id'   => $request->contract_id,
            'blockchain_id' => $request->blockchain_id
        ])->with('success', 'Wallet addresses saved successfully!');
    }


    public function getForm(){
        $user = Auth()->user();
        $contracts = UserContract::with('property')->where('issued_by',$user->id)->where('status',1)->get();
        return  view('issuer.payments.add-bank',compact('contracts'));
    }

    public function getEditForm($id,Request $req){
        $user = Auth()->user();
        $contracts = UserContract::with('property')->where('issued_by',$user->id)->where('status',1)->get();
        $bank = IssuerBankAccounts::where('issuer_id', $user->id)->where('id',$id)->first();
        return  view('issuer.payments.edit-bank',compact('bank','contracts'));
    }

    public function getView($id){
        $user = Auth()->user();
        $bank = IssuerBankAccounts::where('issuer_id', $user->id)->where('id',$id)->first();
        return  view('issuer.payments.view-bank',compact('bank'));
    }

    public function addBankAccount(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'bank_name'         => 'required|string|max:255',
                'bank_location'     => 'required|string|max:255',
                'bank_address'      => 'required|string',
                'bank_account_name' => 'required|string|max:255',
                'routing_details'   => 'nullable|string|max:100',
                'beneficiary_name'  => 'required|string|max:255',
                'user_contract_id'  => 'required|exists:usercontract,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = auth()->user();
            IssuerBankAccounts::create([
                'issuer_id'        => $user->id,
                'bank_name'        => $request->bank_name,
                'bank_location'    => $request->bank_location,
                'bank_address'     => $request->bank_address,
                'bank_account_name'=> $request->bank_account_name,
                'routing_details'  => $request->routing_details,
                'beneficiary_name' => $request->beneficiary_name,
                'user_contract_id' => $request->user_contract_id
            ]);

            return redirect()->back()->with('flash_success', 'Bank account added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_error', trans('api.something_went_wrong'));
        }
    }

    public function updateBankAccount($id, Request $request){
        try {
            $validator = \Validator::make($request->all(), [
                'bank_name'         => 'required|string|max:255',
                'bank_location'     => 'required|string|max:255',
                'bank_address'      => 'required|string',
                'bank_account_name' => 'required|string|max:255',
                'routing_details'   => 'required|string|max:100',
                'beneficiary_name'  => 'required|string|max:255',
                'user_contract_id'  => 'required|exists:usercontract,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = auth()->user();
            $bank = IssuerBankAccounts::where('issuer_id', $user->id)->where('id', $id)->first();

            if (!$bank) {
                return redirect()->back()->withErrors(['error' => 'Bank account not found.']);
            }

            $bank->update($validator->validated());
            return redirect()->back()->with('flash_success', 'Bank details updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('flash_error', trans('api.something_went_wrong'));
        }
    }


}
