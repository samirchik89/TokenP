@extends('admin.layout.base')

@section('title', 'Deposit Request')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Deposit Request</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount ($)</th>
                        <th>Deposit Details</th>
                        <th>ScreenShot</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposit as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}}</td>
                        <td>
                            <b>Bank Name :{{@$value->bank->name}}</br>
                            Account : {{@$value->bank->account_number}}</br>
                            Account Name : {{@$value->bank->account_name}}.</b>
                        </td>
                        <td>
                            <a target="_blank" href="{{ url('/storage/'.$value->proof) }}">{{$value->proof}}</a>
                        </td>
                        <td>
                            <a href="{{url('admin/update_deposit',[$value->id,'Confirm'])}}" class="btn btn-primary">Approve</a>
                            <a href="{{url('admin/update_deposit',[$value->id,'Cancel'])}}" class="btn btn-danger">Cancel</a>
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
