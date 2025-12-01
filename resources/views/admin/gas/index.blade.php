@extends('admin.layout.base')

@section('title', 'Deposit Request')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Gas fee Request for Deploy tokens</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($gas_requests as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}} {{$value->coin}}</td>
                        <td>{{$value->receiver}}</td>
                        <td>
                            <a href="{{url('admin/update_gas_request',[$value->id,'success'])}}" class="btn btn-primary">Approve</a>
                            <a href="{{url('admin/update_gas_request',[$value->id,'cancelled'])}}" class="btn btn-danger">Cancel</a>
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

@endsection
