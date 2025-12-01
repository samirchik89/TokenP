@extends('admin.layout.base')

@section('title', 'Create Fund')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">

                <a href="{{ route('admin.property.index') }}" class="btn btn-default pull-right"><i
                        class="fa fa-angle-left"></i> @lang('admin.back')</a>
                <h5 style="margin-bottom: 2em;">Create Fund</h5>
                <form class="form-horizontal" id="property-create" action="{{ url('/admin/property/assetfund') }}"
                    method="POST" enctype="multipart/form-data" role="form">
                    {{ csrf_field() }}
                    <input type="hidden" name="token_type" value="2">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="" class="col-form-label">Fund Client</label>
                            <select name="property_issuer" id="property_issuer" class="form-control" required>
                                <option value="">Select Issuer</option>
                                @foreach ($users as $user)
                                    <option value="{{ @$user->id }}">{{ @$user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="propertyName">@lang('admin.fund.create_fund')<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="propertyName" value="{{ old('propertyName') }}"
                                required="" data-parsley-required-message="Please enter @lang('admin.property.propertyname')"
                                id="propertyName" placeholder="@lang('admin.enter') @lang('admin.property.propertyname')"
                                data-parsley-maxlength="200" maxlength="200">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="propertyLogo">@lang('admin.fund.fund_logo')<span class="text-danger">*</span>&nbsp;<i
                                    style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                    title="Only allows png/jpeg format">&#xf05a;</i></label>
                            <input class="form-control" type="file" name="propertyLogo" accept="image/png,image/jpeg"
                                required data-parsley-required-message="Please choose @lang('admin.property.propertylogo')" id="propertyLogo"
                                placeholder="@lang('admin.placeholders.property_logo')">
                        </div>
                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label for="property_state">Project Status<span class="text-danger">*</span></label>
                                <select class="form-control" name="property_state" id="property_state" required>
                                    <option value="live">Live</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <div class="form-group">
                                <label for="show_property">Show Property Details<span class="text-danger">*</span></label>
                                <select class="form-control" name="show_property" id="show_property" required>
                                    <option value="">Select</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="totalDealSize">@lang('admin.totaldealsize')<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="totalDealSize"
                                value="{{ old('totalDealSize') }}" required data-parsley-type="digits"
                                data-parsley-required-message="Please enter @lang('admin.totaldealsize')" id="totalDealSize"
                                placeholder="@lang('admin.placeholders.total_deal_size')" min="0" max="999999999" step="any">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="expectedIrr">Expected Annual Return (%)<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="expectedIrr" id="expectedIrr"
                                value="{{ old('expectedIrr') }}"placeholder="Enter Expected Annual Return" required
                                data-parsley-type="digits" data-parsley-required-message="Please enter @lang('admin.inputs.expected irr')"
                                step="any">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="initialInvestment">Minimum Investment<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="initialInvestment"
                                value="{{ old('initialInvestment') }}" required data-parsley-type="digits"
                                data-parsley-required-message="Please enter @lang('admin.inputs.min_investment')" id="initialInvestment"
                                placeholder="@lang('admin.placeholders.min_investment')" min="0" max="999999999" step="any">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="fundedMembers">@lang('admin.fund.fundedMembers')<span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="fundedMembers"
                                value="{{ old('fundedMembers') }}" required data-parsley-type="digits"
                                data-parsley-required-message="Please enter @lang('admin.inputs.fundedMembers')" id="fundedMembers"
                                placeholder="@lang('admin.enter') @lang('admin.fund.fundedMembers')" min="0" min="0"
                                max="999999999" step="any">
                        </div>

                        {{-- <div class="col-md-3 form-group">
                            <label for="propertyEquityMultiple">@lang('admin.inputs.property_equity_multiple')</label>
                            <input class="form-control" type="number" name="propertyEquityMultiple" value="{{old('propertyEquityMultiple')}}" id="propertyEquityMultiple" placeholder="@lang('admin.placeholders.property_equity_multiple')" step="any" min="0" required data-parsley-type="digits" data-parsley-required-message="Please enter @lang('admin.inputs.property_equity_multiple')" min="0" max="100" step="any">
                        </div> --}}
                        <div class="col-md-3 form-group">
                            <label for="holdingPeriod">Minimum Holding Period<span class="text-danger">*</span></label>
                            <select class="form-control" name="holdingPeriod" required id="holdingPeriod">
                                    <option value="">Select Holding Period</option>
                                    @for($i=1; $i<=35; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                        </div>
                        {{-- <div class="col-md-3 form-group">
                            <label for="propertyLogo">Insert Video File<span class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows mp4/m4v format">&#xf05a;</i></label>
                            <input class="form-control" type="file" name="propertyVideo" required data-parsley-required-message="Please upload video file" accept="video/mp4,video/x-m4v,video/*" id="propertyLogo" data-parsley-filemaxsize="10" data-parsley-trigger="change" data-parsley-filemimetypes="video/mp4, video/x-m4v" >
                        </div> --}}
                    </div>

                    <h5 class="mt-2">@lang('admin.inputs.overview_details')</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyOverview">@lang('admin.fund.detail_overview')<span class="text-danger">*</span></label>
                                <textarea class="form-control" type="text" name="propertyOverview" required
                                    data-parsley-required-message="Please enter @lang('admin.inputs.detail_overview')" id="propertyOverview"
                                    placeholder="@lang('admin.placeholders.detail_overview')"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="propertyHighlights">@lang('admin.fund.detail_highlights')<span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" type="text" name="propertyHighlights" required id="propertyHighlights"
                                    placeholder="@lang('admin.enter') @lang('admin.fund.detail_highlights')"></textarea>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-2">@lang('admin.doc/reports')</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.labels.investordos')<span
                                        class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="investor"
                                    value="{{ old('investor') }}" accept="application/pdf" required
                                    id="propertyInvestor" data-parsley-required-message="Please choose Prospectus">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.labels.titlereport') <span
                                        class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="titlereport"
                                    value="{{ old('titlereport') }}" accept="application/pdf" id="propertyTitlereport"
                                    required data-parsley-required-message="Please choose Report">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Reports&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="termsheet" accept="application/pdf"
                                    id="termsheet">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Additional Information&nbsp;<i
                                        style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" accept="application/pdf"
                                    name="propertyUpdatesDoc" id="propertyUpdatesDoc">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">Brochure <span
                                        class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows pdf format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="brochure" accept="application/pdf"
                                    id="brochure">
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-2">Token Details</h5>
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
                                <input class="form-control" type="text" name="token_name"
                                    value="{{ old('token_name') }}" required id="tokenName"
                                    placeholder="@lang('admin.coin.tokenname')"
                                    data-parsley-required-message="Please enter Token Name">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensymbol')<span
                                        class="text-danger">*</span><i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only 4 characters are allowed ">&#xf05a;</i></label>
                                <input class="form-control" type="text" name="token_symbol"
                                    value="{{ old('token_symbol') }}" required id="tokenSymbol"
                                    placeholder="@lang('admin.coin.tokensymbol')"
                                    data-parsley-required-message="Please enter Token Symbol">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenvalue')
                                    ({{ Setting::get('default_currency') }})<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="token_value"
                                    value="{{ old('token_value') }}" required id="tokenValue"
                                    placeholder="@lang('admin.coin.tokenvalue')"
                                    data-parsley-required-message="Please enter Token Value">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokensupply')<span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="token_supply"
                                    value="{{ old('token_supply') }}" required id="tokenSupply"
                                    placeholder="@lang('admin.coin.tokensupply')" data-parsley-required-message="Please enter Supply">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokendecimal')<span
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
                                <label for="" class="col-form-label">@lang('admin.token_to_be_issued')<span
                                        class="text-danger">*</span></label>
                                <br>
                                <input type="radio" name="tokentype" class="tokentype" value="ERC20" checked>
                                @lang('admin.erc20_utility')<br>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="" class="col-form-label">@lang('admin.coin.tokenimage')<span
                                        class="text-danger">*</span>&nbsp;<i style="font-size:14px;cursor: pointer;"
                                        class="fa" data-toggle="tooltip"
                                        title="Only allows png/jpeg format">&#xf05a;</i></label>
                                <input class="form-control" type="file" name="token_image" required id="tokenImage"
                                    accept="image/png,image/jpeg"
                                    data-parsley-required-message="Please upload Token Image">
                            </div>
                        </div>
                    </div>

                    <h5>Management Team</h5>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="" class="col-form-label">Management Team Description</label>
                            <textarea class="form-control" type="text" name="ManagementTeamDescription" required id="propertyOverview"
                                placeholder="Enter Management Team Description" data-parsley-required-message="Please enter Management Team"></textarea>
                        </div>
                    </div>
                    <h6>Management Members</h6>
                    <div id="divManagementMembers" data-id="0"></div>
                    {{-- <button type="button" class="btn btn-info" id="AddMember">+ Add Member</button> --}}
                    <div class="row"></div>
                    {{-- <div class="col-md-12">
                        <h5>Updates</h5>
                        <div id="updates" data-id="0"></div>
                        <button type="button" class="btn btn-info" id="Addupdates">+ Add Updates</button>
                    </div> --}}
                    <div class="form-group row">
                        <label for="" class="col-xs-2 col-form-label"></label>
                        <div class="col-xs-10">
                            <button type="submit" class="btn btn-primary">Create</button>
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
        var n = 2;
        $("#add_landmark").click(function() {
            var html = '<div id="landmark_block_' + n +
                '" class="form-group row"><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Name</label><input class="form-control" type="text" name="landmarks[' +
                n + '][landmarkName]" required id="landmarkName_' + n +
                '" placeholder="Enter landmark name"></div><div class="form-group col-md-5"><label for="" class="col-form-label">Landmark Distance</label><input class="form-control" type="number" name="landmarks[' +
                n + '][landmarkDist]" required id="landmarkDist_' + n +
                '" placeholder="Enter landmark distance" min="0" step="any"></div><div class="form-group col-md-2"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' +
                n + '" onclick="landmark_remove(' + n + ');" >X</button></div></div>';
            $("#landmark_section").append(html);
            n = n + 1;
        });

        function landmark_remove(n) {
            $("#landmark_block_" + n).remove();
        }

        $("#add_comparables").click(function() {
            var html = '<div id="comparables_block_' + n +
                '" class="form-group row"><div class="form-group col-md-3"><label for="" class="col-form-label">Property Address</label><input class="form-control" type="text" name="comparables[' +
                n + '][property]" required id="property_' + n +
                '" placeholder="Property Address"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Date</label><input class="form-control" type="text" name="comparables[' +
                n + '][type]" required id="type_' + n +
                '" placeholder="Sale Date"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Location</label><input class="form-control" type="text" name="comparables[' +
                n + '][location]" required id="location_' + n +
                '" placeholder="Location"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Year of Build</label><input class="form-control" type="number" name="comparables[' +
                n + '][distanaccept="image/png,image/jpeg"ce]" required id="distance_' + n +
                '" placeholder="Year of Build" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Total Sft</label><input class="form-control" type="number" name="comparables[' +
                n + '][rent]" required id="rent_' + n +
                '" placeholder="Total Sft" min="0" step="any"></div><div class="form-group col-md-3"><label for="" class="col-form-label">Sale Price</label><input class="form-control" type="number" name="comparables[' +
                n + '][saleprice]" required id="saleprice_' + n +
                '" placeholder="Sale Price" min="0" step="any"></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Property Logo</label><input class="form-control" type="file" name="propertyVideo" accept="image/png,image/jpeg"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Map</label><input class="form-control" type="file" name="map" accept=".pdf"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="col-md-3"><div class="form-group"><label for="propertyLogo">Comparables Details</label><input class="form-control" type="file" name="comparabledetails" accept=".pdf"  required id="propertyLogo" placeholder="Enter Property Logo"></div></div><div class="form-group col-md-3"><button type="button" class="btn btn-danger landmark_remove" id="landmark_remove_' +
                n + '" onclick="comparables_remove(' + n + ');" >X</button></div></div>';
            $("#comparables_section").append(html);
            n = n + 1;
        });

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
                '		<input class="form-control" type="text" name="member[' + index + '][name]" id="MemberName_' + index +
                '" placeholder="Enter Member Name">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Position</label>' +
                '		<input class="form-control" type="text" name="member[' + index + '][position]" id="MemberPosition_' +
                index + '" placeholder="Enter Member Position">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Image&nbsp;<i style="font-size:14px;cursor: pointer;" class="fa" data-toggle="tooltip" title="Only allows png/jpeg format">&#xf05a;</i></label>' +
                '		<input class="form-control" type="file" name="member[' + index + '][pic]"  id="MemberPic_' + index +
                '" accept="image/png,image/jpeg" placeholder="Select Member Picture">' +
                '	</div>' +
                '	<div class="col-md-3 form-group">' +
                '		<label for="" class="col-form-label">Member Description</label>' +
                '		<input class="form-control" type="text" name="member[' + index +
                '][description]" required id="MemberDescription_' + index + '" placeholder="Enter Description">' +
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
                '][date]" required id="date" placeholder="Date" data-parsley-required-message="Please enter Update Date">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-3">' +
                '<div class="form-group">' +
                '<label for="" class="col-form-label">Update Description</label>' +
                '<input class="form-control" type="text" name="updates[' + index +
                '][description]" required id="date" placeholder="Please enter Description" data-parsley-required-message="Please enter Update Description">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-1">' +
                '' + ((index > 0) ? removeBtn : '') +
                '<div>' +
                '<div>';
            $("#updates").attr('data-id', index).append(temp);
        }
    </script>
    <script>
            $('#tokenValue').on('keyup',function(){
              var totalDealSize=$('#totalDealSize').val();
                var tokenvalue=$('#tokenValue').val();
                if(totalDealSize==0||totalDealSize==''){
                    $('#tokenSupply').val(0);
    
                }else if(tokenvalue==0||tokenvalue==''){
                    $('#tokenSupply').val(0);
    
                }
                var supply=totalDealSize/tokenvalue;       
                $('#tokenSupply').val(supply);
                
            });
            </script>
             <script>
                $('#totalDealSize').on('keyup',function(){
                  var totalDealSize=$('#totalDealSize').val();
                  console.log(totalDealSize);
                    var tokenvalue=$('#tokenValue').val();
                    console.log(tokenvalue);
                    if(totalDealSize==0||totalDealSize==''){
                        $('#tokenSupply').val(0);
                        // $('#totalDealSize').val(0);
        
                    }else if(tokenvalue==0||tokenvalue==''){
                        $('#tokenSupply').val(0);


        
                    }
                    var supply=totalDealSize/tokenvalue;       
                    $('#tokenSupply').val(supply);
                    
                });
                </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#property-create").validate({
                rules: {
                    "propertyName": {
                        required: true,
                        maxlength: 200,
                    },
                    "propertyLocation": {
                        required: true,
                        maxlength: 200,
                    },
                    "propertyLogo": {
                        required: true,
                        accept: 'image/jpeg, image/png, image/jpg, image/bmp',
                    },
                    "propertyType": {
                        required: true,
                    },
                    "totalDealSize": {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    "expectedIrr": {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    "initialInvestment": {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    "propertyEquityMultiple": {
                        required: false,
                        number: true,
                        min: 0,
                    },
                    "holdingPeriod": {
                        required: true,
                        number: true,
                        min: 0,
                    },
                    "total_sft": {
                        required: false,
                        number: true,
                        min: 0,
                    },
                    "propertyOverview": {
                        required: true,
                    },
                    "propertyHighlights": {
                        required: true,
                    },
                    "propertyLocationOverview": {
                        required: true,
                    },
                    "locality": {
                        required: false,
                        maxlength: 200,
                    },
                    "yearOfConstruction": {
                        required: false,
                        number: true,
                        min: 0,
                        maxlength: 4,
                    },
                    "storeys": {
                        required: false,
                    },
                    "propertyParking": {
                        required: false,
                        maxlength: 200,
                    },
                    "floorforSale": {
                        required: false,
                        number: true,
                        min: 0,
                    },
                    "propertyTotalBuildingArea": {
                        required: false,
                        number: true,
                        min: 0,
                    },
                    "propertyDetailsHighlights": {
                        required: false,
                    },
                    "floorplan": {
                        required: false,
                        accept: 'pdf',
                    },
                    "investor": {
                        required: true,
                        accept: 'pdf',
                    },
                    "titlereport": {
                        required: true,
                        accept: 'pdf',
                    },
                    "termsheet": {
                        required: false,
                        accept: 'pdf',
                    },
                    "propertyimages": {
                        required: true,
                        accept: 'image/jpeg, image/png, image/jpg, image/bmp',
                    },
                    "management": {
                        required: true,
                    },
                    "updates": {
                        required: false,
                    },
                    "propertylogoimage": {
                        required: true,
                        accept: 'image/jpeg, image/png, image/jpg, image/bmp',
                    },
                    "propertyVideo": {
                        required: false,
                        accept: 'video/mp4,video/x-m4v',
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
                    },
                    "token_symbol": {
                        required: true,
                        minlength: 3,
                        maxlength: 4,
                    },
                    "token_value": {
                        required: true,
                        number: true,
                    },
                    "token_decimal": {
                        required: true,
                        digits: true,
                        maxlength: 2,
                    },
                    "propertyManagementTeam": {
                        required: false,
                        accept: 'pdf',
                    },
                    "propertyUpdatesDoc": {
                        required: false,
                        accept: 'pdf',
                    },
                },
                messages: {
                    "propertyName": {
                        required: "Please Enter Fund Name",
                    },
                    "propertyLocation": {
                        required: "Please Enter Fund Location",
                    },
                    "propertyLogo": {
                        required: "Please Choose Fund Logo",
                        accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                    },
                    "propertyVideo": {
                        required: "Please Choose Fund Logo",
                        accept: "Please Upload Valid format (mp4|x-m4v)",
                    },
                    "management": {
                        required: "Please Upload Management",
                    },
                    "updates": {
                        required: "Please Upload Updates",
                    },
                    "propertylogoimage": {
                        required: "Please Choose Fund Logo",
                        accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                    },
                    "propertyimages": {
                        required: "Please Choose Fund Logo",
                        accept: "Please Upload Valid format (jpeg|png|jpg|bmp)",
                    },
                    "totalDealSize": {
                        required: "Please Enter Total Deal Size",
                    },
                    "expectedIrr": {
                        required: "Please Enter Expected Annual Return",
                    },
                    "initialInvestment": {
                        required: "Please Enter Minimum Investment",
                    },
                    "holdingPeriod": {
                        required: "Please Enter Minimum Holding Period",
                    },
                    "total_sft": {
                        required: "Please Enter Total Sq ft",
                    },
                    "propertyOverview": {
                        required: "Please Enter Fund Overview",
                    },
                    "propertyHighlights": {
                        required: "Please Enter Fund Highlights",
                    },
                    "propertyLocationOverview": {
                        required: "Please Enter Location Overview",
                    },
                    "locality": {
                        required: "Please Enter Locality",
                    },
                    "yearOfConstruction": {
                        required: "Please Enter Year of Construction",
                    },
                    "propertyParking": {
                        required: "Please Enter Parking",
                    },
                    "floorforSale": {
                        required: "Please Enter Floor for Sale",
                    },
                    "propertyTotalBuildingArea": {
                        required: "Please Enter Total Building Area",
                    },
                    "propertyDetailsHighlights": {
                        required: "Please Enter Details Highlights",
                    },
                    "floorplan": {
                        required: "Please Choose Floor Plan",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "investor": {
                        required: "Please Choose Investor Document",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "titlereport": {
                        required: "Please Choose Report",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "termsheet": {
                        required: "Please Choose Term Sheet",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "comparabledetails": {
                        required: "Please Choose Term Sheet",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "map": {
                        required: "Please Choose Term Sheet",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "propertyManagementTeam": {
                        required: "Please Choose Management Team Report",
                        accept: "Please Upload Valid format (pdf)",
                    },
                    "propertyUpdatesDoc": {
                        required: "Please Choose Updates Report",
                        accept: "Please Upload Valid format (pdf)",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
    <script>
        $(document).ready(function() {
            $("input[type=text], input[type=radio], input[type=file], textarea, select, input[type=number]").blur(
                function() {
                    if ($(this).val() != "") {
                        Cookies.set('token_asset_' + $(this).attr('name'), $(this).val(), {
                            expires: 1
                        });
                        console.log($(this).val());
                        console.log($(this).attr('name'));
                    }
                });

            $("input[type=text], textarea, select, input[type=radio],  input[type=number]").each(function() {
                var cookval = Cookies.get('token_asset_' + $(this).attr('name'));
                if ($(this).attr('type') == "radio") {
                    var inpname = $(this).attr('name');
                    $("input[name=" + inpname + "][value=" + cookval + "]").prop("checked", true);
                } else {
                    $(this).val(cookval);
                }
            });
        });
    </script>
@endsection
