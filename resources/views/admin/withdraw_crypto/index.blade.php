@extends('admin.layout.base')

@section('title', 'Withdraw Request')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Withdraw Request</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraw_requests as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('F d, Y h:i A') }}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}} {{$value->coin}}</td>
                        <td>{{$value->receiver}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$index}}">Approve</button>
                            <a href="{{url('admin/update_crypto_withdraw',[$value->id,'cancelled'])}}" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
                    @endforeach
                    @foreach($withdraw_requests as $index => $value)
                    <div class="modal fade" id="exampleModal{{$index}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ url('admin/update_crypto_request') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="symbol" class="col-xs-12 col-form-label">Transaction Hash</label>
                                        <div class="col-xs-10">
                                            <input type="hidden" name="id" value="{{$value->id}}">
                                            <input style="width:110%" class="form-control" type="text" name="hash" required placeholder="Transaction Hash">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<!-- Include SweetAlert CSS and JS via CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.approveButton').forEach(function(button) {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent the default action of the link

            // Show SweetAlert confirmation popup
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to approve this deposit?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href;
                }
            });
        });
    });
</script>
@endsection
