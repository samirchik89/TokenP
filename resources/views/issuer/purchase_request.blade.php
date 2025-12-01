@extends('issuer.layout.base')
@section('content')
    <!-- Start Page Content here -->
    <div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Purchase Requests</h1>
                    </div>
                    <div class="col-sm-6">
                        @include('issuer.layout.breadcrumb',['items' => [
                            [
                                'url' => 'issuer/dashboard',
                                'title' => 'Dashboard'
                            ],
                            [
                                'title' => 'Purchase Requests'
                            ]
                        ]])
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="container-fluid wizard-border">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <div>
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>User</th>
                                                    <th>Property Name</th>
                                                    <th>Country</th>
                                                    <th>Status</th>
                                                    <th>View KYC</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($whitelistRequests as $index => $value)
                                                <tr>
                                                    <td>{{$index+1}}</td>
                                                    <td>{{$value->user->name}}</td>
                                                    <td>{{$value->property->propertyName}}</td>
                                                    <td>{{$value->user->country->countryname ?? 'N/A' }}</td>
                                                    <td>{{$value->status}}</td>
                                                    <td><a href="{{ url('/issuer/view_kyc', $value->user_id) }}">View</a></td>
                                                    <td>
                                                        <a href="{{ url('issuer/update_purchase_request', [$value->id, 'Approved']) }}" class="btn btn-success btn-sm">Approve</a>
                                                        <button class="btn btn-danger btn-sm" onclick="openRejectModal({{ $value->id }})">Reject</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="modal" id="rejectModal" style="display:none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5);">
                                <div class="modal-dialog" style="margin: 10% auto; max-width: 500px;">
                                    <div class="modal-content border-0">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel">Reject Request</h5>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="rejectRequestId">
                                            <div class="mb-3">
                                                <label for="rejectionNote" class="form-label">Rejection Note</label>
                                                <textarea class="form-control" id="rejectionNote" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" onclick="closeRejectModal()">Close</button>
                                            <a href="#" id="finalRejectUrl" class="btn btn-danger btn-sm">Reject</a>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- END content-page -->

<script>
    let selectedRequestId = null;

    function openRejectModal(requestId) {
        selectedRequestId = requestId;
        document.getElementById('rejectRequestId').value = requestId;
        document.getElementById('rejectionNote').value = '';
        document.getElementById('finalRejectUrl').setAttribute('href', '#'); // Reset
        document.getElementById('rejectModal').style.display = 'block';
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
    }

    document.getElementById('rejectionNote').addEventListener('input', function () {
        const note = document.getElementById('rejectionNote').value.trim();
        const baseUrl = `/issuer/update_purchase_request/${selectedRequestId}/Cancelled`;
        const finalUrl = `${baseUrl}?note=${encodeURIComponent(note)}`;
        document.getElementById('finalRejectUrl').setAttribute('href', finalUrl);
    });
</script>


@endsection

