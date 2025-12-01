@extends('admin.layout.base')

@section('title', 'Dividend')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">

            <h5 class="mb-1">Dividend</h5>

            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Token</th>
                        <th>Payment</th>
                        <th>Txn Hash</th>
                        <th>Payment Amount</th>
                        <th>Token Price</th>
                        <th>Bonus Value</th>
                        <th>Bonus Token</th>
                        <th>Number of Token</th>
                        <th>Total Token</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($user_token_txn as $index => $token)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $token->user->name }}</td>
                        <td>{{ $token->usercontract->tokenname }} ({{ $token->usercontract->tokensymbol }})</td>
                        <td>{{$token->payment_type}}</td>
                        <td>{{$token->txn_hash}}</td>
                        <td>{{$token->token_price}}</td>
                        <td>{{$token->bonus_value}}</td>
                        <td>{{$token->bonus_token}}</td>
                        <td>{{$token->number_of_token}}</td>
                        <td>{{$token->total_token}}</td>
                        <td>
                            @if($token->status==1)
                                <span style="color: green;">Success</span>
                            @else
                                <span style="color: red;">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
