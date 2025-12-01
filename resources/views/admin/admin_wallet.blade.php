@extends('admin.layout.base')

@section('title', 'Admin Wallet')

@section('content')
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
            <h5 class="mb-1">Admin Wallet Transactions</h5>
            <select class="form-control" name="type" id="walletType" style="width:35%;">
                <option value="{{ url('/admin/wallet', [Setting::get('admin_address_matic'), 'COIN', 'MATIC']) }}"
                    {{ request()->segment(5) === 'MATIC' ? 'selected' : '' }}>
                    {{ Setting::get('admin_address_matic') }} (POL)
                </option>
                <option value="{{ url('/admin/wallet', [Setting::get('admin_address_bnb'), 'COIN', 'BNB']) }}"
                    {{ request()->segment(5) === 'BNB' ? 'selected' : '' }}>
                    {{ Setting::get('admin_address_bnb') }} (BNB)
                </option>
                <option value="{{ url('/admin/wallet', [Setting::get('admin_address_eth'), 'COIN', 'ETH']) }}"
                    {{ request()->segment(5) === 'ETH' ? 'selected' : '' }}>
                    {{ Setting::get('admin_address_eth') }} (ETH)
                </option>
                <option value="{{ url('/admin/wallet', [Setting::get('admin_usdc_address'), 'TOKEN', 'USDC']) }}"
                    {{ request()->segment(5) === 'USDC' ? 'selected' : '' }}>
                    {{ Setting::get('admin_usdc_address') }} (USDC)
                </option>
                <option value="{{ url('/admin/wallet', [Setting::get('admin_usdt_address'), 'TOKEN', 'USDT']) }}"
                    {{ request()->segment(5) === 'USDT' ? 'selected' : '' }}>
                    {{ Setting::get('admin_usdt_address') }} (USDT)
                </option>
                <option value="{{ url('/admin/wallet', [Setting::get('admin_die_address'), 'TOKEN', 'DIE']) }}"
                    {{ request()->segment(5) === 'DIE' ? 'selected' : '' }}>
                    {{ Setting::get('admin_die_address') }} (DIE)
                </option>
            </select>
            @if(request()->segment(5) === 'BNB')
            <a href="https://testnet.bscscan.com/address/{{ request()->segment(3) }}" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @elseif(request()->segment(5) === 'ETH')
            <a href="https://sepolia.etherscan.io/address/{{ request()->segment(3) }}" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @elseif(request()->segment(5) === 'MATIC')
            <a href="https://amoy.polygonscan.com/address/{{ request()->segment(3) }}" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @elseif(request()->segment(5) === 'USDC')
            <a href="https://sepolia.etherscan.io/address/{{ request()->segment(3) }}/#tokentxns" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @elseif(request()->segment(5) === 'USDT')
            <a href="https://sepolia.etherscan.io/address/{{ request()->segment(3) }}/#tokentxns" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @elseif(request()->segment(5) === 'DIE')
            <a href="https://sepolia.etherscan.io/address/{{ request()->segment(3) }}/#tokentxns" target="_blank" class="btn btn-primary" style="margin-left:90%;">View More</a>
            @endif
            <br>
            <br>
            <table class="table table-striped table-bordered dataTable user-list-table" id="table-2" style="width: 100% !important">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>From Address</th>
                        <th>To Address</th>
                        <th>Amount</th>
                        <th>Hash</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @foreach ($recentTransactions as $index => $value)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{substr(@$value['from'], 0, 10).' **** '.substr(@$value['from'], -10)}}</td>
                            <td>{{ substr(@$value['to'], 0, 10).' **** '.substr(@$value['to'], -10) }}</td>
                            <td>{{ @$value['value'] / 1000000000000000000 }}</td>
                            <td>{{ substr(@$value['hash'], 0, 10).' **** '.substr(@$value['hash'], -10) }}</td>
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
