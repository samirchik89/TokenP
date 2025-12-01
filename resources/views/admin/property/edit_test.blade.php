@extends('admin.layout.base')

@section('title', 'Edit Property')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">

                <a href="{{ route('admin.property.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Edit Property</h5>

                <form class="form-horizontal" id="property-edit" action="{{url('/admin/property/'.$property->id)}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    {{ method_field("PUT") }}
                    <input type="hidden" name="token_type" value="1">
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="propertyName" required id="propertyName" placeholder="Enter Property Name" maxlength="200" value="{{ @$property->propertyName }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Location <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="propertyLocation" required id="propertyLocation" placeholder="Enter Property Location" required maxlength="200" value="{{ @$property->propertyLocation }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Logo <span class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>
                        <input class="form-control" type="file" name="propertyLogo" accept="image/png,image/jpeg" id="propertyLogo">
                        @if($property->propertyLogo)
                            <img src="{{ img($property->propertyLogo) }}" width="200px" class="thumbnail"/>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="propertyType" id="propertyType" required>
                            <option value="">Select</option>
                            @foreach ($assetType as $value)
                                <option value="{{ @$value->type }}" @if($property->propertyType == $value->type) selected="selected" @endif>{{ @$value->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" step="any" name="totalDealSize" required id="totalDealSize" placeholder="@lang('admin.placeholders.total_deal_size')" min="0" value="{{ @$property->totalDealSize }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Expected Annual Return (%)<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" step="any" name="expectedIrr" id="expectedIrr" placeholder="Enter Expected Annual Return" min="0" value="{{ @$property->expectedIrr }}">
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Funded Members</label>
                        <input class="form-control" type="number" name="fundedMembers" id="fundedMembers" placeholder="Enter Funded Members" min="0" value="{{ @$property->fundedMembers }}">
                    </div> --}}
                    

                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Minimum Investment <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" step="any" name="initialInvestment" required id="initialInvestment" placeholder="Enter Minimum Investment" min="0" value="{{ @$property->initialInvestment }}">
                    </div>

                    {{-- <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Equity Multiple</label>
                        <input class="form-control" type="number" name="propertyEquityMultiple" id="propertyEquityMultiple" placeholder="Enter Property Equity Multiple" step="any" min="0" value="{{ @$property->propertyEquityMultiple }}">
                    </div> --}}

                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Minimum Holding Period</label>
                        <input class="form-control" type="number" step="any" name="holdingPeriod" required id="holdingPeriod" placeholder="Enter minimum holding period" min="0" value="{{ @$property->holdingPeriod }}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Total Sq ft</label>
                        <input class="form-control" type="number" step="any" name="total_sft" id="total_sft" placeholder="Enter Total Sq ft" step="any" min="0" value="{{ @$property->total_sft }}">
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="property_state">Property Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="property_state" id="property_state" required>
                                <option value="">Select</option>
                                @if($property->property_state == 'live')
                                <option value="live" selected="selected">Live</option>
                                <option value="comingsoon" >Coming Soon</option>
                                @elseif($property->property_state == 'comingsoon')
                                <option value="live" >Live</option>
                                <option value="comingsoon" selected="selected">Coming Soon</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row"></div>
                    <h5>Overview Details</h5>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Overview <span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="propertyOverview" required id="propertyOverview" placeholder="Enter Property Overview">{{ @$property->propertyOverview }}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        {{-- <div class="form-group">
                            <label for="propertyLogo">Insert Video File <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="propertyVideo" accept="video/mp4,video/x-m4v,video/*" id="propertyLogo" placeholder="Enter Property Logo">
                            @if(@$property->propertyVideo)
                                <video width="200" class="thumbnail" controls="controls">
                                    <source src="{{ @img($property->propertyVideo) }}">
                                </video>
                            @endif
                        </div> --}}
                    </div>
                    <div class="row"></div>
                    <h5>Location Details</h5>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Property Location Overview</label>
                        <textarea class="form-control" type="text" name="propertyLocationOverview" id="propertyLocationOverview" placeholder="Enter Property Location Overview">{{ @$property->propertyLocationOverview }}</textarea>
                    </div>
                    <div class="row"></div>
                    <div class="row"></div>
                    <br>
                    <h5>Property Details</h5>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="show_property">Show Property Details<span class="text-danger">*</span></label>
                            <select class="form-control" name="show_property" id="show_property" required>
                                @if(@$property->show_property == 'yes')
                                <option value="yes" selected>yes</option>
                                <option value="no">no</option>
                                @else
                                <option value="yes">yes</option>
                                <option value="no" selected>no</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.locality')</label>
                            <input class="form-control" type="text" name="locality" id="locality" placeholder="@lang('admin.placeholders.locality')" maxlength="200" value="{{ @$property->locality }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.year_of_build')</label>
                            <input class="form-control" type="number" step="any" name="yearOfConstruction" id="yearOfConstruction" placeholder="@lang('admin.placeholders.year_of_build')" min="0" value="{{ @$property->yearOfConstruction }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.storeys')</label>
                            <input class="form-control" type="text" name="storeys" id="storeys" placeholder="@lang('admin.placeholders.storeys')" min="0" value="{{ @$property->storeys }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.parking')</label>
                            <input class="form-control" type="text" name="propertyParking" id="propertyParking" placeholder="@lang('admin.placeholders.parking')" value="{{ @$property->propertyParking }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Number of Bathrooms</label>
                            <input class="form-control" type="number" name="floorforSale" id="floorforSale" placeholder="Number of Bathrooms" min="0" value="{{ @$property->floorforSale }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.total_area')</label>
                            <input class="form-control" type="number" step="any" name="propertyTotalBuildingArea" id="propertyTotalBuildingArea" placeholder="@lang('admin.placeholders.total_area')" min="0" value="{{ @$property->propertyTotalBuildingArea }}">
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.inputs.details_highlight')</label>
                            <textarea class="form-control" type="text" name="propertyDetailsHighlights" id="propertyDetailsHighlights" placeholder="@lang('admin.placeholders.details_highlight')">{{ @$property->propertyDetailsHighlights }}</textarea>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.placeholders.floorplan')</label>
                            <input class="form-control" type="file" name="floorplan" accept=".pdf" id="propertyFloorPlan">
                            @if($property->floorplan)
                                <a href="{{ img($property->floorplan) }}" target="_blank" rel="noopener noreferrer">View</a>
                            @endif
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.placeholders.propertyimage')</label>
                            <input class="form-control" type="file" name="propertyimages[]" accept="image/png,image/jpeg" id="propertyimages" multiple>
                            @if($property->propertyImages)
                                @foreach ($property->propertyImages as $key => $value)
                                    <img src="{{ img($value->image) }}" width="200px" class="thumbnail"/>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.property.airport')</label>
                            <input type="text" class="form-control" type="text" name="airport" value="{{$property->airport}}" id="airport" placeholder="@lang('admin.property.airport')" maxlength="200">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.property.hospitals')</label>
                            <input class="form-control" type="text" name="hospitals" value="{{$property->hospitals}}" id="hospitals" placeholder="@lang('admin.property.hospitals')" maxlength="200">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.property.fire_services')</label>
                            <input class="form-control" type="text" name="fire_services" value="{{$property->fire_services}}" id="fire_services" placeholder="@lang('admin.property.fire_services')" maxlength="200">
                        </div>
                    </div>
                    {{-- <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.property.slums')</label>
                            <input class="form-control" type="text" name="slums" id="slums" value="{{old('slums')}}" required data-parsley-required-message="Please enter @lang('admin.property.slums')" placeholder="@lang('admin.property.slums')" maxlength="200">
                        </div>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.property.industrial')</label>
                            <input class="form-control" type="text" name="industrial" value="{{$property->industrial}}" id="industrial" placeholder="@lang('admin.property.industrial')" maxlength="200">
                        </div>
                    </div>
                    <br>
                    <div class="row"></div>
                    <br>
                    <h5>Documents / Reports</h5>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.labels.investordos') <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="investor" accept="application/pdf" id="propertyInvestor">
                            <a href="{{ @img($property->investor) }}" target="_blank" rel="noopener noreferrer">View</a>
                            {{-- &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'investor')"><i class="fa fa-trash"></i>Delete</a> --}}
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Reports</label>
                            <input class="form-control" type="file" name="titlereport" accept="application/pdf" id="propertyTitlereport">
                            <a href="{{ @img($property->titlereport) }}" target="_blank" rel="noopener noreferrer">View</a>
                            {{-- &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'titlereport')"><i class="fa fa-trash"></i>Delete</a> --}}
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Agreement</label>
                            <input class="form-control" type="file" name="termsheet" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="termsheet">
                            <a href="{{ @img($property->termsheet) }}" target="_blank" rel="noopener noreferrer">View</a>
                            {{-- &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'termsheet')"><i class="fa fa-trash"></i>Delete</a> --}}
                        </div>
                    </div>

                    {{-- <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Management Team</label>
                            <input class="form-control" type="file" accept="application/pdf" name="propertyManagementTeam" id="propertyManagementTeam">
                            <a href="{{ @img($property->propertyManagementTeam) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'propertyManagementTeam')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div> --}}
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Additional Information</label>
                            <input class="form-control" type="file" accept="application/pdf" name="propertyUpdatesDoc" id="propertyUpdatesDoc">
                            <a href="{{ @img($property->propertyUpdatesDoc) }}" target="_blank" rel="noopener noreferrer">View</a>
                            {{-- &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'propertyUpdatesDoc')"><i class="fa fa-trash"></i>Delete</a> --}}
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="" class="col-form-label">Brochure <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" accept="application/pdf" name="brochure" id="brochure">
                            <a href="{{ @img($property->brochure) }}" target="_blank" rel="noopener noreferrer">View</a>
                            {{-- &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'brochure')"><i class="fa fa-trash"></i>Delete</a> --}}
                        </div>
                    </div>

                    <div class="row"></div>
                    <br>
                    <h5>Token Details</h5>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="token_name" required id="tokenName" placeholder="Token Name" value="{{ @$property->issuerToken->name }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Symbol <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="token_symbol" required id="tokenSymbol" placeholder="Token Symbol" value="{{ @$property->issuerToken->symbol }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Value ({{ Setting::get('default_currency') }}) <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" step="any" name="token_value" required id="tokenValue" placeholder="Token Value" value="{{ @$property->issuerToken->usdvalue }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Supply <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" step="any" name="token_supply" required id="tokenSupply" placeholder="Token Supply" value="{{ @$property->issuerToken->supply }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Decimal <span class="text-danger">*</span></label>
                        <select class="form-control" name="token_decimal" required id="tokenDecimal">
                            <option value="">Select Decimal</option>
                            @for($i=1; $i<=18; $i++)
                                <option value="{{$i}}" {{$property->issuerToken->decimal == $i ? 'selected' : ''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token to be issued <span class="text-danger">*</span></label>
                        <br>
                        <input type="radio" name="tokentype" class="tokentype" value="ERC20" checked>MATIC Utility & Payment Token<br>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Image <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" name="token_image" id="tokenImage" accept="image/png,image/jpeg">
                        <img src="{{ img($property->issuerToken->token_image) }}" width="200px" class="thumbnail"/>
                    </div>

                    <div class="row"></div>
                    <h5>Management Team</h5>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Management Team Description</label>
                            <textarea class="form-control" type="text" name="ManagementTeamDescription" id="propertyOverview" placeholder="Enter Management Team Description">{{ @$property->ManagementTeamDescription }}</textarea>
                        </div>
                    </div>
                    <h6>Management Members</h6>
                    <div id="divManagementMembers" data-id="{{ count(@$property->members) - 1 }}">
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
                    </div>
                    {{-- <button type="button" class="btn btn-info" id="AddMember">+ Add Member</button> --}}
                    {{-- <h6 style="padding-top: 10px">Updates</h6> --}}
                    <div id="divManagementMembers" data-id="{{ count(@$property->updates) - 1 }}">
                        @foreach(@$property->updates as $key=> $update)
                            <div class="row" id="UpdateBlock_{{ $key }}">
                                <input type="hidden" name="updates[{{ $key }}][uid]" value="{{ $update->id }}">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Update Date</label>
                                        <input class="form-control" type="date" name="updates[{{ $key }}][date]" id="date" onClick="onCLick()"placeholder="Date" value="{{ \Carbon\Carbon::parse($update->date)->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Update Description</label>
                                        <input class="form-control" type="text" onclick="Onclick()" name="updates[{{ $key }}][description]" id="datechecks" placeholder="Please enter Description" value="{{ $update->description }}">
                                    </div>
                                </div>
                                <div class="col-md-1 form-group">
                                    @if($key > 0)
                                        {{-- <button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeUpdates({{ $key }});">X</button> --}}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row"></div>
                    <div class="col-md-12">
                        <div id="updates" data-id="0"></div>
                        {{-- <button type="button" class="btn btn-info" id="Addupdates">+ Add Updates</button> --}}
                    </div>
                    <div class="form-group row">
                        <br>
                        <br>
                        <label for="" class="col-xs-2 col-form-label"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
     $(document).ready(function(){
        // $('input, textarea, select').attr('disabled', true);
    })
    function Onclick(){
        document.getElementById("datechecks").type = "date";
    }
        function documentdelete(id,columnname){
            if (confirm("Are you sure ?")) {
                $.ajax({
                    url: "{{url('admin/propertydocumentdelete')}}",
                    type: "POST",
                    data: {
                        id: id,
                        columnname: columnname,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                }).done(function(response){
                    if(response == '1') {
                    alert('Updated succesfully');
                    }
                    else{
                        alert('Try Again');
                    }
            });
        }
    }
        var n =<?php echo count($property->propertyLandmark) ?>;
        $("#add_landmark").click(function () {
            var html = '<div id="landmark_block_' + n + '" class="form-group row"><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Name</label><input class="form-control" type="text" name="landmarks[' + n + '][landmarkName]" required id="landmarkName_' + n + '" placeholder="Enter landmark name"></div><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Distance</label><input class="form-control" type="number" step="any" name="landmarks[' + n + '][landmarkDist]" required id="landmarkDist_' + n + '" placeholder="Enter landmark distance" min="0" step="any"></div><div class="form-group col-md-2"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + n + '" onclick="landmark_remove(' + n + ');" >X</button></div></div>';
            $("#landmark_section").append(html);
            n = n + 1;
        });
        function landmark_remove(n) {
            $("#landmark_block_" + n).remove();
        }

        var j = <?php echo count($property->propertyComparable) ?>;
        $("#add_comparables").click(function () {
            var html = '<div id="comparables_block_' + j + '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Property Address</label><input class="form-control" type="text" name="comparables[' + j + '][property]" id="property_' + j + '" placeholder="Property Address"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Date</label><input class="form-control" type="text" name="comparables[' + j + '][type]" id="type_' + j + '" placeholder="Sale Date"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Location</label><input class="form-control" type="text" name="comparables[' + j + '][location]" id="location_' + j + '" placeholder="Location"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Year of Build</label><input class="form-control" type="number" step="any" name="comparables[' + j + '][distanaccept="image/png,image/jpeg"ce]" id="distance_' + j + '" placeholder="Year of Build" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Total Sft</label><input class="form-control" type="number" step="any" name="comparables[' + j + '][rent]" id="rent_' + j + '" placeholder="Total Sft" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Price</label><input class="form-control" type="number" step="any" name="comparables[' + j + '][saleprice]" id="saleprice_' + j + '" placeholder="Sale Price" min="0" step="any"></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Property Logo</label><input class="form-control" type="file" name="propertyVideo" accept="image/png,image/jpeg"  id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Map</label><input class="form-control" type="file" name="map" accept=".pdf"  id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Comparables Details</label><input class="form-control" type="file" name="comparabledetails" accept=".pdf" id="propertylogoimage" placeholder="Enter Property Logo"></div></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + j + '" onclick="comparables_remove(' + j + ');" >X</button></div></div>';
            $("#comparables_section").append(html);
            n = n + 1;
        });

        function comparables_remove(n) {
            $("#comparables_block_" + n).remove();
        }

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
                '		<label for="" class="col-form-label">Member Image</label>' +
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
            $('#UpdateBlock_' + index).remove();
        }

        function addUpdates(index) {
            var removeBtn = '<button type="button" class="btn btn-danger" style="margin-top: 34px;" onclick="removeUpdates(' + index + ');">X</button>';
            var temp = '<div class="row" id="UpdateBlock_' + index + '">' +
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
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#property-edit").validate({
                                             rules        : {
                                                 "propertyName"             : {
                                                     required : true,
                                                     maxlength: 200,
                                                 },
                                                 "propertyLocation"         : {
                                                     required : true,
                                                     maxlength: 200,
                                                 },
                                                 "propertyLogo"             : {
                                                     required: {{ empty(@$property->propertyLogo) ? 'true' : 'false' }},
                                                     accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
                                                 },
                                                 "propertyType"             : {
                                                     required: true,
                                                 },
                                                 "property_state"             : {
                                                     required: true,
                                                 },
                                                 "totalDealSize"            : {
                                                     required: true,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "expectedIrr"              : {
                                                     required : true,
                                                     min      : 0,
                                                     step     : "any"
                                                 },
                                                 "initialInvestment"        : {
                                                     required: true,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "holdingPeriod"            : {
                                                     required: true,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "total_sft"                : {
                                                     required: true,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "propertyOverview"         : {
                                                     required: true,
                                                 },
                                                 "propertyHighlights"       : {
                                                     required: false,
                                                 },
                                                 "propertyLocationOverview" : {
                                                     required: false,
                                                 },
                                                 "locality"                 : {
                                                     required : false,
                                                     maxlength: 200,
                                                 },
                                                 "yearOfConstruction"       : {
                                                     required : false,
                                                     number   : true,
                                                     step    : "any"
                                                     min      : 0,
                                                     maxlength: 4,
                                                 },
                                                 "floorforSale"             : {
                                                     required: false,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "propertyTotalBuildingArea": {
                                                     required: false,
                                                     number  : true,
                                                     step    : "any"
                                                     min     : 0,
                                                 },
                                                 "propertyDetailsHighlights": {
                                                     required: false,
                                                 },
                                                 "floorplan"                : {
                                                     accept  : 'pdf',
                                                 },
                                                 "investor"                 : {
                                                     required: true,
                                                     accept  : 'pdf',
                                                 },
                                                 "brochure"                 : {
                                                     required: true,
                                                     accept  : 'pdf',
                                                 },
                                                 "titlereport"              : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "termsheet"                : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "propertyManagementTeam"   : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "propertyUpdatesDoc"       : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "propertyimages"           : {
                                                     required: false,
                                                     accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
                                                 },
                                                 "management"               : {
                                                     required: false,
                                                 },
                                                 "updates"                  : {
                                                     required: false,
                                                 },
                                                 "propertylogoimage"        : {
                                                     required: false,
                                                     accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
                                                 },
                                                 "propertyVideo"            : {
                                                     required: true,
                                                     accept  : 'video/mp4,video/x-m4v',
                                                 },
                                                 "map"                      : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "comparabledetails"        : {
                                                     required: false,
                                                     accept  : 'pdf',
                                                 },
                                                 "token_name"               : {
                                                     required: true,
                                                 },
                                                 "token_symbol"             : {
                                                     required : true,
                                                     minlength: 3,
                                                     maxlength: 4,
                                                 },
                                                 "token_value"              : {
                                                     required: true,
                                                     number  : true,
                                                     step    : "any"
                                                 },
                                                 "token_decimal"            : {
                                                     required : true,
                                                     digits   : true,
                                                     maxlength: 2,
                                                 },
                                                 "token_image"              : {
                                                     required: {{ empty(@$property->issuerToken->token_image) ? 'true' : 'false' }},
                                                     accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
                                                 }
                                             },
                                             messages     : {
                                                 "propertyName"             : {
                                                     required: "Please Enter Property Name",
                                                 },
                                                 "propertyLocation"         : {
                                                     required: "Please Enter Property Location",
                                                 },
                                                 "propertyLogo"             : {
                                                     accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                                                 },
                                                 "propertyVideo"            : {
                                                     accept: "Please Upload Valid format (mp4|x-m4v)",
                                                 },
                                                 "management"               : {
                                                     required: "Please Upload Management",
                                                 },
                                                 "updates"                  : {
                                                     required: "Please Upload Updates",
                                                 },
                                                 "propertylogoimage"        : {
                                                     accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                                                 },
                                                 "propertyimages"           : {
                                                     accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                                                 },
                                                 "property_state" : {
                                                    required: "Select Status",
                                                 }
                                                 "totalDealSize"            : {
                                                     required: "Please Enter Total Deal Size",
                                                 },
                                                 "expectedIrr"              : {
                                                     required: "Please Enter Expected Annual Return ",
                                                 },
                                                 "initialInvestment"        : {
                                                     required: "Please Enter Minimum Investment",
                                                 },
                                                 "holdingPeriod"            : {
                                                     required: "Please Enter Minimum Holding Period",
                                                 },
                                                 "total_sft"                : {
                                                     required: "Please Enter Total Sq ft",
                                                 },
                                                 "propertyOverview"         : {
                                                     required: "Please Enter Property Overview",
                                                 },
                                                 "propertyHighlights"       : {
                                                     required: "Please Enter Property Highlights",
                                                 },
                                                 "propertyLocationOverview" : {
                                                     required: "Please Enter Location Overview",
                                                 },
                                                 "locality"                 : {
                                                     required: "Please Enter Locality",
                                                 },
                                                 "yearOfConstruction"       : {
                                                     required: "Please Enter Year of Construction",
                                                 },
                                                 "propertyParking"          : {
                                                     required: "Please Enter Parking",
                                                 },
                                                 "floorforSale"             : {
                                                     required: "Please Enter Floor for Sale",
                                                 },
                                                 "propertyTotalBuildingArea": {
                                                     required: "Please Enter Total Building Area",
                                                 },
                                                 "propertyDetailsHighlights": {
                                                     required: "Please Enter Details Highlights",
                                                 },
                                                 "floorplan"                : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "investor"                 : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "brochure"                 : {
                                                     required: "Please Upload Brochure",
                                                 },
                                                 "titlereport"              : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "termsheet"                : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "comparabledetails"        : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "propertyManagementTeam"   : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "propertyUpdatesDoc"       : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "map"                      : {
                                                     accept: "Please Upload Valid format (pdf)",
                                                 },
                                                 "token_image"              : {
                                                     accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                                                 }
                                             },
                                             submitHandler: function (form) {
                                                 form.submit();
                                             }
                                         });
            $('.remove-rule-1').rules('remove');
            $('.remove-rule-2').rules('remove');
            $('.remove-rule-3').rules('remove');
        });
    </script>
@endsection
