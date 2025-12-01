@extends('admin.layout.base')

@section('title', 'Token Request')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1">Token History</h5>

                <table class="table table-striped table-bordered dataTable" id="table-2" style="width: 100% !important">
                    <thead>
                        <tr>
                            <th>@lang('admin.id')</th>
                            <th>User</th>
                            <th>Token Name</th>
                            <th>Token Acquire</th>
                            <th>Token Symbol</th>
                            <th>Payment Type</th>
                            <th>Payment Hash</th>
                            <th>Payment Amount</th>
                            <th>Token Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $index => $value)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ @!is_null($value->user->name) ? $value->user->name : 'Admin' }}</td>
                                <td>{{ @$value->usercontract->tokenname }}</td>
                                <td>{{ @$value->number_of_token }}</td>
                                <td>{{ @$value->usercontract->tokensymbol }}</td>
                                <td>{{ @$value->payment_type }}</td>
                                <td>
                                    @if (@$value->payment_type == 'stripe')
                                        {{ @$value->txn_hash }}
                                    @else
                                        <a href="{{ env('COIN_WEB_URL') }}/tx/{{ $value->txn_hash }}" target="_blank"
                                            rel="noopener noreferrer">{{ wrap_string(@$value->txn_hash) }}</a>
                                    @endif
                                </td>
                                <td>{{ @$value->payment_amount }}</td>
                                <td>{{ @$value->token_price }}</td>
                                <td>
                                    <!-- <a href="{{ route('admin.issuertokencontracttest', $value->id) }}" class="btn btn-info"> ADD </a> -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
