@extends('admin.layout.base')

@section('title', 'Edit Property')

@section('content')

<style>
    .parsley-errors-list{
        color: red
    }
</style>

<div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Edit Property</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->


        <div class="content">
            <!-- Start container-fluid -->
            <div class="container-fluid wizard-border">
                <!-- start  -->
                <a href="{{ route('admin.property.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>
                <h5>Edit Property</h5>
                <br>
                <form class="form-horizontal" id="property-edit" action="{{url('/admin/property/'.$property->id)}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    {{ method_field("PUT") }}
                    <input type="hidden" name="token_type" value="1">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyName">@lang('admin.property.propertyname')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="propertyName"
                                    value="{{ @$property->propertyName }}" required=""
                                    data-parsley-required-message="Please enter @lang('admin.property.propertyname')" id="propertyName"
                                    placeholder="@lang('admin.enter') @lang('admin.property.propertyname')" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyLocation">@lang('admin.property.propertylocation')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="propertyLocation"
                                    value="{{ @$property->propertyLocation }}" required=""
                                    data-parsley-required-message="Please enter @lang('admin.property.propertylocation')" id="propertyLocation"
                                    placeholder="@lang('admin.enter') @lang('admin.property.propertylocation')" maxlength="100">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Property Logo <span class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="propertyLogo" accept="image/png,image/jpeg" id="propertyLogo">
                                @if($property->propertyLogo)
                                    <img src="{{ img($property->propertyLogo) }}" width="100px" class="thumbnail"/>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="propertyType">@lang('admin.property.type')<span class="text-danger">*</span></label>
                                <select class="form-control" name="propertyType" id="propertyType" required
                                    data-parsley-required-message="Please choose @lang('admin.property.type')">
                                    <option value="">Select</option>
                                    @foreach ($assetType as $value)
                                        <option value="{{ @$value->type }}" @if($property->propertyType == $value->type) selected="selected" @endif>{{ @$value->type }}</option>
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
                                    value="{{ @$property->totalDealSize }}" required
                                    id="totalDealSize"
                                    placeholder="@lang('admin.placeholders.total_deal_size')" min="1" step="any"
                                    onchange="calculateTokenValue()">
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="totalDealSize"
                                    value="{{@$property->totalDealSize}}" required data-parsley-type="digits"
                                     id="totalDealSize"
                                    placeholder="@lang('admin.placeholders.total_deal_size')" min="1" step="any" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="expectedIrr">Expected Annual Return (%)<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="expectedIrr" id="expectedIrr"
                                    value="{{ @$property->expectedIrr }}" placeholder="Enter Expected Annual Return" required
                                    data-parsley-type="digits"
                                    data-parsley-required-message="Please Enter Expected Annual Return" min="1"
                                    step="any">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="total_sft">Total <span id="AreaType">Sq Ft</span><span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="total_sft"
                                    value="{{ @$property->total_sft }}" data-parsley-type="digits" id="total_sft"
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
                                        <option value="< 1" {{$property->holdingPeriod == '< 1' ? 'selected' : ''}}> < 1 year</option>
                                        <option value="2" {{$property->holdingPeriod == '2' ? 'selected' : ''}}>2 years</option>
                                        <option value="5" {{$property->holdingPeriod == '5' ? 'selected' : ''}}>5 years</option>
                                        <option value="> 5" {{$property->holdingPeriod == '> 5' ? 'selected' : ''}}> > 5 years</option>
                                    </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.total_area')</label>
                               <select name="area_type" id="area_type" class="form-control">
                                <option value="Sq ft" {{@$property->area_type == 'Sq ft' ? 'selected':''}}>Square Feet</option>
                                <option value="acres" {{@$property->area_type == 'acres' ? 'selected':''}}>Acres</option>
                                <option value="hectares" {{@$property->area_type == 'hectares' ? 'selected':''}}>Hectares</option>
                                <option value="Sq meter" {{@$property->area_type == 'Sq meter' ? 'selected':''}}>Square Meters</option>
                                <option value="Sq yards" {{@$property->area_type == 'Sq yards' ? 'selected':''}}>Square Yards</option>
                                <option value="Sq miles" {{@$property->area_type == 'Sq miles' ? 'selected':''}}>Square Miles</option>

                               </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="initialInvestment">@lang('admin.inputs.min_investment') ($)<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="initialInvestment"
                                    value="{{ @$property->initialInvestment }}" required data-parsley-type="digits"
                                    data-parsley-required-message="Please enter @lang('admin.inputs.min_investment')" id="initialInvestment"
                                    placeholder="@lang('admin.placeholders.min_investment')" min="0.1" step="any"
                                    onkeyup="calculateTokenValue()">
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="total_sft">Divident</label>
                                <input class="form-control" type="number" name="dividend" required data-parsley-type="digits" data-parsley-required-message="Please enter divident" id="total_sft" placeholder="Please enter divident" step="any" min="0" max="999999999">
                            </div>
                        </div> --}}
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
                                    placeholder="@lang('admin.placeholders.detail_overview')" maxlength="600">{{ @$property->propertyOverview }}</textarea>
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
                                    maxlength="600">{{$property->propertyLocationOverview}}</textarea>
                            </div>
                        </div>
                    </div>

                    <br>
                    <h5>@lang('admin.doc/reports')</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.labels.investordos')<span class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="investor" accept="application/pdf" id="propertyInvestor" data-parsley-required-message="Please choose Prospectus">
                                <input type="hidden" name="existing_investor" value="{{ $property->investor }}">
                                <a href="{{ @img($property->investor) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Reports&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="titlereport" value="{{ old('titlereport') }}" accept="application/pdf" id="propertyTitlereport">
                                <a href="{{ @img($property->titlereport) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Agreements&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="termsheet" accept="application/pdf" id="termsheet">
                                <a href="{{ @img($property->termsheet) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Additional Information&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" accept="application/pdf" name="propertyUpdatesDoc" id="propertyUpdatesDoc">
                                <a href="{{ @img($property->propertyUpdatesDoc) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Brochure <span class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="brochure" accept="application/pdf" id="brochure" data-parsley-required-message="Please choose Brochure">
                                <input class="form-control" type="hidden" name="existing_brochure" value="{{$property->brochure}}" accept="application/pdf" id="brochure" data-parsley-required-message="Please choose Brochure">
                                <a href="{{ @img($property->brochure) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>
                    </div>
                    {{--<div class="row">
                        <div class="col-md-3 d-none">
                            <div class="form-group">
                                <label for="" class="col-form-label">Management Team&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" accept="application/pdf" name="propertyManagementTeam" id="propertyManagementTeam">
                                <a href="{{ @img($property->propertyManagementTeam) }}" target="_blank" rel="noopener noreferrer">View</a>
                            </div>
                        </div>
                    </div> --}}
                    <br>
                    <h5>@lang('admin.property_details')</h5>
                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="show_property">Show Property Details<span class="text-danger">*</span></label>
                                <select class="form-control" name="show_property" id="show_property" required>
                                    <option value="">Select</option>
                                    <option value="yes" {{@$property->show_property == 'yes' ? 'selected':''}}>yes</option>
                                    <option value="no" {{@$property->show_property == 'no' ? 'selected':''}}>no</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.locality')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="locality" id="locality" value="{{ $property->locality }}" placeholder="@lang('admin.placeholders.locality')" required maxlength="600" data-parsley-required-message="Please enter locality">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.year_of_build') <span class="text-danger"> *</span></label>
                                <select class="form-control" name="yearOfConstruction" id="yearofbuild" required data-parsley-required-message="Please choose @lang('admin.inputs.yearofbuild')">
                                    <option value="">Select</option>
                                    @for ($i = 1990; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" {{$property->yearOfConstruction == $i ? 'selected':''}}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.inputs.details_highlight') ( Max 600 Characters)</label>
                                <textarea class="form-control" type="text" name="propertyDetailsHighlights" value="" id="propertyDetailsHighlights" placeholder="@lang('admin.placeholders.details_highlight')" data-parsley-required-message="Please enter Property Highlights" maxlength="600">{{$property->propertyDetailsHighlights}}</textarea>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="airport">@lang('admin.property.airport')</label>
                                <input type="text" class="form-control" type="text" name="airport" value="{{ $property->airport }}" data-parsley-required-message="Please enter @lang('admin.property.airport')" id="airport" placeholder="Nearest Airport" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="hospitals">@lang('admin.property.hospitals')</label>
                                <input class="form-control" type="text" name="hospitals" value="{{ $property->hospitals }}" data-parsley-required-message="Please enter @lang('admin.property.hospitals')" id="hospitals" placeholder="Nearest Hospital" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fire_services">@lang('admin.property.fire_services')</label>
                                <input class="form-control" type="text" name="fire_services" id="fire_services" value="{{ $property->fire_services }}" placeholder="Nearest Fire Service" maxlength="100">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="industrial">@lang('admin.property.industrial')</label>
                                <input class="form-control" type="text" name="industrial" id="industrial" value="{{ $property->industrial }}" placeholder="Nearest Industrial Area" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5>Token Details</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Select Chain<span
                                        class="text-danger">*</span></label>
                                <select class="form-control allowAlphaSpace" name="token_chain">
                                    <option value="">Select Chain</option>
                                    <option value="ETH" {{@$property->issuerToken->coin == 'ETH' ? 'selected':''}}>Ethereum</option>
                                    <option value="BNB" {{@$property->issuerToken->coin == 'BNB' ? 'selected':''}}>Binance</option>
                                    <option value="MATIC" {{@$property->issuerToken->coin == 'MATIC' ? 'selected':''}}>Polygon</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenname')<span class="text-danger">*</span></label>
                                <input class="form-control allowAlphaSpace" type="text" name="token_name" value="{{ @$property->issuerToken->name }}" required id="tokenName" placeholder="@lang('admin.coin.tokenname')" data-parsley-required-message="Please enter Token Name" maxlength="20">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensymbol') <span class="text-danger">* </span><i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only 4 characters are allowed ">&#xf05a;</i></label>
                                <input class="form-control allowAlphaOnly" type="text" name="token_symbol" value="{{ @$property->issuerToken->symbol }}" required id="tokenSymbol" placeholder="Eg: ABCD" data-parsley-required-message="Please enter Token Symbol" maxlength="4">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenvalue')({{ Setting::get('default_currency') }}) <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="token_value" value="{{ @$property->issuerToken->usdvalue }}" id="tokenValue" placeholder="Token Value" step="any">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensupply') <span class="text-danger">*</span>(is equal to total <span id="TokanSupplyVal">Sq ft</span>)</label>
                                <input class="form-control" type="number" name="token_supply" value="{{@$property->issuerToken->supply}}" required id="tokenSupply" placeholder="Token Supply" readonly >
                            </div>
                            <label style="color: blue">* Note: Decimal places Cant be allowed(ex:240.4333)</label>

                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokendecimal') <span class="text-danger">*</span></label>
                                <select class="form-control" name="token_decimal" required id="tokenDecimal">
                                    <option value="">Select Decimal</option>
                                    @for($i=1; $i<=18; $i++)
                                        <option value="{{$i}}" {{$property->issuerToken->decimal == $i ? 'selected' : ''}}>{{$i}}</option>
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
                                <label for="" class="col-form-label">@lang('admin.coin.tokenimage') <span class="text-danger">*</span>&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="token_image"  id="tokenImage" accept="image/png,image/jpeg,image/jpg" data-parsley-required-message="Please upload Token Image">
                                <input type="hidden" name="existing_token_image" value="{{ $property->issuerToken->token_image }}">
                                <img src="{{ img($property->issuerToken->token_image) }}" width="100px" class="thumbnail"/>
                            </div>
                        </div>
                    </div>

                    <h5>Management Team</h5>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Management Team Description (Max 600 Characters)</label>
                            <textarea class="form-control" type="text" name="ManagementTeamDescription" id="propertyOverview" placeholder="Enter Management Team Description" maxlength="600">{{ @$property->ManagementTeamDescription }}</textarea>
                        </div>
                    </div>
                    <h6>Management Members</h6>
                    {{-- <div id="divManagementMembers" data-id="0"></div> --}}
                    @foreach(@$property->members as $key=> $member)
                            <div class="row" id="MemberBlock_{{ $key }}">
                                <input type="hidden" name="member[{{ $key }}][mid]" value="{{ $member->id }}">
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Name</label>
                                    <input class="form-control" type="text" name="member[{{ $key }}][name]" id="MemberName_{{ $key }}" placeholder="Enter Member Name" value="{{ $member->memberName }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Position</label>
                                    <input class="form-control" type="text" name="member[{{ $key }}][position]" id="MemberName_{{ $key }}" placeholder="Enter Member Position" value="{{ $member->memberPosition }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Image</label>
                                    <input class="form-control" type="file" name="member[{{ $key }}][pic]" @if(empty($member->memberPic))  @endif id="MemberPic_{{ $key }}" accept="image/png,image/jpeg" placeholder="Select Member Picture">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Description</label>
                                    <input class="form-control" type="text" name="member[{{ $key }}][description]"  id="MemberDescription_{{ $key }}" placeholder="Enter Description" value="{{ $member->memberDescription }}">
                                </div>
                                <div class="col-md-1 form-group">
                                    @if($key > 0)
                                        {{-- <button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeMember({{ $key }});">X</button> --}}
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    {{-- <button type="button" class="btn btn-info" id="AddMember">+ Add Member</button> --}}
                    <!-- end row -->

                    {{-- <h5>Updates</h5>
                    <div id="updates" data-id="0"></div> --}}
                    {{-- <button type="button" class="btn btn-info" id="Addupdates">+ Add Updates</button> --}}

                    <div class="row next-btn" style="padding:25px 0px;">
                        <div class="col-sm-12">
                            <div class="form-group text-center mb-0">
                                <button type="submit"
                                    class="btn btn-primary waves-effect waves-light mr-1 createTokenButton">Edit
                                    Token</button>
                                {{-- <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">Previous</button>
                                <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">Create Token</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end container-fluid -->

@endsection

@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script type="text/javascript" src="{{ asset('main/vendor/jquery/jquery-1.12.3.min.js') }}"></script>
            <script src="{{ asset('main/assets/js/validate.min.js') }}"></script>
            <script src="{{ asset('main/assets/js/additional-method.js') }}"></script>
            <script type="text/javascript">
                $(document).ready(function() {

                    var n = 2;
                    $("#add_comparables").click(function(e) {
                        e.preventDefault();
                        var html = '<div id="comparables_block_' + n +
                            '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Property Address</label><input class="form-control" type="text" name="comparables[' +
                            n + '][property]" id="property_' + n +
                            '" placeholder="Property Address"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Date</label><input class="form-control" type="date" name="comparables[' +
                            n + '][type]" id="type_' + n +
                            '" placeholder="Sale Date"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Location</label><input class="form-control" type="text" name="comparables[' +
                            n + '][location]" id="location_' + n +
                            '" placeholder="Location"   data-parsley- -message="Please enter Location"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Year of Build</label><input class="form-control" type="number" name="comparables[' +
                            n + '][distance]" accept="image/png,image/jpeg" id="distance_' + n +
                            '" placeholder="Year of Build" min="0"   data-parsley- -message="Please enter Year of Build"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Total Sft</label><input class="form-control" type="number" name="comparables[' +
                            n + '][rent]" id="rent_' + n +
                            '" placeholder="Total Sft" min="0" step="any"   data-parsley- -message="Please enter Total SFT"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Price</label><input class="form-control" type="number" name="comparables[' +
                            n + '][saleprice]"  id="saleprice_' + n +
                            '" placeholder="Sale Price" min="0" step="any"   data-parsley- -message="Please enter Sale Price"></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Property Logo</label><input class="form-control" type="file" name="propertyVideo" accept="image/png,image/jpeg"   id="propertyLogo" placeholder="Enter Property Logo"   data-parsley- -message="Please upload Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Map</label><input class="form-control" type="file" name="map" accept="application/pdf"   id="propertyLogo" placeholder="Enter Property Logo"   data-parsley- -message="Please choose Map"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Comparables Details</label><input class="form-control" type="file" name="comparabledetails" accept="application/pdf"  id="propertyLogo" placeholder="Enter Property Logo"   data-parsley- -message="Please upload Comparable Details"></div></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' +
                            n + '" onclick="comparables_remove(' + n + ');" >X</button></div></div>';
                        $("#comparables_section").append(html);
                        n = n + 1;
                    });

                    $("#add_landmark").click(function(e) {
                        e.preventDefault();
                        var html = '<div id="landmark_block_' + n +
                            '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Landmark Name</label><input class="form-control" type="text" name="landmarks[' +
                            n + '][landmarkName]" required id="landmarkName_' + n +
                            '" placeholder="Enter landmark name"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Landmark Distance</label><input class="form-control" type="number" name="landmarks[' +
                            n + '][landmarkDist]" required id="landmarkDist_' + n +
                            '" placeholder="Enter landmark distance" min="0" step="any"></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' +
                            n + '" onclick="landmark_remove(' + n + ');" >X</button></div></div>';
                        $("#landmark_section").append(html);
                        n = n + 1;
                    });
                });

                function landmark_remove(n) {
                    $("#landmark_block_" + n).remove();
                }

                $('#area_type').on('change', function(){
                    value = $(this).val();
                    $('#AreaType').text(value);
                    $('#TokanSupplyVal').text(value);
                    var inputField = document.getElementById('total_sft_input');
                    inputField.placeholder = "Enter Total " + value;
                })

                function comparables_remove(n) {
                    $("#comparables_block_" + n).remove();
                }

                $(document).ready(function() {
                    addManagementMember(0);
                    addUpdates(0);
                });

                $('#AddMember').click(function(e) {
                    var index = parseInt($('#divManagementMembers').attr('data-id'));
                    addManagementMember(index + 1);
                });

                function removeMember(index) {
                    $('#MemberBlock_' + index).remove();
                }

                function addManagementMember(index) {
                    var removeBtn =
                        '<button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeMember(' + index +
                        ');">X</button>';
                    var temp = '<div class="row" id="MemberBlock_' + index + '">' +
                        '	<div class="col-md-3 form-group">' +
                        '		<label for="" class="col-form-label">Member Name</label>' +
                        '		<input class="form-control" type="text" name="member[' + index + '][name]"  id="MemberName_' + index +
                        '" placeholder="Enter Member Name" >' +
                        '	</div>' +
                        '	<div class="col-md-3 form-group">' +
                        '		<label for="" class="col-form-label">Member Position</label>' +
                        '		<input class="form-control" type="text" name="member[' + index + '][position]"  id="MemberPosition_' +
                        index + '" placeholder="Enter Member Position" >' +
                        '	</div>' +
                        '	<div class="col-md-3 form-group">' +
                        '		<label for="" class="col-form-label">Member Image&nbsp;&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>' +
                        '		<input class="form-control" type="file" name="member[' + index + '][pic]"  id="MemberPic_' + index +
                        '" accept="image/png,image/jpeg" placeholder="Select Member Picture" >' +
                        '	</div>' +
                        '	<div class="col-md-3 form-group">' +
                        '		<label for="" class="col-form-label">Member Description</label>' +
                        '		<input class="form-control" type="text" name="member[' + index +
                        '][description]"  id="MemberDescription_' + index + '" placeholder="Enter Description" >' +
                        '	</div>' +
                        '	<div class="col-md-1 form-group">' +
                        '       ' + ((index > 0) ? removeBtn : '') +
                        '   </div>' +
                        '</div>';
                    $('#divManagementMembers').attr('data-id', index).append(temp);
                }

                $("#Addupdates").on("click", function() {
                    var index = parseInt($('#updates').attr('data-id'));
                    addUpdates(index + 1);
                });

                function removeUpdates(index) {
                    $('#updates_' + index).remove();
                }

                function addUpdates(index) {
                    var removeBtn =
                        '<button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeUpdates(' + index +
                        ');">X</button>';
                    var temp = '<div class="row" id="updates_' + index + '">' +
                        '<div class="col-md-3">' +
                        '<div class="form-group">' +
                        '<label for="" class="col-form-label">Update Date</label>' +
                        '<input class="form-control" type="date" name="updates[' + index +
                        '][date]" id="date" placeholder="Date" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-3">' +
                        '<div class="form-group">' +
                        '<label for="" class="col-form-label">Update Description</label>' +
                        '<input class="form-control" type="text" name="updates[' + index +
                        '][description]" id="date" placeholder="Please enter Description" >' +
                        '</div>' +
                        '</div>' +
                        '<div class="col-md-1">' +
                        '' + ((index > 0) ? removeBtn : '') +
                        '<div>' +
                        '<div>';
                    $("#updates").attr('data-id', index).append(temp);
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
            <script src="{{ asset('/js/parsley.js') }}"></script>
            <script>
                $('#area_type').on('change', function(){
                    value = $(this).val();
                    $('#AreaType').text(value);
                })

                function showLoader() {
                    console.log('loader')
                    $('body').addClass('pre-loader')
                }

                function hideLoader() {
                    console.log("hide loader")
                    $('body').removeClass('pre-loader')
                }
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

            <script type="text/javascript">
                $(document).ready(function() {
                    $("#property-create").validate({
                        rules: {
                            "propertyName": {
                                required: true,
                                maxlength: 50,
                            },
                            "propertyLocation": {
                                required: true,
                                maxlength: 100,
                            },
                            "propertyLogo": {
                                required: true,
                                accept: 'image/jpeg, image/png, image/jpg',
                            },
                            "propertyType": {
                                required: true,
                            },
                            "property_state": {
                                required: true
                            },
                            "totalDealSize": {
                                required: true,
                                number: true,
                                min: 1,
                                max: 100000000000,
                            },
                            "expectedIrr": {
                                required: true,
                                number: true,
                                min: 1,
                                max: 100,
                            },
                            "PropertyedMembers": {
                                required: true,
                                number: false,
                                min: 1,
                            },
                            "initialInvestment": {
                                required: true,
                                number: true,
                                min: 1,
                                max: 10000000000,
                            },
                            "holdingPeriod": {
                                required: true,

                            },
                            "total_sft": {
                                required: true,
                                number: true,
                                min: 1,
                                max: 100000000000,
                            },
                            "propertyOverview": {
                                required: true,
                                maxlength: 600
                            },
                            "propertyLocationOverview": {
                                required: true,
                                maxlength: 600
                            },
                            "comparables[1][property]": {
                                maxlength: 150
                            },

                            "comparables[1][location]": {
                                maxlength: 100
                            },

                            "comparables[1][rent]": {
                                max: 100000000000,
                            },
                            "comparables[1][saleprice]": {
                                max: 100000000000,
                            },

                            "propertyEquityMultiple": {
                                required: false,
                                number: true,
                                min: 0,
                            },

                            "propertyHighlights": {
                                required: true,
                            },
                            "show_property": {
                                required: true,
                            },
                            "locality": {
                                required: true,
                                maxlength: 100,
                            },
                            "yearOfConstruction": {
                                required: true,
                                number: true,
                                min: 0,
                                maxlength: 4,
                            },
                            "propertyTotalBuildingArea": {
                                required: false,
                                number: true,
                                min: 0,
                                max: 100000000000,
                            },
                            "propertyDetailsHighlights": {
                                required: false,
                                maxlength: 600
                            },
                            "floorplan": {
                                required: false,
                                accept: 'pdf',
                            },
                            "airport": {
                                maxlength: 50
                            },
                            "hospitals": {
                                maxlength: 50
                            },
                            "fire_services": {
                                maxlength: 50,
                            },
                            "industrial": {
                                maxlength: 50,
                            },
                            "investor": {
                                required: true,
                                accept: 'pdf',
                            },
                            "titlereport": {
                                required: false,
                                accept: 'pdf',
                            },
                            "termsheet": {
                                required: false,
                                accept: 'pdf',
                            },
                            "propertyimages": {
                                required: true,
                                accept: 'image/jpeg, image/png, image/jpg',
                            },
                            "management": {
                                required: true,
                            },
                            "updates": {
                                required: true,
                            },
                            "propertylogoimage": {
                                required: false,
                                accept: 'image/jpeg, image/png, image/jpg, image',
                            },
                            "propertyVideo": {
                                required: true,
                                accept: 'video/mp4,video/x-m4v',
                            },
                            "propertyManagementTeam": {
                                required: false,
                                accept: 'pdf',
                            },
                            "propertyUpdatesDoc": {
                                required: false,
                                accept: 'pdf',
                            },
                            "brochure": {
                                required: true,
                                accept: 'pdf',
                            },
                            "map": {
                                required: false,
                                accept: 'pdf',
                            },
                            "comparabledetails": {
                                required: false,
                                accept: 'pdf',
                            },
                            "token_name": {
                                required: true,
                                maxlength: 50
                            },
                            "token_symbol": {
                                required: true,
                                minlength: 3,
                                maxlength: 4,
                            },
                            "token_value": {
                                required: true,
                                number: true,
                                max: 100000000,
                                min: 0.000001
                            },
                            "token_supply": {
                                required: true,
                                number: true,

                                max: 100000000000,
                            },
                            "token_decimal": {
                                required: true,
                                min:1,
                                max:18,
                                // digits: true,
                                maxlength: 2,
                            },
                            "ManagementTeamDescription": {
                                maxlength: 600
                            },
                            "member[0][name]": {
                                maxlength: 50
                            },
                            "member[0][position]": {
                                maxlength: 50
                            },
                            "member[0][description]": {
                                maxlength: 50
                            }
                        },
                        messages: {
                            "propertyName": {
                                required: "Please Enter Valid Property Name",
                            },
                            "token_value": {
                                required: "Please Enter Valid Token Value",
                            },
                            "token_image": {
                                required: "Please Choose Token Image",
                            },
                            "token_decimal": {
                                required: "Please Enter Valid Token Decimal",
                            },
                            "token_supply": {
                                required: "Please Enter Valid Token Supply",
                            },
                            "token_name": {
                                required: "Please Enter Valid Token Name",
                            },
                            "token_symbol": {
                                required: "Please Enter Valid Token Symbol",
                            },
                            "storeys": {
                                required: "Please Enter Valid Community!",
                            },
                            "propertyLocation": {
                                required: "Please Enter Valid Property Location",
                            },
                            "propertyLogo": {
                                required: "Please Choose Property Logo",
                                accept: "Please Upload Valid format (jpeg|png|jpg)",
                            },
                            "propertyVideo": {
                                required: "Please Choose Property Logo",
                                accept: "Please Upload Valid format (mp4|x-m4v)",
                            },
                            "management": {
                                required: "Please Upload Management",
                            },
                            "updates": {
                                required: "Please Upload Updates",
                            },
                            "propertylogoimage": {
                                required: "Please Choose Property Logo",
                                accept: "Please Upload Valid format (jpeg|png|jpg)",
                            },
                            "propertyimages": {
                                required: "Please Choose Property Image",
                                accept: "Please Upload Valid format (jpeg|png|jpg)",
                            },
                            "totalDealSize": {
                                required: "Please Enter Valid Total Deal Size",
                            },
                            "expectedIrr": {
                                required: "Please Enter Valid Expected Annual Return",
                            },
                            "PropertyedMembers": {
                                required: "Please Enter Valid Propertyed Members",
                            },
                            "initialInvestment": {
                                required: "Please Enter Valid Minimum Investment",
                            },
                            "propertyEquityMultiple": {
                                required: "Please Enter Valid Property Equity Multiple",
                            },
                            "holdingPeriod": {
                                required: "Please Enter Valid Holding Period",
                            },
                            "total_sft": {
                                required: "Please Enter Valid Total Square feet",
                            },
                            "propertyOverview": {
                                required: "Please Enter Valid Property Overview",
                            },
                            "propertyHighlights": {
                                required: "Please Enter Valid Property Highlights",
                            },
                            "propertyLocationOverview": {
                                required: "Please Enter Valid Location Overview",
                            },
                            "locality": {
                                required: "Please Enter Valid Location",
                            },
                            "yearOfConstruction": {
                                required: "Please Enter Valid Year of Build!",
                            },
                            "propertyParking": {
                                required: "Please Enter Valid Number of Bedrooms",
                            },
                            "floorforSale": {
                                required: "Please Enter Valid Number of Bathrooms",
                            },
                            "propertyTotalBuildingArea": {
                                required: "Please Enter Valid Total Building Area",
                            },
                            "propertyDetailsHighlights": {
                                required: "Please Enter Valid Details Highlights",
                            },
                            "floorplan": {
                                required: "Please Choose Floor Plan",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "investor": {
                                required: "Please Choose Prospectus/OM",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "titlereport": {
                                required: "Please Choose Report",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "termsheet": {
                                required: "Please Choose Reports",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "comparabledetails": {
                                required: "Please Choose Term Sheet",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "propertyManagementTeam": {
                                required: "Please Choose Management Team Report",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "brochure": {
                                required: "Please Choose Brochure Document",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "propertyUpdatesDoc": {
                                required: "Please Choose Updates Report",
                                accept: "Please Upload Valid format (pdf)",
                            },
                            "map": {
                                required: "Please Choose Term Sheet",
                                accept: "Please Upload Valid format (pdf)",
                            },
                        },
                        submitHandler: function(form) {
                            form.submit();
                        }
                    });
                });
            </script>

@endsection
