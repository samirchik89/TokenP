@extends('admin.layout.base')

@section('title', 'Edit Fund')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">

                <a href="{{ route('admin.property.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> @lang('admin.back')</a>

                <h5 style="margin-bottom: 2em;">Edit Fund</h5>

                <form class="form-horizontal" id="property-edit" action="{{url('/admin/property/'.$property->id)}}" method="POST" enctype="multipart/form-data" role="form">
                    {{csrf_field()}}
                    {{ method_field("PUT") }}
                    <input type="hidden" name="token_type" value="2">
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Fund Name</label>
                        <input class="form-control" type="text" name="propertyName" required id="propertyName" placeholder="Enter Fund Name" required maxlength="200" value="{{ @$property->propertyName }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Fund Logo</label>
                        <input class="form-control" type="file" name="propertyLogo" accept="image/png,image/jpeg" id="propertyLogo">
                        @if($property->propertyLogo)
                            <img src="{{ img($property->propertyLogo) }}" width="200px" class="thumbnail"/>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="property_state">Project Status<span class="text-danger">*</span></label>
                            <select class="form-control" name="property_state" id="property_state" required>
                                {{-- <option value="">Select</option> --}}
                                @if($property->property_state == 'live')
                                <option value="live" selected="selected">Live</option>
                                {{-- <option value="comingsoon" >Coming Soon</option> --}}
                                @elseif($property->property_state == 'comingsoon')
                                <option value="live" >Live</option>
                                {{-- <option value="comingsoon" selected="selected">Coming Soon</option> --}}
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 form-group">
                        <div class="form-group">
                            <label for="show_property">Show Property Details<span class="text-danger">*</span></label>
                            <select class="form-control" name="show_property" id="show_property" required>
                                <option value="">Select</option>
                                @if($property->show_property == 'yes')
                                <option value="yes" selected="selected">yes</option>
                                <option value="no">no</option>
                                @else
                                <option value="yes">yes</option>
                                <option value="no" selected="selected">no</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <div class="form-group">
                            <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="totalDealSize" required id="totalDealSize" placeholder="@lang('admin.placeholders.total_deal_size')" min="0" value="{{ @$property->totalDealSize }}">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Expected Annual Return (%)<span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="expectedIrr" required id="expectedIrr" placeholder="Enter Expected Annual Return" min="0" value="{{ @$property->expectedIrr }}" step="any">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Minimum Investment <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="initialInvestment" required id="initialInvestment" placeholder="Enter Minimum Investment" min="0" value="{{ @$property->initialInvestment }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">@lang('admin.fund.fundedMembers') <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="fundedMembers" required id="fundedMembers" placeholder="Enter Funded Members" min="0" value="{{ @$property->fundedMembers }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Minimum Holding Period <span class="text-danger">*</span></label>
                        <select class="form-control" name="holdingPeriod" required id="holdingPeriod">
                            <option value="">Select Holding Period</option>
                            @for($i=1; $i<=35; $i++)
                                <option value="{{$i}}" {{$property->holdingPeriod == $i ? 'selected':''}}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        {{-- <div class="form-group">
                            <label for="propertyLogo">Insert Video File <span class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows mp4/m4v format">&#xf05a;</i></label>
                            <input class="form-control" type="file" name="propertyVideo" accept="video/mp4,video/x-m4v,video/*" id="propertyLogo" placeholder="Enter Property Logo">
                            @if(@$property->propertyVideo)
                                <video width="200" class="thumbnail" controls="controls">
                                    <source src="{{ @img($property->propertyVideo) }}">
                                </video>
                            @endif
                        </div> --}}
                    </div>

                    <div class="row"></div>
                    <h5>Overview Details</h5>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Fund Overview <span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="propertyOverview" required id="propertyOverview" placeholder="Enter Fund Overview">{{ @$property->propertyOverview }}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="" class="col-form-label">Fund Highlights <span class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="propertyHighlights" required id="propertyHighlights" placeholder="Enter Fund Overview">{{ @$property->propertyHighlights }}</textarea>
                    </div>
                    <div class="row"></div>
                    <br>
                    <h5>Documents / Reports</h5>
                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.labels.investordos') <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="investor" accept="application/pdf" id="propertyInvestor">
                            <a href="{{ @img($property->investor) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'investor')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">@lang('admin.labels.titlereport') <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="titlereport" accept="application/pdf" id="propertyTitlereport">
                            <a href="{{ @img($property->titlereport) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'titlereport')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Reports</label>
                            <input class="form-control" type="file" name="termsheet" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*" id="termsheet">
                            <a href="{{ @img($property->termsheet) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp; <a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'termsheet')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Additional Information</label>
                            <input class="form-control" type="file" accept="application/pdf" name="propertyUpdatesDoc" id="propertyUpdatesDoc">
                            <a href="{{ @img($property->propertyUpdatesDoc) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'propertyUpdatesDoc')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <div class="form-group">
                            <label for="" class="col-form-label">Brochure</label>
                            <input class="form-control" type="file" name="brochure" accept="application/pdf" id="brochure">
                            <a href="{{ @img($property->brochure) }}" target="_blank" rel="noopener noreferrer">View</a>
                            &nbsp;&nbsp;<a href="javascript:void(0)" onclick="documentdelete({{@$property->id}},'brochure')"><i class="fa fa-trash"></i>Delete</a>
                        </div>
                    </div>

                    {{-- <div class="form-group col-md-4" style="display: none">
                        <div class="form-group">
                            <label for="" class="col-form-label">Management Team</label>
                            <input class="form-control" type="file" accept="application/pdf" name="propertyManagementTeam" required id="propertyManagementTeam">
                            <a href="{{ @img($property->propertyManagementTeam) }}" target="_blank" rel="noopener noreferrer">View</a>
                        </div>
                    </div> --}}

                    <div class="row"></div>
                    <br>
                    <h5>Token Details</h5>
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
                        <input class="form-control" type="number" name="token_value" required id="tokenValue" placeholder="Token Value" value="{{ @$property->issuerToken->usdvalue }}">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="" class="col-form-label">Token Supply <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="token_supply" required id="tokenSupply" placeholder="Token Supply" value="{{ @$property->issuerToken->supply }}">
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
                        <img src="{{ img(@$property->issuerToken->token_image) }}" width="200px" class="thumbnail"/>
                    </div>


                    <h5>Management Team</h5>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Management Team Description</label>
                            <textarea class="form-control" type="text" name="ManagementTeamDescription" required id="propertyOverview" placeholder="Enter Management Team Description">{{ @$property->ManagementTeamDescription }}</textarea>
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
                                    <input class="form-control" type="text" name="member[{{ $key }}][position]" id="MemberPosition_{{ $key }}" placeholder="Enter Member Position" value="{{ $member->memberPosition }}">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Image</label>
                                    <input class="form-control" type="file" name="member[{{ $key }}][pic]" @if(empty($member->memberPic)) @endif id="MemberPic_{{ $key }}" accept="image/png,image/jpeg" placeholder="Select Member Picture">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="" class="col-form-label">Member Description</label>
                                    <input class="form-control" type="text" name="member[{{ $key }}][description]" required id="MemberDescription_{{ $key }}" placeholder="Enter Description" value="{{ $member->memberDescription }}">
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
                                        <input class="form-control" type="date" name="updates[{{ $key }}][date]" id="datechecks" placeholder="Date" value="{{ $update->date }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="" class="col-form-label">Update Description</label>
                                        <input class="form-control" type="text" name="updates[{{ $key }}][description]" id="date" placeholder="Please enter Description" value="{{ $update->description }}">
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
                            {{-- <a href="{{route('admin.property.index')}}" class="btn btn-default">@lang('admin.cancel')</a> --}}
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
    function documentdelete(id,columnname) {
        if (confirm("Are you sure ?")) {
            $.ajax({
                       url     : "{{url('admin/propertydocumentdelete')}}",
                       type    : "POST",
                       data    : {
                           id        : id,
                           columnname: columnname,
                           _token    : '{{csrf_token()}}'
                       },
                       dataType: 'json',
                   }).done(function (response) {
                if (response == '1') {
                    alert('Updated succesfully');
                } else {
                    alert('Try Again');
                }
            });
        }
    }

        var n =<?php echo count($property->propertyLandmark) ?>;
        $("#add_landmark").click(function () {
            var html = '<div id="landmark_block_' + n + '" class="form-group row"><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Name</label><input class="form-control" type="text" name="landmarks[' + n + '][landmarkName]" required id="landmarkName_' + n + '" placeholder="Enter landmark name"></div><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Distance</label><input class="form-control" type="number" name="landmarks[' + n + '][landmarkDist]" required id="landmarkDist_' + n + '" placeholder="Enter landmark distance" min="0" step="any"></div><div class="form-group col-md-2"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + n + '" onclick="landmark_remove(' + n + ');" >X</button></div></div>';
            $("#landmark_section").append(html);
            n = n + 1;
        });

        //Document delete
        
        function landmark_remove(n) {
            $("#landmark_block_" + n).remove();
        }

        var j = <?php echo count($property->propertyComparable) ?>;
        $("#add_comparables").click(function () {
            var html = '<div id="comparables_block_' + j + '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Property Address</label><input class="form-control" type="text" name="comparables[' + j + '][property]" required id="property_' + j + '" placeholder="Property Address"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Date</label><input class="form-control" type="text" name="comparables[' + j + '][type]" required id="type_' + j + '" placeholder="Sale Date"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Location</label><input class="form-control" type="text" name="comparables[' + j + '][location]" required id="location_' + j + '" placeholder="Location"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Year of Build</label><input class="form-control" type="number" name="comparables[' + j + '][distanaccept="image/png,image/jpeg"ce]" required id="distance_' + j + '" placeholder="Year of Build" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Total Sft</label><input class="form-control" type="number" name="comparables[' + j + '][rent]" required id="rent_' + j + '" placeholder="Total Sft" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Price</label><input class="form-control" type="number" name="comparables[' + j + '][saleprice]" required id="saleprice_' + j + '" placeholder="Sale Price" min="0" step="any"></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Property Logo</label><input class="form-control" type="file" name="propertylogoimage" accept="image/png,image/jpeg"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Map</label><input class="form-control" type="file" name="map" accept=".pdf"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Comparables Details</label><input class="form-control" type="file" name="comparabledetails" accept=".pdf"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' + j + '" onclick="comparables_remove(' + j + ');" >X</button></div></div>';
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
                '	</div>' +'	<div class="col-md-3 form-group">' +
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
    // <script type="text/javascript">
    //     $(document).ready(function () {
    //         $("#property-edit").validate({
    //                                          rules        : {
    //                                              "propertyName"             : {
    //                                                  required : true,
    //                                                  maxlength: 200,
    //                                              },
    //                                              "propertyLocation"         : {
    //                                                  required : true,
    //                                                  maxlength: 200,
    //                                              },
    //                                              "propertyLogo"             : {
    //                                                  required: {{ empty(@$property->propertyLogo) ? 'true' : 'false' }},
    //                                                  accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
    //                                              },
    //                                              "propertyType"             : {
    //                                                  required: true,
    //                                              },
    //                                              "totalDealSize"            : {
    //                                                  required: true,
    //                                                  number  : true,
    //                                                  min     : 0,
    //                                              },
    //                                              "expectedIrr"              : {
    //                                                  required : true,
    //                                                  number   : true,
    //                                                  min      : 0,
    //                                              },
    //                                              "initialInvestment"        : {
    //                                                  required: true,
    //                                                  number  : true,
    //                                                  min     : 0,
    //                                              },
    //                                              "holdingPeriod"            : {
    //                                                  required: true,
    //                                                  number  : true,
    //                                                  min     : 0,
    //                                              },
    //                                              "total_sft"                : {
    //                                                  required: false,
    //                                                  number  : true,
    //                                                  min     : 0,
    //                                              },
    //                                              "propertyOverview"         : {
    //                                                  required: true,
    //                                              },
    //                                              "propertyHighlights"       : {
    //                                                  required: true,
    //                                              },
    //                                              "propertyLocationOverview" : {
    //                                                  required: true,
    //                                              },
    //                                              "locality"                 : {
    //                                                  required : false,
    //                                                  maxlength: 200,
    //                                              },
    //                                              "yearOfConstruction"       : {
    //                                                  required : false,
    //                                                  number   : true,
    //                                                  min      : 0,
    //                                                  maxlength: 4,
    //                                              },
    //                                              "propertyTotalBuildingArea": {
    //                                                  required: false,
    //                                                  number  : true,
    //                                                  min     : 0,
    //                                              },
    //                                              "propertyDetailsHighlights": {
    //                                                  required: true,
    //                                              },
    //                                              "floorplan"                : {
    //                                                  required: true,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "investor"                 : {
    //                                                  required: {{ empty(@$property->investor) ? 'true' : 'false' }},
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "titlereport"              : {
    //                                                  required: false,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "termsheet"                : {
    //                                                  required: false,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "propertyManagementTeam"   : {
    //                                                  required: false,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "propertyUpdatesDoc"       : {
    //                                                  required: false,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "propertyimages"           : {
    //                                                  required: true,
    //                                                  accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
    //                                              },
    //                                              "management"               : {
    //                                                  required: true,
    //                                              },
    //                                              "updates"                  : {
    //                                                  required: true,
    //                                              },
    //                                              "propertylogoimage"        : {
    //                                                  required: true,
    //                                                  accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
    //                                              },
    //                                              "propertyVideo"            : {
    //                                                  required: false,
    //                                                  accept  : 'video/mp4,video/x-m4v'
    //                                              },
    //                                              "map"                      : {
    //                                                  required: true,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "comparabledetails"        : {
    //                                                  required: true,
    //                                                  accept  : 'pdf',
    //                                              },
    //                                              "token_name"               : {
    //                                                  required: true,
    //                                              },
    //                                              "token_symbol"             : {
    //                                                  required : true,
    //                                                  minlength: 3,
    //                                                  maxlength: 4,
    //                                              },
    //                                              "token_value"              : {
    //                                                  required: true,
    //                                                  number  : true,
    //                                              },
    //                                              "token_decimal"            : {
    //                                                  required : true,
    //                                                  digits   : true,
    //                                                  maxlength: 2,
    //                                              },
    //                                              "token_image"              : {
    //                                                  required: {{ empty(@$property->issuerToken->token_image) ? 'true' : 'false' }},
    //                                                  accept  : 'image/jpeg, image/png, image/jpg, image/bmp',
    //                                              }
    //                                          },
    //                                          messages     : {
    //                                              "propertyName"             : {
    //                                                  required: "Please Enter Fund Name",
    //                                              },
    //                                              "propertyLocation"         : {
    //                                                  required: "Please Enter Fund Location",
    //                                              },
    //                                              "propertyLogo"             : {
    //                                                  accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
    //                                              },
    //                                              "propertyVideo"            : {
    //                                                  accept: "Please Upload Valid format (mp4|x-m4v)",
    //                                              },
    //                                              "management"               : {
    //                                                  required: "Please Upload Management",
    //                                              },
    //                                              "updates"                  : {
    //                                                  required: "Please Upload Updates",
    //                                              },
    //                                              "propertylogoimage"        : {
    //                                                  accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
    //                                              },
    //                                              "propertyimages"           : {
    //                                                  accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
    //                                              },
    //                                              "totalDealSize"            : {
    //                                                  required: "Please Enter Total Deal Size",
    //                                              },
    //                                              "expectedIrr"              : {
    //                                                  required: "Please Enter Expected IRR",
    //                                              },
    //                                              "initialInvestment"        : {
    //                                                  required: "Please Enter InitialInvestment",
    //                                              },
    //                                              "propertyEquityMultiple"   : {
    //                                                  required: "Please Enter Property Equity Multiple",
    //                                              },
    //                                              "holdingPeriod"            : {
    //                                                  required: "Please Enter Holding Period",
    //                                              },
    //                                              "total_sft"                : {
    //                                                  required: "Please Enter Total SFT",
    //                                              },
    //                                              "propertyOverview"         : {
    //                                                  required: "Please Enter Fund Overview",
    //                                              },
    //                                              "propertyHighlights"       : {
    //                                                  required: "Please Enter Fund Highlights",
    //                                              },
    //                                              "propertyLocationOverview" : {
    //                                                  required: "Please Enter Location Overview",
    //                                              },
    //                                              "locality"                 : {
    //                                                  required: "Please Enter Locality",
    //                                              },
    //                                              "yearOfConstruction"       : {
    //                                                  required: "Please Enter Year of Construction",
    //                                              },
    //                                              "propertyParking"          : {
    //                                                  required: "Please Enter Parking",
    //                                              },
    //                                              "floorforSale"             : {
    //                                                  required: "Please Enter Floor for Sale",
    //                                              },
    //                                              "propertyTotalBuildingArea": {
    //                                                  required: "Please Enter Total Building Area",
    //                                              },
    //                                              "propertyDetailsHighlights": {
    //                                                  required: "Please Enter Details Highlights",
    //                                              },
    //                                              "floorplan"                : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "investor"                 : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "titlereport"              : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "termsheet"                : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "propertyManagementTeam"   : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "propertyUpdatesDoc"       : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "comparabledetails"        : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "map"                      : {
    //                                                  accept: "Please Upload Valid format (pdf)",
    //                                              },
    //                                              "token_image"              : {
    //                                                  accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
    //                                              }
    //                                          },
    //                                          submitHandler: function (form) {
    //                                              form.submit();
    //                                          }
    //                                      });
    //     });
    // </script>
@endsection
