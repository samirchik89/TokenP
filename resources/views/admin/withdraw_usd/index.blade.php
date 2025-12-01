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
                        <th>Amount ($)</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requests as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ \Carbon\Carbon::parse($value->created_at)->format('F d, Y h:i A') }}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}}</td>
                        <td>
                            <?php $details = json_decode($value->receiver); ?>
                            Bank Name : {{$details[2]}},<br>
                            Account : {{$details[0]}},<br>
                            {{-- IFSC Code : {{$details[1]}} --}}
                        </td>
                        <td>
                            <a href="{{url('admin/update_withdraw',[$value->id,'success'])}}" class="btn btn-primary approveButton">Approve</a>
                            <a href="{{url('admin/update_withdraw',[$value->id,'cancelled'])}}" class="btn btn-danger">Cancel</a>
                        </td>
                    </tr>
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
                    // If confirmed, navigate to the URL
                    window.location.href = this.href;
                }
            });
        });
    });
</script>
@endsection
