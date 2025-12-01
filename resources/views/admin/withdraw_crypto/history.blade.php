@extends('admin.layout.base')

@section('title', 'Crypto Withdraw History')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Crypto Withdraw History</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>Receiver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdraw_requests as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}} {{$value->coin}}</td>
                        <td>{{$value->receiver}}</td>
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
