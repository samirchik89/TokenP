@extends('admin.layout.base')

@section('title', 'Users ')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            <select style="margin-left: 1em; width:15%; height:4.5%" class="pull-right" id="userType">
                <option value="All">Select All</option>
                <option value="Issuer">Issuer</option>
                <option value="Investor">Investor</option>
            </select>

            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>@lang('admin.id')</th>
                        <th>Name</th>
                        <th>@lang('admin.email')</th>
                        <th>@lang('admin.status')</th>
                        <th>Address</th>
                        <th>Identification</th>
                        <th>@lang('admin.action')</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="user-status-col">
                                @if ($user->approved == 1)
                                    Verified <span class="success-span" style=""><i class="fa fa-check" aria-hidden="true"></i></span>
                                @else
                                    Pending <span class="failed-span" style=""><i class="fa fa-times" aria-hidden="true"></i></span>
                                @endif
                                </div>
                            </td>
                            <td class="text-center">
                                @if ($user->issuer_pros_doc != '')
                                    <a class="btn btn-secondary" href="{{ $user->issuer_kyc_doc }}" target="_blank">View Document</a>
                                @endif
                            </td>
                            <td class="text-center">
                                @if ($user->issuer_pros_doc != '')
                                    <a class="btn btn-secondary" href="{{ $user->issuer_pros_doc }}" target="_blank">View Document</a>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    @if ($user->approved == 1)
                                        <a class="btn btn-danger btn-block" href="{{ route('admin.user.userApprovalStatus', [$user->id, 'Block']) }}">Block</a>
                                    @elseif($user->approved == 2)
                                        <a class="btn btn-secondary btn-block" href="{{ route('admin.user.userApprovalStatus', [$user->id, 'Un-Block']) }}">Un-Block</a>
                                    @else
                                    <a class="btn btn-success btn-block" href="{{ route('admin.user.userApprovalStatus', [$user->id, 'approve']) }}">Approve</a>
                                    @endif
                                    <a class="btn btn-info btn-block" href="{{ route('admin.details', $user->id) }}">Details</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#userType').on('change', function() {
            var userType = $(this).val();
            $.ajax({
                url: '/admin/users/'+userType,
                method: 'GET',
                data: { type: userType },
                success: function(response) {
                    console.log(response);
                    var tableBody = $('#table-body');
                    tableBody.empty();
                    response.users.forEach(function(user, index) {
                        var userRow = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + user.name + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + (user.approved ? 'Verified <span style="color:green; border: 2px solid;border-radius: 25px;padding: 5px 7px;"><i class="fa fa-check" aria-hidden="true"></i></span>' : 'Pending <span style="color:red;border: 2px solid;border-radius: 25px;padding: 5px 9px;"><i class="fa fa-times" aria-hidden="true"></i></span>') + '</td>' +
                            '<td>' + (user.issuer_pros_doc ? '<a href="' + user.issuer_pros_doc + '" target="_blank">View Document</a>' : '') + '</td>' +
                            '<td><a href="/admin/user/accrediteddoc/' + user.id + '">View Document</a></td>' +
                            '<td>' +
                                (user.approved == 1 ?
                                    '<a class="btn btn-danger btn-block" href="/admin/user/userApprovalStatus/' + user.id + '/Block">Block</a>' :
                                    (user.approved == 2 ?
                                        '<a class="btn btn-secondary btn-block" href="/admin/user/userApprovalStatus/' + user.id + '/Un-Block">Un-Block</a>' :
                                        '<a class="btn btn-success btn-block" href="/admin/user/userApprovalStatus/' + user.id + '/approve">Approve</a>')
                                ) +
                                '<a class="btn btn-info btn-block" href="/admin/details/' + user.id + '">Details</a>' +
                            '</td>' +
                        '</tr>';
                        tableBody.append(userRow);
                    });
                }
            });
        });
    });
</script>
