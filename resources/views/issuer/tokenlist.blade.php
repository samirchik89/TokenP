@extends('issuer.layout.base')
@section('content')
    <!-- Start Page Content here -->
    <div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Token Acquired</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="breadcrumb-four" style="text-align: right;">
                            <ul class="breadcrumb">
                                <li><a href="{{ url('issuer/dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-box">
                                            <path
                                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                            </path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg> <span>Dashboard</span></a></li>
                                <li class="active"><a href=""><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-cpu">
                                            <rect x="4" y="4" width="16" height="16" rx="2"
                                                ry="2"></rect>
                                            <rect x="9" y="9" width="6" height="6"></rect>
                                            <line x1="9" y1="1" x2="9" y2="4"></line>
                                            <line x1="15" y1="1" x2="15" y2="4"></line>
                                            <line x1="9" y1="20" x2="9" y2="23"></line>
                                            <line x1="15" y1="20" x2="15" y2="23"></line>
                                            <line x1="20" y1="9" x2="23" y2="9"></line>
                                            <line x1="20" y1="14" x2="23" y2="14"></line>
                                            <line x1="1" y1="9" x2="4" y2="9"></line>
                                            <line x1="1" y1="14" x2="4" y2="14"></line>
                                        </svg> <span>Token Acquired</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="content">
                        <!-- Start container-fluid -->
                        <div class="container-fluid wizard-border">
                            <!-- start  -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <div>
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.N0</th>
                                                    <th>Chain</th>
                                                    <th>Token Name</th>
                                                    <th>Token Symbol</th>
                                                    <th>Token Value</th>
                                                    <th>Token Supply</th>
                                                    <th>Remaining Tokens</th>
                                                    <th>Contract Address</th>
                                                    <th>History</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($tokens as $key => $item)
                                                    <tr style="pointer-events: none">
                                                        <td>{{ @$key + 1 }}</td>
                                                        <td>{{ @$item->coin }}</td>
                                                        <td>{{ @$item->tokenname }}</td>
                                                        <td>{{ @$item->tokensymbol }}</td>
                                                        <td>{{ @$item->tokenvalue }}</td>
                                                        <td>{{ @$item->tokensupply }}</td>
                                                        <td>{{ @$item->tokenbalance ? @$item->tokenbalance : @$item->tokensupply }}</td>
                                                        @if($item->coin == 'ETH')
                                                        <td style="pointer-events: all">
                                                            <a href="https://sepolia.etherscan.io/token/{{@$item->contract_address}}" target="_blank">{{substr(@$item->contract_address, 0, 8).' **** '.substr(@$item->contract_address, -8)}}</a>
                                                        </td>
                                                        @elseif($item->coin == 'BNB')
                                                        <td style="pointer-events: all">
                                                                <a href="https://testnet.bscscan.com/token/{{@$item->contract_address}}" target="_blank">{{substr(@$item->contract_address, 0, 8).' **** '.substr(@$item->contract_address, -8)}}</a>
                                                            </td>
                                                        @else
                                                        <td style="pointer-events: all">
                                                                <a href="https://amoy.polygonscan.com/token/{{@$item->contract_address}}" target="_blank">{{substr(@$item->contract_address, 0, 8).' **** '.substr(@$item->contract_address, -8)}}</a>
                                                            </td>
                                                        @endif
                                                        <td style="pointer-events: all">
                                                            <a href="{{ url('issuer/token_history', @$item->id) }}">History</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->


                        </div>
                        <!-- end container-fluid -->

                        <!-- Footer Start -->
                        <!-- <footer class="footer">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="social">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                            <p>Copyright © 2021 {{ $project_name }}. All rights reserved.</p>
                                        </div>
                                    </div>
                                </div>
                            </footer> -->
                        <!-- end Footer -->

                    </div>
                    <!-- end content -->

                </div>
            </div>
        </div>

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-between align-content-center">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                        <p>Copyright © <script>document.write(new Date().getFullYear());</script> {{ $project_name }}. All rights reserved.</p>
                    </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- END content-page -->
@endsection
