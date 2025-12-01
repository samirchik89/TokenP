@extends('admin.layout.base')

@section('title', 'Coins ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">


            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                       <th>Id</th>
                        <th>User Email</th>
                        <th>Issuer Email</th>
                        <th>Token name</th>
                        <th>Token Symbol</th>
                        <th>Amount Paid</th>
                        <th>Payment ID</th>
                        {{-- <th>Type</th> --}}
                        <th>Status</th>
                        <!-- <th>Action</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $index => $payment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $payment->user->email }}</td>
                        <td>{{ $payment->usercontract->user->email }}</td>
                        <td>{{ $payment->usercontract->tokenname }}</td>
                        <td>{{ $payment->usercontract->tokensymbol }}</td>
                        <td>{{ $payment->payment_amount }}</td>
                        <td>{{ $payment->txn_hash }}</td>
                        <td>{{ $payment->status == 0 ? 'Failed' : 'Success' }}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
