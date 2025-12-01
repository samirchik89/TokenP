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
                        <th>Date</th>
                        <th>User</th>
                        <th>Amount</th>
                        <th>ScreenShot</th>
                        <th>Hash</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposit_requests as $index => $value)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ date('d M Y H:i:s', strtotime($value->created_at)) }}</td>
                        <td>{{$value->user->name}}</td>
                        <td>{{$value->amount}} {{$value->type}}</td>
                        <td>
                            <a target="_blank" href="{{ url('/storage/'.$value->proof) }}">{{$value->proof}}</a>
                        </td>
                        <td>
                            @if($value->type == 'BNB')
                                <a href="https://testnet.bscscan.com/tx/{{ $value->txn_hash }}" target="_blank">{{substr($value->txn_hash, 0, 4)}} *** {{substr($value->txn_hash,-4)}}</a>
                            @elseif($value->type == 'ETH')
                                <a href="https://sepolia.etherscan.io/tx/{{ $value->txn_hash }}" target="_blank">{{substr($value->txn_hash, 0, 4)}} *** {{substr($value->txn_hash,-4)}}</a>
                            @elseif($value->type == 'MATIC')
                                <a href="https://amoy.polygonscan.com/tx/{{ $value->txn_hash }}" target="_blank">{{substr($value->txn_hash, 0, 4)}} *** {{substr($value->txn_hash,-4)}}</a>
                            @else
                                <a href="https://amoy.polygonscan.com/tx/{{ $value->txn_hash }}" target="_blank">{{substr($value->txn_hash, 0, 4)}} *** {{substr($value->txn_hash,-4)}}</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/update_crypto_deposit',[$value->id,'success'])}}" class="btn btn-primary">Approve</a>
                            <a href="{{url('admin/update_crypto_deposit',[$value->id,'failed'])}}" class="btn btn-danger">Cancel</a>
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
