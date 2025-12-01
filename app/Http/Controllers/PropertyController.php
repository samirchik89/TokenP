<?php

namespace App\Http\Controllers;

use App\ManagementMembers;
use Illuminate\Http\Request;
use Setting;
use App\Property;
use App\PropertyLandmark;
use App\PropertyComparable;
use App\PropertyImage;
use App\AssetType;
use App\IssuerTokenRequest;
use App\User;
use App\Bank;
use App\BankDetail;
use App\DepositFiat;
use Exception;
use Auth;
use App\Http\Requests\PropertyRequest;
use App\Http\Requests\AssetFundRequest;
use App\PropertyUpdate;



class PropertyController extends Controller
{
    public function index()
    {
        try {
            $property = Property::with('userContract')->orderBy('created_at', 'desc')->where('propertyType', '!=', null)->where('status', 'active')->latest()->get();
            foreach ($property as $value) {
                if (!empty($value->userContract)  && !empty($value->blockchain)) {
                    $value->contract_address = $value->userContract->contract_address;
                    
                    // Filter the already fetched blockchain collection
                    $url = $value->blockchain->link;
                    $value->contract_link = $url .'token/'. $value->contract_address;
                    $value->coin = $value->blockchain->blockchain_name;
                }
            }
            return view('admin.property.index', compact('property'));
        } catch (Exception $e) {

            return back()->with('flash_error',trans('api.something_went_wrong'));
        }
    }

    public function EditCommission($id){
        try {
            $property = Property::where('id', $id)->first();
            return view('admin.property.edit_commission', compact('property'));
        } catch (\Throwable $th) {
            return back()->with('flash_error',trans('api.something_went_wrong'));
        }
    }

    public function UpdateCommission(Request $request){
        try {
            $property = Property::where('id', $request->id)->first();
            $property->interest = $request->interest;
            $property->save();

            return back()->with('flash_success', 'Commission updated successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error',trans('api.something_went_wrong'));
        }
    }

