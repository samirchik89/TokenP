@extends('admin.layout.base')

@section('title', 'Property List')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">

            <div class="box box-block bg-white">

                <h5 class="mb-1">Property List</h5>

                {{-- <a href="{{ route('admin.property.create', ['type' => 'asset-fund']) }}" style="margin-left: 1em;"
                    class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Asset Fund</a> --}}
                <a href="{{ route('admin.property.create', ['type' => 'property']) }}" style="margin-left: 1em;"
                    class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Property</a>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>Property Name</th>
                            <th>Property Type</th>
                            <th>Token Name</th>
                            <th>Token Network</th>
                            <th>Contract Address</th>
                            <th>Token Value</th>
                            <th>Token Symbol</th>
                            <th>Token Supply</th>
                            <th>Remaining Tokens</th>
                            <th>Commission (%)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($property as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $value->propertyName ? $value->propertyName : '-' }}</td>
                                <td>{{ $value->propertyType ? $value->propertyType : '-' }}</td>
                                <td>{{ @$value->userContract->tokenname }}</td>
                                <td>{{ @$value->userContract->coin }}</td>
                                <td>
                                    @if($value->status == 'active')
                                        <a href="{{ @$value->contract_link }}" target="_blank">{{substr(@$value->userContract->contract_address, 0, 5).'****'.substr(@$value->userContract->contract_address, -5)}}</a>
                                    @else
                                        ---
                                    @endif
                                </td>
                                <td>{{ @$value->userContract->tokenvalue }}</td>
                                <td>{{ @$value->userContract->tokensymbol }}</td>
                                <td>{{ @$value->userContract->tokensupply }}</td>
                                <td>{{ number_format(@$value->userContract->tokenbalance, 4) }}</td>
                                <td>{{ @$value->interest}}
                                    @if($value->interest)
                                        <a href="{{ url('/admin/edit_commission', $value->id) }}">Edit</a>
                                    @endif
                                </td>
                                <td>{{ $value->status == 'active' ? 'Live' : 'Pending'}}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <form name="delprop" action="" id="delprop" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="propid" id="propid" value="" />
        <input type="hidden" name="_method" value="DELETE">
    </form>
@endsection
@section('scripts')
    <script type="text/javascript">
        function DelProp(propid) {
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this property ?",
                    icon: "info",
                    buttons: true,
                    dangerMode: false,
                    buttons: ["No", "Yes"],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $("#delprop").attr('action', "/admin/property/" + propid);
                        $("#delprop").submit();
                    }
                });
        }


        $(".addFeature").on("change", function() {
            var id = $(this).attr("data-id");
            var url = "{{ url('/admin/propertyFeature') }}/" + id
            if ($(this).is(":checked")) {
                // swal({
                //         title: "Are you sure?",
                //         text: "You want to add this property in feature category ?",
                //         icon: "info",
                //         buttons: true,
                //         dangerMode: false,
                //         buttons: ["No", "Yes"],
                //     })
                //     .then((willDelete) => {
                //         if (willDelete) {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        if (data.status == 'success') {
                            swal('Feature updated successfully');
                        }
                    }
                });
                // }
                // });
            } else {
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        if (data.status == 'success') {
                            swal('Feature status updated successfully');
                        }
                    }
                });
            }
        });

        $(".status").on("change", function() {
            var id = $(this).data("id");
            var url = "{{ url('/admin/propertyStatus') }}/" + id;
            if ($(this).val() != '') {
                // swal({
                //         title: "Are you sure?",
                //         text: "You want to change the property status",
                //         icon: "info",
                //         buttons: true,
                //         dangerMode: false,
                //         buttons: ["No", "Yes"],
                //     })
                //     .then((willDelete) => {
                //         if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: "_token={{ csrf_token() }}&status=" + $(this).val(),
                                success: function(data) {
                                    if (data.status == 'success') {
                                        swal('Property status updated successfully');
                                    }
                                }
                            });
                        }
                    });
            // }
        // })
    </script>
@endsection
