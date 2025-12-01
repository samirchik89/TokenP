@extends('issuer.layout.base')

@section('content')
<style>
    i.fa {
    display: inline-block;
    border-radius: 60px;
    box-shadow: 0 0 2px #888;
    padding: 0.5em 0.6em;

    }

    .introactive {
        background: #232020 !important;
        background: #140749 !important;
        color: #FFF;
    }

    .introactive .nav-link {
        color: #FFF;
    }

    .currencies-container .currency-balance {
        font-size: 20px;
        font-weight: bold;
        font-family: monospace;
        margin: 0;
        text-align: left;
        color: #fff;
    }

    .currency-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #000;
    }

    .panel-currencies {
        padding: 20px !important;
        border: 1px solid #e0e0e0;
        border-radius: 16px;
        background: #fff;
    }

    .withdraw-instruction .steps {
        line-height: 30px;
    }

    .table-currencies {
        border: none !important;
        border-radius: 10px;
    }

    .currency-symbol {
        color: #fff;
    }

    .input-group-addon {
        padding: 6px 12px;
        font-size: 14px;
    }

    .details-container {
        border-radius: 10px;
    }

    .table td {
        border: none !important;
    }
    .container {
        width: 100% !important;
        max-width: 100% !important;
    }
</style>

<div class="header-breadcrumbs">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>Withdraw</h1>
            </div>
            <div class="col-sm-6">
                @include('issuer.layout.breadcrumb',['items' => [
                    [
                        'url' => 'issuer/dashboard',
                        'title' => 'Dashboard'
                    ],
                    [
                        'title' => 'Withdraw'
                    ],
                ]])
            </div>
        </div>
    </div>
    <!-- Property Head Ends -->
    <div class="content">
        <div class="container-fluid wizard-border">
            <section class="container spaceall wallet-full">
                <!-- Top Details -->
                <div class="container">

                    <div class="panel">
                        <!-- Left Side Box-->
                        <div class="col-12 p-0">
                            @foreach($coins as $key => $value)
                            @if($value == 'USD')
                            <div class="currencies-container">
                                {{-- <table class="table table-currencies introactive">
                                    <tbody>
                                        <tr class="currency-item" class="nav-item nav-link" href="#eth_deposit" data-toggle="tab">
                                            <td class="currency-logo"><img src="{{asset('asset/package/images/wallet/'.strtolower($value).'.png')}}" alt=""><span class="currency-symbol">{{$value}}</span></td>
                                            <td class="currency-balance-col">
                                                <p class="currency-balance"><span class="currency-sign"></span>{{ number_format($user->$value,6) }} {{$value}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                <h2 class="currency-title mb-4">Current Balance: {{ number_format($user->$value,3) }} {{$value}}</h2>

                            </div>
                            @else
                            <div class="currencies-container nav nav-tabs">
                                {{-- <table class="table table-currencies introactive">
                                    <tbody>
                                        <tr class="currency-item" class="nav-item nav-link" href="#eth_deposit" data-toggle="tab">
                                            <td class="currency-logo"><img src="{{asset('asset/package/images/wallet/'.strtolower($value).'.png')}}" alt=""><span class="currency-symbol">{{$value}}</span></td>
                                            <td class="currency-balance-col">
                                                <p class="currency-balance"><span class="currency-sign"></span>{{ number_format($user->$value,6) }} {{$value}}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                <h2 class="currency-title mb-4">Current Balance: {{ number_format($user->$value,3) }} {{$value}}</h2>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <!-- End Left Size Box -->
                        <div class="panel-body p-4 panel-currencies">
                            <div class="row m-0">
                                <!-- Right Size Box -->
                                <div class="col-12 p-0">

                                    <div class="details-container tab-content">
                                        <!-- ETH WITHDRAWAL Tab -->
                                        <div class="card active" id="btc_deposit">

                                            <h2 class="panel-title">Withdraw USD
                                            </h2>
                                            <br>
                                            <!-- withdraw instruction -->
                                            <section class="withdraw-instruction">
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <h4 class="steps">
                                                            <span class="step-number">1</span>
                                                        </h4>
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <form id="sendCoinForm" action="{{ url('issuer/sendETH') }}" method="post">
                                                            @csrf
                                                            <div class="">
                                                                <div class="form-group">
                                                                    <label for="amount">Select Coin</label>
                                                                    <select class="form-control" id="coin" name="coin" required>
                                                                        <option value="">Select Coin</option>
                                                                        @foreach($coins as $coin)
                                                                        <option value="{{$coin}}">{{$coin}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="amount">Enter Amount</label>
                                                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="" required min="0" step="any">
                                                                </div>
                                                                <div class="form-group" id="ETH_Address">
                                                                    <label for="address">Enter Address</label>
                                                                    <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
                                                                </div>
                                                                <div class="form-group FiatWithdraw" style="display:none;">
                                                                    <label for="amount">Enter Account Number</label>
                                                                    <input type="text" class="form-control" id="account" name="account" placeholder="Enter Account">
                                                                </div>
                                                                <div class="form-group FiatWithdraw" style="display:none;">
                                                                    <label for="amount">Enter IFSC Code</label>
                                                                    <input type="text" class="form-control" id="ifsc" name="ifsc_code" placeholder="Enter IFSC Code">
                                                                </div>
                                                                <div class="form-group FiatWithdraw" style="display:none;">
                                                                    <label for="amount">Enter Bank Name</label>
                                                                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name">
                                                                </div>
                                                                <div class="form-group FiatWithdraw" style="display:none;">
                                                                    <label for="amount">Enter Account Holder Name</label>
                                                                    <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter Account Holder Name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="submit" class="btn btn-primary sectionHide" id="sendToken" value="Send">
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <!-- <form method="post" action="{{ url('/issuer/sendETH') }}">
                                                        @csrf

                                                        <div class="form-group">
                                                            <label for="sendAddr">To Address</label>
                                                            <input type="text" class="form-control" id="sendAddr" name="to_address" placeholder="To Address" required>
                                                        </div>
                                                        <div class="form-group" id="withdrawotpsection" style="display: none;">
                                                        <input type="number" class="form-control withdrawotp" id="withdrawotp" name="withdrawotp" placeholder="Withdraw OTP" onkeydown="limit(this, 6);" onkeyup="limit(this, 6);" onkeyup="this.value = minmax(this.value, 0, 6)" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <button class="btn btn-theme" id="generateOTP">Generate OTP</button>
                                                            <input type="submit" class="btn btn-primary" id="sendToken" style="display: none;" value="Send">
                                                        </div>
                                                        <button type="submit" class="btn btn-theme">Send ETH</button>
                                                        </form>	 -->

                                                    </div>
                                                </div>

                                                <hr class="split">

                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <h4 class="steps">2</h4>
                                                    </div>
                                                    <div class="col-sm-11">
                                                        <p>Once you complete sending, you can check the status of your new withdrawal below.</p>
                                                    </div>
                                                </div>

                                            </section>

                                            <!-- End withdraw instruction -->

                                            <br>
                                            <h2 class="panel-title">Withdrawal History</h2>

                                            <!-- Deposit History -->
                                            <table class="datatable-full table table-striped table-bordered custom-table-style" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Time</th>
                                                        <th>Coin</th>
                                                        <th>Transaction ID</th>
                                                        <th>To Address</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($history as $eth_history)
                                                    <tr>
                                                        <td>{{$eth_history->created_at}}</td>
                                                        <td>{{$eth_history->coin}}</td>
                                                        @if($eth_history->coin == "ETH")
                                                        <td>
                                                            <a href="https://sepolia.etherscan.io/tx/{{ $eth_history->tx_hash }}" target="_blank">{{substr($eth_history->tx_hash, 0, 8).'****'}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="https://sepolia.etherscan.io/address/{{ $eth_history->receiver }}" target="_blank">{{substr($eth_history->receiver, 0, 8).'****'}}</a>
                                                        </td>
                                                        @elseif($eth_history->coin == "BNB")
                                                        <td>
                                                            <a href="https://testnet.bscscan.com/tx/{{ $eth_history->tx_hash }}" target="_blank">{{substr($eth_history->tx_hash, 0, 8).'****'}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="https://testnet.bscscan.com/address/{{ $eth_history->receiver }}" target="_blank">{{substr($eth_history->receiver, 0, 8).'****'}}</a>
                                                        </td>
                                                        @else
                                                        <td>
                                                            <a href="https://amoy.polygonscan.com/tx/{{ $eth_history->tx_hash }}" target="_blank">{{substr($eth_history->tx_hash, 0, 8).'****'}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="https://amoy.polygonscan.com/address/{{ $eth_history->receiver }}" target="_blank">{{substr($eth_history->receiver, 0, 8).'****'}}</a>
                                                        </td>
                                                        @endif
                                                        <td>{{digitround($eth_history->amount)}}</td>
                                                        <td>{{strtoupper($eth_history->status)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End Deposit History -->

                                            <!-- Fiat History -->
                                            <br>
                                            <h2 class="panel-title">USD Withdrawal History</h2>

                                            <!-- Deposit History -->
                                            <table class="datatable-full table table-striped table-bordered custom-table-style" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Time</th>
                                                        <th>Coin</th>
                                                        <th>To Address</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($fiat_history as $usd_history)
                                                    <tr>
                                                        <td>{{$usd_history->created_at}}</td>
                                                        <td>{{$usd_history->coin}}</td>
                                                        <td>
                                                            <?php $details = json_decode($usd_history->receiver);
                                                            ?>
                                                            Bank Name : {{$details[2]}},<br>
                                                            Account : {{$details[0]}}
                                                        </td>
                                                        <td>{{$usd_history->amount}}</td>
                                                        <td>{{strtoupper($usd_history->status)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <!-- End History -->

                                        </div>
                                        <!-- End ETH WITHDRAWAL Tab -->

                                    </div>
                                </div>

                            </div>
                            <!-- .row -->

                        </div>
                    </div>

                </div>

            </section>
        </div>
    </div>

    <div class="alert-container">

    </div>

</div>
@endsection

@section('styles')
<style type="text/css">
    .introactive {
        background: #232020 !important;
        background: #140749 !important;
        color: #FFF;
    }

    .introactive .nav-link {
        color: #FFF;
    }



    div#deposit_address {
        font-size: 13px;
        font-weight: 500;
        padding: 11px;
        color: #000;
    }

    .custom-table-style thead tr th {
        vertical-align: middle;
        font-size: 12px;
        padding: 8px !important;
    }

    .custom-table-style tbody tr td {
        vertical-align: middle;
        font-size: 12px;
        padding: 8px !important;
        letter-spacing: .1px;
    }

    .send-code-button button.btn.btn-primary {
        padding: 10px 20px;
        background: #5f56e0;
        border: 1px solid #5f56e0;
    }

    .selectable {
        -webkit-touch-callout: all;
        /* iOS Safari */
        -webkit-user-select: all;
        /* Safari */
        -khtml-user-select: all;
        /* Konqueror HTML */
        -moz-user-select: all;
        /* Firefox */
        -ms-user-select: all;
        /* Internet Explorer/Edge */
        user-select: all;
        /* Chrome and Opera */

    }

    .alert-container {
        position: fixed;
        bottom: 5px;
        left: 11%;
        width: 32%;
        margin: 0 25% 0 25%;
        background-color: #e0afaf;
        z-index: 1;
    }

    .alert {
        text-align: center;
        padding: 17px 0 20px 0;
        margin: 0 25% 0 25%;
        height: 54px;
        font-size: 20px;
    }
</style>
@endsection

@section('scripts')

<script type="text/javascript" src="{{asset('js/jquery.qrcode.js')}}"></script>
<script type="text/javascript" src="{{asset('js/qrcode.js')}}"></script>
<script type="text/javascript">
    $('#generateOTP').click(function(e) {
        $.ajax({
            url: "{{url('/issuer/generate/withdrawOTP')}}?type=ETH",
            type: "GET",
        }).done(function(response) {
            $('.sectionShow').hide();
            $('.sectionHide').show();
            alert(response.success.msg);
        }).fail(function(jqXhr, status) {});
    });
</script>

<script>
    $('#coin').on('change', function(){
        coin = $(this).val();
        if(coin == 'USD'){
            $('#ETH_Address').hide();
            $('.FiatWithdraw').show();
        }else{
            $('#ETH_Address').show();
            $('.FiatWithdraw').hide();
        }
    })

    $(document).on('keypress', '.non-negative', function(e) {

        if ($(this).hasClass("only-integer")) {
            if (e.which == 46) {
                return false;
            }
        }

        if (isNaN(this.value + String.fromCharCode(event.keyCode)) || (e.which == 32)) {
            return false;
        }
    });
</script>
@endsection