    public function assetfundList(Request $request)
    {
        try {

            $properties = Property::with('usercontract','blockchain')->orderBy('created_at', 'desc')
                ->where('token_type', $request->type ?? 2)
                ->where('status', 'active')->latest()->get();

            foreach ($properties as $property) {
                if (!empty($property->userContract) && !empty( $property->blockchain)) {
                    $property->contract_address = $property->userContract->contract_address;
                    $url = $property->blockchain->link; 
                    $property->contract_link = $url .'token/'. $property->contract_address;
                    $property->coin = $property->blockchain->blockchain_name;
                }
            }
            $property = $properties;
            $assetTypeId = $request->type ?? 1;
            return view('admin.property.assetList', compact('property','assetTypeId'));
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('api.something_went_wrong')
            );
        }
    }

    public function create()
    {
        try {
            $token_type = \request()->get('type', 'property');
            $users      = User::orderBy('name', 'asc')->where('user_type', 2)->get();
            $assetType  = AssetType::orderBy('type', 'asc')->get();

            if ($token_type == 'asset-fund') {
                return view('admin.property.create_asset_fund', compact('assetType', 'users'));
            } else {
                return view('admin.property.create', compact('assetType', 'users'));
            }
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('api.something_went_wrong')
            );
        }
    }

    public function store(PropertyRequest $request)
    {
        try {
            $user = Auth::user();

            $property = new Property;
            $property = $this->productcrud($property, $request);

            $token = $this->TokenStore($request->all(), $user->id, $property->id);

            return back()->with('flash_success', 'Property created successfully');
        } catch (\Exception $e) {
            \Log::info('Issue in property store' . $e);
            return back()->with('flash_error', 'Unable to Create Property');
        }
    }

    /**
     * Used to store Token
     */
    public function TokenStore($request, $userId, $propertyId)
    {
        // dd($request);
        try {   
            $token                = new IssuerTokenRequest;
            $token->user_id       = $userId;
            $token->property_id   = $propertyId;
            $token->name          = $request['token_name'];
            $token->symbol        = $request['token_symbol'];
            $token->usdvalue      = $request['token_value'];
            $token->decimal       = $request['token_decimal'];
            $token->security_type = 'erc20';
            $token->coin          = $request['token_chain'];
            $token->token_image   = $request['token_image']->store('token_image');

            if ($request['token_type'] == 2) {
                $token->supply = $request['token_supply'];
            } else {
                $token->supply = $request['token_supply']; //$request->total_sft / $request->token_value;
            }
            $token->save();
            return true;
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
    }

    public function edit($id)
    {
        try {
            $property  = Property::with('issuerToken')->where('id', $id)
                ->with(
                    'propertyLandmark',
                    'propertyComparable',
                    'propertyImages'
                )->first();
            $assetType = AssetType::orderBy('type', 'asc')->get();
            if ($property->token_type == 2) {
                return view(
                    'admin.property.edit_asset_fund',
                    compact('property', 'assetType')
                );
            } else {
                return view(
                    'admin.property.edit',
                    compact('property', 'assetType')
                );
            }
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('api.something_went_wrong')
            );
        }
    }

    /**
     * Used to delete Property
     */
    public function destroy($id)
    {
        try {
            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }

            Property::find($id)->delete();

            return back()->with(
                'flash_success',
                'Property deleted successfully'
            );
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('admin.property.not_found')
            );
        }
    }

    public function documentdelete(Request $request)
    {
        try {
            if (Auth::guard('admin')->user()->role == 1) {
                return view('errors.404');
            }

            $property = Property::find($request->id);
            $updatedata = [];
            $updatedata[$request->columnname] = null;
            if ($property) {
                $updatedata[$request->columnname] = null;
                $property->update($updatedata);
                return 1;
            }
        } catch (Exception $e) {
            return 0;
        }
    }


    public function update(Request $request, $id)
    {
        dd($request->all());
        $validationRule = [
            'propertyName'           => 'required|max:200',
            // 'propertyLogo'           => 'required|mimes:jpeg,jpg,bmp,png',
            'expectedIrr'            => 'nullable|min:0|gte:0',
            'initialInvestment'      => 'required|numeric|min:0|gte:0',
            'propertyEquityMultiple' => 'nullable|numeric|min:0|gte:0',
            'holdingPeriod'          => 'required',
            'investor'               => 'nullable|mimes:pdf',
            'titlereport'            => 'nullable|mimes:pdf',
            'termsheet'              => 'nullable|mimes:pdf',
            'propertyManagementTeam' => 'nullable|mimes:pdf',
            'propertyUpdatesDoc'     => 'nullable|mimes:pdf',
            'token_name'             => 'required|max:100',
            'token_symbol'           => 'required|max:4',
            'token_value'            => 'required|numeric|gte:0',
            'token_decimal'          => 'required|numeric|digits_between:1,2',
            'tokentype'              => 'required',
            'token_image'            => 'nullable|mimes:jpeg,jpg,bmp,png|max:70000',
            'propertyVideo' => 'nullable|mimes:mp4,mov|max:70000',
            'investor' => 'nullable|mimes:pdf',
            'investor.mimes' => 'Please upload a valid Prospectus file.',
            'brochure' => 'nullable|mimes:pdf',
            'brochure.mimes' => 'Please upload a valid Prospectus file.',
            'token_image' => 'nullable|mimes:jpg,png,jpeg',
            'token_image.mimes' => 'Please upload a valid token image file.',
        ];

        if ($request->token_type == 1) {
            $validationRuleProp = [
                'propertyLocation'          => 'required|max:200',
                'propertyType'              => 'required',
                //'totalDealSize' => 'required|numeric|min:0',
                'total_sft'                 => 'required|numeric|min:0|gte:0',
                'propertyLocationOverview'  => 'required',
                'locality'                  => 'required|max:200',
                'yearOfConstruction'        => 'required|numeric|digits:4|gte:0',
                // 'propertyTotalBuildingArea' => 'required|numeric|min:0|gte:0',
                'propertyDetailsHighlights' => 'required',
                'floorplan'                 => 'nullable|max:70000',
                'propertyimages'            => 'nullable|max:70000',
                //'token_supply'	=>	'required|numeric',
            ];

            $validationRule = array_merge($validationRule, $validationRuleProp);
        } else {
            $validationRule['propertyHighlights'] = 'required';
        }

        $this->validate($request, $validationRule);

        try {

            $property = Property::findOrFail($id);
            $property = $this->productcrud($property, $request);

            $token                = IssuerTokenRequest::where(
                'property_id',
                $id
            )->first();
            $token->name          = $request->token_name;
            $token->symbol        = $request->token_symbol;
            $token->usdvalue      = $request->token_value;
            $token->decimal       = $request->token_decimal;
            $token->security_type = $request->tokentype;
            if ($request->hasFile('token_image')) {
                $token->token_image = $request->token_image->store('token_image');
            }

            if ($request->token_type == 2) {
                $token->supply = $request->token_supply;
            } else {
                $token->supply = $request->token_supply; //$request->total_sft
                // $request->token_value; //;
            }

            $token->save();

            return back()->with(
                'flash_success',
                'Property updated successfully'
            );
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('api.something_went_wrong')
            );
        }
    }

    /**
     * Used to show Asset Types
     */
    public function ShowAssetType()
    {
        try {
            $assets = AssetType::orderBy('type', 'asc')->get();
            return view('admin.assettype.index', compact('assets'));
        } catch (Exception $e) {
            return back()->with(
                'flash_error',
                trans('api.something_went_wrong')
            );
        }
    }

    /**
     * Used to show Create Asset Types
     */
    public function CreateAssetType()
    {
        return view('admin.assettype.create');
    }

    /**
     * Used to store Asset Types
     */
    public function storeAssetType(Request $request)
    {
        $this->validate($request, [
            'propertytype' => 'required|max:255',
        ]);
        try {
            $model       = new AssetType;
            $model->type = $request->propertytype;
            $model->save();

            return redirect('/admin/property/show/assetType')->with(
                'flash_success',
                'Asset type created successfully'
            );
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to add asset type');
        }
    }

    /**
     * Used to show Edit Asset Types
     */
    public function showEdit($id)
    {
        try {
            $asset = AssetType::find($id);
            return view('admin.assettype.edit', compact('asset'));
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to get asset type');
        }
    }

    /**
     * Used to update Asset Type
     */
    public function updateAssetType(Request $request, $id)
    {
        try {
            $model       = AssetType::find($id);
            $model->type = $request->propertytype;
            $model->save();

            return redirect('/admin/property/show/assetType')->with(
                'flash_success',
                'Asset type updated successfully'
            );
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to update asset type');
        }
    }

    /**
     * Used to delete Asset Type
     */
    public function deleteAssetType($id)
    {
        try {
            AssetType::find($id)->delete();
            return back()->with(
                'flash_success',
                'Asset types deleted successfully'
            );
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to delete asset type');
        }
    }

    /**
     * Used to Create or Update Product
     */
    public function productcrud($property, $request)
    {

        if ($request->has('dividend')) {
            $property->dividend = $request->dividend;
        }

        $property->user_id                   = Auth::user()->id;
        $property->propertyName              = $request->propertyName;
        $property->expectedIrr               = $request->expectedIrr;
        $property->initialInvestment         = $request->initialInvestment;
        if ($request->has('fundedMembers')) {
            $property->fundedMembers             = $request->fundedMembers;
        }
        // $property->propertyEquityMultiple    = $request->propertyEquityMultiple;
        $property->holdingPeriod             = $request->holdingPeriod;
        $property->propertyOverview          = $request->propertyOverview;
        $property->propertyHighlights        = $request->propertyHighlights;
        $property->token_type                = $request->token_type;
        $property->ManagementTeamDescription = $request->ManagementTeamDescription;

        if ($request->token_type == 1) {
            $property->propertyLocation = $request->propertyLocation;
            $property->propertyType     = $request->propertyType;
            if ($request->has('token_value')) {
                $property->totalDealSize = $request->totalDealSize;
            }
            $property->total_sft          = $request->total_sft;
            $property->propertyLocationOverview
                = $request->propertyLocationOverview;
            $property->locality           = $request->locality;
            $property->yearOfConstruction = $request->yearOfConstruction;
            $property->storeys            = $request->storeys;
            $property->propertyParking    = $request->propertyParking;
            $property->floorforSale       = $request->floorforSale;
            $property->property_state     = $request->property_state;
            $property->propertyParkingRatio
                = $request->propertyParkingRatio;
            $property->propertyTotalBuildingArea
                = $request->propertyTotalBuildingArea;
            $property->propertyDetailsHighlights
                = $request->propertyDetailsHighlights;
        } else {
            $property->property_state     = $request->property_state;
            $property->totalDealSize = $request->totalDealSize;
            $property->storeys            = $request->storeys;
            $property->propertyParking    = $request->propertyParking;
            $property->floorforSale       = $request->floorforSale;
        }

        if ($request->hasFile('propertyVideo')) {
            $property->propertyVideo = $request->propertyVideo->store('propertyVideo');
        }
        if ($request->hasFile('propertyLogo')) {
            $property->propertyLogo
                = $request->propertyLogo->store('propertyLogo');
        }

        if ($request->hasFile('floorplan')) {
            $property->floorplan = $request->floorplan->store('floorplan');
        }

        if ($request->hasFile('investor')) {
            $property->investor = $request->investor->store('investor');
        }

        if ($request->hasFile('titlereport')) {
            $property->titlereport
                = $request->titlereport->store('titlereport');
        }

        if ($request->hasFile('brochure')) {
            $property->brochure
                = $request->brochure->store('brochure');
        }

        if ($request->hasFile('termsheet')) {
            $property->termsheet = $request->termsheet->store('termsheet');
        }

        if ($request->hasFile('propertyManagementTeam')) {
            $property->propertyManagementTeam = $request->propertyManagementTeam->store('propertyManagementTeam');
        }

        if ($request->hasFile('propertyUpdatesDoc')) {
            $property->propertyUpdatesDoc = $request->propertyUpdatesDoc->store('propertyUpdatesDoc');
        }

        if ($request->has('show_property')) {
            $property->show_property = $request->show_property;
        }

        $property->save();

        if (!empty($request['comparables'])) {
            //PropertyComparable::where('property_id', $property->id)->delete();

            $comparablesIds = [];
            foreach ($request->comparables as $key => $value) {
                if (isset($value['cid'])) {
                    $comparablesIds[] = $value['cid'];
                }
            }

            if (count($comparablesIds) > 0) {
                PropertyComparable::whereNotIn('id', $comparablesIds)->where('id', $property->id)->delete();
            }

            foreach ($request->comparables as $key => $value) {
                $property_comparables              = new PropertyComparable;
                if (isset($value['cid'])) {
                    $property_comparables = PropertyComparable::where('id', $value['cid'])->first();
                }

                $property_comparables->property_id = $property->id;
                $property_comparables->property    = $value['property'];
                $property_comparables->type        = $value['type'];
                $property_comparables->location    = $value['location'];
                $property_comparables->distance    = $value['distance'];
                $property_comparables->rent        = $value['rent'];
                $property_comparables->saleprice   = $value['saleprice'];

                if ($request->hasFile('map')) {
                    $property_comparables->map = $request->map->store('map');
                }
                if ($request->hasFile('comparabledetails')) {
                    $property_comparables->comparable_details = $request->comparabledetails->store('comparabledetails');
                }

                $property_comparables->save();
            }
        }

        if (!empty($request->member)) {

            $memberIds = [];
            foreach ($request->member as $key => $value) {
                if (isset($value['mid'])) {
                    $memberIds[] = $value['mid'];
                }
            }

            if (count($memberIds) > 0) {
                ManagementMembers::whereNotIn('id', $memberIds)->where('property_id', $property->id)->delete();
            }

            foreach ($request->member as $key => $value) {
                $member = new ManagementMembers;
                if (isset($value['mid'])) {
                    $member = ManagementMembers::where('id', $value['mid'])->first();
                }
                $member->property_id       = $property->id;
                $member->memberName        = $value['name'];
                $member->memberPosition    = $value['position'];
                $member->memberDescription = (isset($value['description']) ? $value['description'] : null);
                if (!empty($value['pic'])) {
                    $member->memberPic = $value['pic']->store('memberPic');
                }
                $member->save();
            }
        }

        if ($request->hasFile('propertyimages')) {
            $files = $request->file('propertyimages');
            foreach ($files as $key => $file) {
                $productImage              = new PropertyImage;
                $productImage->property_id = $property->id;
                $productImage->image       = $file->store('propertyImage');
                $productImage->save();
            }
        }
        if (!empty($request->updates)) {
            $updateIds = [];
            foreach ($request->updates as $key => $value) {
                if (isset($value['uid'])) {
                    $updateIds[] = $value['uid'];
                }
            }
            if (count($updateIds) > 0) {
                PropertyUpdate::whereIn('id', $updateIds)->where('property_id', $property->id)->delete();
            }
            if (!empty($request->updates)) {
                foreach ($request->updates as $key => $value) {
                    $updates = new PropertyUpdate;
                    $updates->property_id = $property->id;
                    $updates->date = $value['date'];
                    $updates->description = $value['description'];
                    $updates->save();
                }
            }
        }

        return $property;
    }

    /**
     * Used to Add Feature
     */
    public function propertyFeature($id)
    {
        try {
            $property = Property::find($id);
            if ($property->feature == 0) {
                $property->feature = 1;
            } else {
                $property->feature = 0;
            }
            $property->save();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed']);
        }
    }

    /**
     * Used to Update Property Status
     */
    public function propertyStatus(Request $request, $id)
    {
        try {
            $property         = Property::find($id);
            $property->status = $request->status;
            $property->save();

            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'failed']);
        }
    }

    /**
     * Used to Store Asset Fund
     */
    public function Storeassetfund(AssetFundRequest $request)
    {
        try {
            $user = Auth::user();

            $property = new Property;
            $property = $this->productcrud($property, $request);

            $this->TokenStore($request, $user->id, $property->id);
            return back()->with('flash_success', 'Property created successfully');
        } catch (\Throwable $th) {
            return back()->with('flash_error', 'Unable to Create Property');
        }
    }

    public function AddFields(){
        return view('admin.bank_field.create');
    }

    public function StoreFields(Request $request){
        try{
            $bank = new Bank();
            $bank->name = $request->name;
            $bank->account_number = $request->account_number;
            $bank->ifsc_code = $request->ifsc_code;
            $bank->branch_name = $request->branch_name;
            $bank->account_name = $request->account_name;
            $bank->save();

            return redirect('/admin/bank_fields')->with('flash_success', 'Bank Field added successfully');
        }catch(Exception $e){
            return back()->with('flash_error', 'Something went wrong');
        }
    }

    public function ListFields(){
        $list = Bank::where('status', 'Active')->get();
        return view('admin.bank_field.index', compact('list'));
    }

    public function EditFields($id){
        $field = Bank::where('id', $id)->first();
        return view('admin.bank_field.edit', compact('field'));
    }

    public function UpdateFields(Request $request){
        try{
            $bank = Bank::where('id', $request->id)->first();
            $bank->name = $request->name;
            $bank->account_number = $request->account_number;
            $bank->ifsc_code = $request->ifsc_code;
            $bank->branch_name = $request->branch_name;
            $bank->account_name = $request->account_name;
            $bank->save();
            return redirect('admin/bank_fields')->with('flash_success', 'Bank Details updated successfully');
        }catch(Exception $e){
            return back()->with('flash_error', 'Something went wrong');
        }
    }

    public function AddBankDetails(){
        $fields = Bank::where('status', 'Active')->get();
        return view('admin.bank.create', compact('fields'));
    }

    public function StoreBankDetails(Request $request){
        try{
            dd($request->all());
            

            return back()->with('flash_success', 'Bank Details are added successfully');
        }catch(Exception $e){
            dd($e);
            return back()->with('flash_error', 'Something went wrong');
        }
    }

    public function GetDepositRequest(){
        $deposit = DepositFiat::with('user','bank')->where('status', 'Pending')->get();
        return view('admin.deposit.index', compact('deposit'));
    }

    public function GetDepositHistory(){
        $deposit = DepositFiat::with('user','bank')->whereIn('status', ['Confirm', 'Cancel'])->orderBy('id','desc')->get();
        return view('admin.deposit.history', compact('deposit'));
    }

    public function UpdateDepositRequest($id, $status){
        try{
            $DepositFiat = DepositFiat::where('id', $id)->first();
            if($status == 'Confirm'){
                if($DepositFiat){
                    $DepositFiat->status = $status;
                    $DepositFiat->save();

                    $user = User::where('id', $DepositFiat->user_id)->first();
                    $user->USD += $DepositFiat->amount;
                    $user->save();
                    return back()->with('flash_success', 'Deposit Approved successfully');
                }else{
                    return back()->with('flash_error', 'Unable to find deposit');
                }
            }else{
                $DepositFiat->status = $status;
                $DepositFiat->save();
                return back()->with('flash_error', 'Deposit Cancelled successfully');
            }
            
        }catch(Exception $e){
            return back()->with('flash_error', 'Something went wrong');
        }
    }
}
