@extends('admin.layout.base')

@section('title', 'User Deposit History')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            <h5 class="mb-1">User Deposit History</h5>
            <select class="form-control" name="type" id="walletType" style="width:150px;">
                <option value="{{ url('/admin/user_deposit_history', 'investor') }}"
                    {{ request()->segment(3) === 'investor' ? 'selected' : '' }}>
                    Investor
                </option>
                <option value="{{ url('/admin/user_deposit_history', 'issuer') }}"
                    {{ request()->segment(3) === 'issuer' ? 'selected' : '' }}>
                    Issuer
                </option>
            </select>
            <br>
            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Hash</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach($deposits as $index => $value)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$value->user->name}}</td>
                            <td>{{$value->type}}</td>
                            <td>{{$value->amount}}</td>
                            <td>{{substr($value->address, 0, 5).' **** '.substr($value->address, -5)}}</td>
                            <td>
                                @if($value->type == 'MATIC')
                                    <a href="https://amoy.polygonscan.com/tx/{{$value->txn_hash}}" target="_blank">{{substr($value->txn_hash, 0, 5).' **** '.substr($value->txn_hash, -5)}}</a>
                                @elseif($value->type == 'BNB')
                                    <a href="https://bscscan.com/tx/{{$value->txn_hash}}" target="_blank">{{substr($value->txn_hash, 0, 5).' **** '.substr($value->txn_hash, -5)}}</a>
                                @else
                                    <a href="https://sepolia.etherscan.io/tx/{{$value->txn_hash}}" target="_blank">{{substr($value->txn_hash, 0, 5).' **** '.substr($value->txn_hash, -5)}}</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#walletType').on('change', function() {
            const selectedValue = $(this).val();
            if (selectedValue) {
                window.location.href = selectedValue; // Redirect to the selected URL
            }
        });
    });
</script>
