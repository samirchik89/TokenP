@extends('admin.layout.base')

@if ($page == 1)
    @section('title', 'User Transaction Token')
@else
    @section('title', 'Transaction Token')
@endif

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">

                <h5 class="mb-1">
                    @if ($page == 1)
                        User
                    @endif Transaction Token
                </h5>

                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>User</th>
                            <th>Token</th>
                            <th>Payment</th>
                            <th>Investor Paid (USD)</th>
                            <th>Issuer Amount (USD)</th>
                            <th>Admin Commission (USD)</th>
                            <th>Token Price</th>
                            <th>Number of Token</th>
                            <th>Total Token</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($user_token_txn as $index => $token)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $token->user->name }}</td>
                                <td>{{ $token->usercontract->tokenname }} ({{ $token->usercontract->tokensymbol }})</td>
                                <td>{{ $token->payment_type }}</td>
                                <?php
                                    $commission = $token->admin_commission ? $token->admin_commission : $token->payment_amount * (setting('admin_commission', 1.5)/100);
                                ?>
                                <td>{{ $token->payment_amount + $commission}}</td>
                                <td>{{ $token->payment_amount }}</td>
                                <td>{{ $commission}}</td>
                                <td>{{ $token->token_price }}</td>
                                <td>{{ $token->number_of_token }}</td>
                                <td>{{ $token->total_token }}</td>
                                <td>
                                    <span style="color: green;">Success</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
@endsection
