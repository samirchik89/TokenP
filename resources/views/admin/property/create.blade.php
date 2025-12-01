@extends('admin.layout.base')

@section('title', 'Create Property')
<style>
    .parsley-errors-list{
        color: red
    }
</style>
@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">

                <a href="{{ route('admin.property.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Create Property</h5>

                <form class="form-horizontal" id="property-create" action="{{route('admin.property.store')}}" method="POST" enctype="multipart/form-data" role="form">

                 @csrf
                    <input type="hidden" name="token_type" value="1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyType">Property Client<span class="text-danger">*</span></label>
                                <select class="form-control" name="property_issuer" id="property_issuer" required
                                    data-parsley-required-message="Please choose @lang('admin.property.type')">
                                    <option value="">Select Issuer</option>
                                    @foreach($users as $user)
                                        <option value="{{ @$user->id }}">{{ @$user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyName">@lang('admin.property.propertyname')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="propertyName"
                                    value="{{ old('propertyName') }}" required=""
                                    data-parsley-required-message="Please enter @lang('admin.property.propertyname')" id="propertyName"
                                    placeholder="@lang('admin.enter') @lang('admin.property.propertyname')" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyLocation">@lang('admin.property.propertylocation')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="propertyLocation"
                                    value="{{ old('propertyLocation') }}" required=""
                                    data-parsley-required-message="Please enter @lang('admin.property.propertylocation')" id="propertyLocation"
                                    placeholder="@lang('admin.enter') @lang('admin.property.propertylocation')" maxlength="100">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyLogo">@lang('admin.property.propertylogo')<span class="text-danger">*</span> <i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows png/jpeg/jpg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="propertyLogo"
                                    accept="image/png,image/jpeg,image/jpg" required
                                    data-parsley-required-message="Please choose @lang('admin.property.propertylogo')" id="propertyLogo"
                                    placeholder="@lang('admin.placeholders.property_logo')">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyType">@lang('admin.property.type')<span class="text-danger">*</span></label>
                                <select class="form-control" name="propertyType" id="propertyType" required
                                    data-parsley-required-message="Please choose @lang('admin.property.type')">
                                    <option value="">Select</option>
                                    @foreach ($assetType as $value)
                                        <option value="{{ @$value->type }}">{{ @$value->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="property_state">Project Status<span class="text-danger">*</span></label>
                                <input type="text" value="live" class="form-control" name="property_state"
                                    id="property_state" required readonly>

                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="totalDealSize"
                                    value="{{ old('totalDealSize') }}" required data-parsley-type="digits"
                                    data-parsley-required-message="Please enter @lang('admin.totaldealsize')" id="totalDealSize"
                                    placeholder="@lang('admin.placeholders.total_deal_size')" min="1" step="any"
                                    onchange="calculateTokenValue()">
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="totalDealSize"
                                    value="" required data-parsley-type="digits"
                                     id="totalDealSize"
                                    placeholder="@lang('admin.placeholders.total_deal_size')" min="1" step="any" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="expectedIrr">Expected Annual Return (%)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="expectedIrr" id="expectedIrr"
                                    value="{{ old('expectedIrr') }}" placeholder="Enter Expected Annual Return" required
                                    data-parsley-type="digits"
                                    data-parsley-required-message="Please Enter Expected Annual Return" min="1"
                                    step="any">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total_sft">Total <span id="AreaType">Sq Ft</span><span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="total_sft"
                                    value="{{ old('total_sft') }}" data-parsley-type="digits" id="total_sft"
                                    placeholder="Enter Total Sq Ft" step="any" min="1" max="999999999">
                            </div>
                        </div>

                       

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyEquityMultiple">@lang('admin.inputs.property_equity_multiple')</label>
                                <input class="form-control" type="number" name="propertyEquityMultiple" value="{{old('propertyEquityMultiple')}}" id="propertyEquityMultiple" placeholder="@lang('admin.placeholders.property_equity_multiple')" step="any" data-parsley-type="digits" max="100">
                            </div>
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group ">
                                <label for="holdingPeriod">Minimum Holding Period<span
                                        class="text-danger">*</span></label>
                                    <select class="form-control" name="holdingPeriod" id="holdingPeriod" required
                                    data-parsley-required-message="Enter Minimum Holding Period">
                                    <option value="">Select Minium Holding Period</option>
                                        <option value="< 1"> < 1 year</option>
                                        <option value="2">2 years</option>
                                        <option value="5">5 years</option>
                                        <option value="> 5"> > 5 years</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.total_area')</label>
                               <select name="area_type" id="area_type" class="form-control">
                                <option value="Sq ft">Square Feet</option>
                                <option value="acres">Acres</option>
                                <option value="hectares">Hectares</option>
                                <option value="Sq meter">Square Meters</option>
                                <option value="Sq yards">Square Yards</option>
                                <option value="Sq miles">Square Miles</option>

                               </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.min_investment') ($)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="initialInvestment" value="{{ old('initialInvestment') }}" required data-parsley-required-message="Please enter @lang('admin.inputs.min_investment')" id="initialInvestment" placeholder="@lang('admin.placeholders.min_investment')" min="0.1" step="any" onkeyup="calculateTokenValue()">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>@lang('admin.inputs.overview_details')</h5>
                            <div class="form-group">
                                <label for="propertyOverview">@lang('admin.inputs.detail_overview') ( Max 600 Characters )<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" type="text" name="propertyOverview" required
                                    data-parsley-required-message="Please enter @lang('admin.inputs.detail_overview')" id="propertyOverview"
                                    placeholder="@lang('admin.placeholders.detail_overview')" maxlength="600"></textarea>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyLogo">Insert Video File ( Max: 5MB)<span class="text-danger">*</span></label>&nbsp; <i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows mp4 and x-m4v format">&#xf05a;</i>
                                <input class="form-control" type="file" name="propertyVideo" required data-parsley-required-message="Please upload video file" accept="video/mp4,video/x-m4v,video/*" id="propertyLogo" data-parsley-filemaxsize="10" data-parsley-trigger="change" data-parsley-filemimetypes="video/mp4, video/x-m4v" >
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <h5>@lang('admin.location_details')</h5>
                            <div class="form-group">
                                <label for="">@lang('admin.inputs.location_overview') ( Max 600 Characters ) <span class="text-danger">
                                        *</span> </label>
                                <textarea class="form-control" type="text" name="propertyLocationOverview" id="propertyLocationOverview"
                                    placeholder="Enter Property Location Overview" required data-parsley-required-message="This field is required!"
                                    maxlength="600"></textarea>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h5>@lang('admin.doc/reports')</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.labels.investordos')<span
                                        class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="investor"
                                    value="{{ old('investor') }}" accept="application/pdf" required
                                    id="propertyInvestor" data-parsley-required-message="Please choose Prospectus">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Reports&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="titlereport"
                                    value="{{ old('titlereport') }}" accept="application/pdf"
                                    id="propertyTitlereport">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Agreements&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="termsheet" accept="application/pdf"
                                    id="termsheet">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Additional Information&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" accept="application/pdf"
                                    name="propertyUpdatesDoc" id="propertyUpdatesDoc">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Brochure <span
                                        class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="brochure" accept="application/pdf"
                                    id="brochure" required data-parsley-required-message="Please choose Brochure">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-none">
                            <div class="form-group">
                                <label for="" class="col-form-label">Management Team&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" accept="application/pdf"
                                    name="propertyManagementTeam" id="propertyManagementTeam">
                            </div>
                        </div>
                    </div>
                    <h5>@lang('admin.property_details')</h5>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="show_property">Show Property Details<span class="text-danger">*</span></label>
                                <select class="form-control" name="show_property" id="show_property" required>
                                    <option value="">Select</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.locality')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="locality" id="locality"
                                    value="{{ old('locality') }}" placeholder="@lang('admin.placeholders.locality')" required
                                    maxlength="600" data-parsley-required-message="Please enter locality">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.year_of_build') <span
                                        class="text-danger"> *</span></label>
                                <select class="form-control" name="yearOfConstruction" id="yearofbuild" required
                                    data-parsley-required-message="Please choose @lang('admin.inputs.yearofbuild')">
                                    <option value="">Select</option>
                                    @for ($i = 1990; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>
                            </div>
                        </div>

                        {{--<div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.storeys')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="storeys" required id="storeys"
                                    placeholder="@lang('admin.placeholders.storeys')" min="0">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.parking')</label>
                                <input class="form-control" type="number" name="propertyParking" required
                                    id="propertyParking" placeholder="Number of Bedrooms" min="0">
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Number of Bathrooms</label>
                                <input class="form-control" type="number" name="floorforSale" required
                                    id="floorforSale" placeholder="Number of Bathrooms" min="0">
                            </div>
                        </div> --}}
                      

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.total_area')</label>
                                <input class="form-control" type="number" name="propertyTotalBuildingArea"
                                    id="propertyTotalBuildingArea" value="{{ old('propertyTotalBuildingArea') }}"
                                    placeholder="Enter Total Square Feet" min="0">
                            </div>
                        </div> --}}

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.details_highlight') ( Max 600 Characters
                                    )</label>
                                <textarea class="form-control" type="text" name="propertyDetailsHighlights"
                                    value="{{ old('propertyDetailsHighlights') }}" id="propertyDetailsHighlights" placeholder="@lang('admin.placeholders.details_highlight')"
                                    data-parsley-required-message="Please enter Property Highlights" maxlength="600"></textarea>
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.placeholders.floorplan')&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="floorplan" accept="application/pdf"
                                    id="propertyFloorPlan">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.placeholders.propertyimage')&nbsp;&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows png/jpeg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="propertyimages[]"
                                    accept="image/png,image/jpeg,image/jpg" id="propertyimages" multiple
                                    data-parsley-required-message="Please Upload Property Images">
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="airport">@lang('admin.property.airport')</label>
                                <input type="text" class="form-control" type="text" name="airport"
                                    value="{{ old('airport') }}"
                                    data-parsley-required-message="Please enter @lang('admin.property.airport')" id="airport"
                                    placeholder="Nearest Airport" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hospitals">@lang('admin.property.hospitals')</label>
                                <input class="form-control" type="text" name="hospitals"
                                    value="{{ old('hospitals') }}"
                                    data-parsley-required-message="Please enter @lang('admin.property.hospitals')" id="hospitals"
                                    placeholder="Nearest Hospital" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fire_services">@lang('admin.property.fire_services')</label>
                                <input class="form-control" type="text" name="fire_services" id="fire_services"
                                    value="{{ old('fire_services') }}" placeholder="Nearest Fire Service"
                                    maxlength="100">
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="slums">@lang('admin.property.slums')</label>
                                <input class="form-control" type="text" name="slums" id="slums" required data-parsley-required-message="Please enter @lang('admin.property.slums')" placeholder="@lang('admin.property.slums')" maxlength="600">
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="industrial">@lang('admin.property.industrial')</label>
                                <input class="form-control" type="text" name="industrial" id="industrial"
                                    value="{{ old('industrial') }}" placeholder="Nearest Industrial Area"
                                    maxlength="100">
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="railway_tracks">@lang('admin.property.railway_tracks')</label>
                                <input class="form-control" type="text" name="railway_tracks" required data-parsley-required-message="Please enter @lang('admin.property.railway_tracks')" id="railway_tracks" placeholder="@lang('admin.property.railway_tracks')" maxlength="600">
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="distance_fm_mainroad">@lang('admin.property.distance_fm_mainroad')</label>
                                <input class="form-control" type="text" name="distance_fm_mainroad" id="distance_fm_mainroad" required data-parsley-required-message="Please enter @lang('admin.property.distance_fm_mainroad')" placeholder="@lang('admin.property.distance_fm_mainroad')" maxlength="600">
                            </div>
                        </div> --}}
                    </div>
                    <h5>Token Details</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Select Chain<span
                                        class="text-danger">*</span></label>
                                <select class="form-control allowAlphaSpace" name="token_chain">
                                    <option value="">Select Chain</option>
                                    <option value="ETH">Ethereum</option>
                                    <option value="BNB">Binance</option>
                                    <option value="MATIC">Polygon</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenname')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control allowAlphaSpace" type="text" name="token_name"
                                    value="{{ old('token_name') }}" required id="tokenName"
                                    placeholder="@lang('admin.coin.tokenname')"
                                    data-parsley-required-message="Please enter Token Name" maxlength="20">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensymbol') <span
                                        class="text-danger">* </span><i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only 4 characters are allowed ">&#xf05a;</i></label>
                                <input class="form-control allowAlphaOnly" type="text" name="token_symbol"
                                    value="{{ old('token_symbol') }}" required id="tokenSymbol" placeholder="Eg: ABCD"
                                    data-parsley-required-message="Please enter Token Symbol" maxlength="4">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenvalue')
                                    ({{ Setting::get('default_currency') }}) <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="token_value"
                                    value="{{ old('token_value') }}" id="tokenValue" placeholder="Token Value"
                                    step="any">
                            </div>
                        </div>

                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensupply') <span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="token_supply"
                                    value="{{ old('token_supply') }}" required id="tokenSupply"
                                    placeholder="Token Supply" min="1000">
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensupply') <span
                                        class="text-danger">*</span>(is equal to total <span id="TokanSupplyVal">Sq ft</span>)</label>
                                <input class="form-control" type="number" name="token_supply"
                                    value="" required id="tokenSupply"
                                    placeholder="Token Supply" readonly >
                            </div>
                            <label style="color: blue">* Note: Decimal places Cant be allowed(ex:240.4333)</label>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokendecimal') <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="token_decimal" required id="tokenDecimal">
                                    <option value="">Select Decimal</option>
                                    @for($i=1; $i<=18; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.token_to_be_issued') <span
                                        class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="tokentype" class="tokentype" value="ERC20" checked>
                                @lang('admin.erc20_utility')<br>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenimage') <span
                                        class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows png/jpeg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="token_image" required id="tokenImage"
                                    accept="image/png,image/jpeg,image/jpg"
                                    data-parsley-required-message="Please upload Token Image">
                            </div>
                        </div>
                    </div>

                    <h5>Management Team</h5>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Management Team Description (Max 600
                                Characters)</label>
                            <textarea class="form-control" type="text" name="ManagementTeamDescription" id="propertyOverview"
                                placeholder="Enter Management Team Description" maxlength="600"></textarea>
                        </div>
                    </div>
                    <h6>Management Members</h6>
                    {{-- <div id="divManagementMembers" data-id="0"></div> --}}
                    <div class="row" id="MemberBlock_">
                        <div class="col-md-3 form-group">
                            <label for="" class="col-form-label">Member Name</label>
                            <input class="form-control" type="text" name="member[0][name]" id="MemberName_"
                                placeholder="Enter Member Name" maxlength="50">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="" class="col-form-label">Member Position</label>
                            <input class="form-control" type="text" name="member[0][position]" id="MemberPosition_"
                                placeholder="Enter Member Position" maxlength="50">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="" class="col-form-label">Member Image&nbsp;&nbsp;<i
                                    style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                    title="Only allows png/jpeg format">&#xf05a;</i></label>
                            <input class="form-control" type="file" name="member[0][pic]" id="MemberPic_"
                                accept="image/png,image/jpeg" placeholder="Select Member Picture">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="" class="col-form-label">Member Description</label>
                            <input class="form-control" type="text" name="member[0][description]"
                                id="MemberDescription_0" maxlength="600" placeholder="Enter Description">
                        </div>

                    </div>
                    {{-- <button type="button" class="btn btn-info" id="AddMember">+ Add Member</button> --}}
                    <!-- end row -->

                    {{-- <h5>Updates</h5>
                    <div id="updates" data-id="0"></div> --}}
                    {{-- <button type="button" class="btn btn-info" id="Addupdates">+ Add Updates</button> --}}

                    <div class="row next-btn" style="padding:25px 0px;">
                        <div class="col-sm-12">
                            <div class="form-group text-center mb-0">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light mr-1 createTokenButton">Create
                                    Token</button>
                                {{-- <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">Previous</button>
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">Create Token</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var n = 2;
        $("#add_landmark").click(function () {
            var html = '<div id="landmark_block_' + n + '" class="form-group row"><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Name</label><input class="form-control" type="text" name="landmarks[' + n + '][landmarkName]" required id="landmarkName_' + n + '" placeholder="Enter landmark name"></div><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Distance</label><input class="form-control" type="number" name="landmarks[' + n + '][landmarkDist]" required id="landmarkDist_' + n + '" placeholder="Enter landmark distance" min="0" step="any"></div><div class="form-group col-md-2"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + n + '" onclick="landmark_remove(' + n + ');" >X</button></div></div>';
            $("#landmark_section").append(html);
            n = n + 1;
        });
        function landmark_remove(n) {
            $("#landmark_block_" + n).remove();
        }

        $("#add_comparables").click(function () {
            var html = '<div id="comparables_block_' + n + '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Property Address</label><input class="form-control" type="text" name="comparables[' + n + '][property]" id="property_' + n + '" placeholder="Property Address"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Date</label><input class="form-control" type="text" name="comparables[' + n + '][type]" id="type_' + n + '" placeholder="Sale Date"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Location</label><input class="form-control" type="text" name="comparables[' + n + '][location]" id="location_' + n + '" placeholder="Location"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Year of Build</label><input class="form-control" type="number" name="comparables[' + n + '][distanaccept="image/png,image/jpeg"ce]" id="distance_' + n + '" placeholder="Year of Build" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Total Sft</label><input class="form-control" type="number" name="comparables[' + n + '][rent]" id="rent_' + n + '" placeholder="Total Sft" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Price</label><input class="form-control" type="number" name="comparables[' + n + '][saleprice]" id="saleprice_' + n + '" placeholder="Sale Price" min="0" step="any"></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Property Logo</label><input class="form-control" type="file" name="propertyVideo" accept="image/png,image/jpeg"  id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Map</label><input class="form-control" type="file" name="map" accept=".pdf" id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Comparables Details</label><input class="form-control" type="file" name="comparabledetails" accept=".pdf" id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + n + '" onclick="comparables_remove(' + n + ');" >X</button></div></div>';
            $("#comparables_section").append(html);
            n = n + 1;
        });

        function comparables_remove(n) {
            $("#comparables_block_" + n).remove();
        }

        $(document).ready(function () {
            addManagementMember(0);
            addUpdates(0);
        });

        $('#AddMember').click(function (e) {
            var index = parseInt($('#divManagementMembers').attr('data-id'));
            addManagementMember(index + 1);
        });

        function removeMember(index) {
            $('#MemberBlock_' + index).remove();
        }

        function addManagementMember(index) {
            var removeBtn = '<button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeMember(' + index + ');">X</button>';
            var temp      = '<div class="row" id="MemberBlock_' + index + '">' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Name</label>' +
                '		<input class="form-control" type="text" name="member[' + index + '][name]" id="MemberName_' + index + '" placeholder="Enter Member Name">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Position</label>' +
                '		<input class="form-control" type="text" name="member[' + index + '][position]" id="MemberPosition_' + index + '" placeholder="Enter Member Position">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Image&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>' +
                '		<input class="form-control" type="file" name="member[' + index + '][pic]" id="MemberPic_' + index + '" accept="image/png,image/jpeg" placeholder="Select Member Picture">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Description</label>' +
                '		<input class="form-control" type="text" name="member[' + index + '][description]" id="MemberDescription_' + index + '" placeholder="Enter Description">' +
                '	</div>' +
                '	<div class="col-md-1 form-group">' +
                '       ' + ((index > 0) ? removeBtn : '') +
                '   </div>' +
                '</div>';
            $('#divManagementMembers').attr('data-id', index).append(temp);
        }

        $("#Addupdates").on("click", function(){
            var index = parseInt($('#updates').attr('data-id'));
            addUpdates(index + 1);
        });

        function removeUpdates(index) {
            $('#updates_' + index).remove();
        }

        function addUpdates(index) {
            var removeBtn = '<button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeUpdates(' + index + ');">X</button>';
            var temp = '<div class="row" id="updates_' + index + '">' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<label for="" class="col-form-label">Update Date</label>' +
                                    '<input class="form-control" type="date" name="updates['+index+'][date]" id="date" placeholder="Date" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-3">' +
                                '<div class="form-group">' +
                                    '<label for="" class="col-form-label">Update Description</label>' +
                                    '<input class="form-control" type="text" name="updates['+index+'][description]" id="date" placeholder="Please enter Description" >' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-md-1">' +
                                ''+((index > 0) ? removeBtn : '') +
                            '<div>' +
                        '<div>';
            $("#updates").attr('data-id', index).append(temp);
        }

        $('#area_type').on('change', function(){
                    value = $(this).val();
                    $('#AreaType').text(value);
                    $('#TokanSupplyVal').text(value);
                    var inputField = document.getElementById('total_sft');
                    inputField.placeholder = "Enter Total " + value;
                })
    </script>
    <script type="text/javascript">
                var canSubmit = [],
                    count = 1;

                function calculateTokenValue() {
                    var totalDealSize = parseInt($('#totalDealSize').val()) || 0
                    var formButton = $('.createTokenButton')
                    var totalSqt = parseInt($('#total_sft').val()) || 0
                    var minimumField = $('#initialInvestment')
                    var tokenField = $('#tokenValue')
                    var totalSupplyField = $('#tokenSupply')
                    var tokenValue = (totalDealSize / totalSqt).toFixed(4)
                    // console.log(tokenValue, totalDealSize, totalSqt)
                    minimumField.next('span').remove()
                    formButton.attr('disabled', false)
                    console.log(parseInt(minimumField.val()))
                    if (parseInt(minimumField.val()) > totalDealSize) {
                        formButton.attr('disabled', true)
                        minimumField.after(
                            "<span class='text-danger'>* Minimum Investment should not be greater than Total Deal Size *</span>"
                            )
                    }
                }
            </script>
            <script>
                $('#tokenValue').on('keyup',function(){
                    var sqft=$('#total_sft').val();
                    var tokenvalue=$('#tokenValue').val();
        
                    var dealsize;
                    var supply;
                    if(sqft==0 || sqft==''){
                        sqft=0;
                        $('#totalDealSize').val(0);
                        $('#tokenSupply').val(0);
                        
                    }else if(tokenvalue==0||tokenvalue==''){
                        $('#totalDealSize').val(0);
                    }
                    console.log(sqft);
                    dealsize=sqft*tokenvalue;
                    $('#totalDealSize').val(dealsize);
                    $('#tokenSupply').val(sqft);
                    
                });
            </script>
             <script>
                $('#total_sft').on('keyup',function(){
                    var sqft=$('#total_sft').val();
                    var supply=$('#tokenSupply').val();
                    console.log(supply);
                        $('#tokenSupply').val(sqft);
                    if(sqft==0){
                        $('#totalDealSize').val(0);
                        $('#tokenSupply').val(0);
        
                    }
                    var dealsize;
                    var tokenvalue=$('#tokenValue').val();
                    var supply;
                    if(tokenvalue==0 || tokenvalue==''){
                        $('#totalDealSize').val(0);
                        $('#tokenSupply').val(sqft);
                        
                    }
                    dealsize=sqft*tokenvalue;
                    $('#totalDealSize').val(dealsize);
                    $('#tokenSupply').val(sqft);
                    
                });
            </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script src="{{ asset('/js/parsley.js')}}"></script>
@endsection
