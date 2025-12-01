<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Issuer Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />
    <!-- App css -->
    <link href="{{ asset('issuer/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
        id="bootstrap-stylesheet" />
    <link href="{{ asset('issuer/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('issuer/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet'
        type='text/css'>
    <link href="{{ asset('issuer/assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"
        id="app-stylesheet" />
    <link href="{{ asset('issuer/assets/css/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('asset/package/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/package/css/custom.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/ethers@5.6.2/dist/ethers.umd.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
    integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
            background-image: none !important;
        }

        /* .morris-hover{position:absolute;z-index:1000;}
    .morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255, 255, 255, 0.8);border:solid 2px rgba(230, 230, 230, 0.8);
        font-family:sans-serif;font-size:12px;text-align:center;}
    .morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0;}
    .morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0;} */
        .table-hover tbody tr:hover {
            background-color: transparent !important;
        }

        .table th,
        .table td {
            border: 1px dashed #acacac !important;
            text-align: center;
            vertical-align: middle !important;
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        /* .content-page .content
    {
        min-height: 1350px !important;
    } */
        .dir_logo {
            width: 50px;
            padding: 10px 0px !important;
        }

        .pre-loader {
            margin: 0;
            height: 100%;
            overflow: hidden;
        }

        .pre-loader .lds-roller {
            display: inline-block;
            position: absolute;
            width: 100%;
            /* top: 50%; */
            height: 100%;
            background: #00000033;
            z-index: 99999;
        }

        .pre-loader .lds-roller div {
            animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            transform-origin: 40px 40px;
            margin-top: 25%;
            margin-left: 50%;
        }

        .pre-loader .lds-roller div:after {
            content: " ";
            display: block;
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #fff;
            margin: -4px 0 0 -4px;
        }

        .pre-loader .lds-roller div:nth-child(1) {
            animation-delay: -0.036s;
        }

        .pre-loader .lds-roller div:nth-child(1):after {
            top: 63px;
            left: 63px;
        }

        .pre-loader .lds-roller div:nth-child(2) {
            animation-delay: -0.072s;
        }

        .pre-loader .lds-roller div:nth-child(2):after {
            top: 68px;
            left: 56px;
        }fo

        .pre-loader .lds-roller div:nth-child(4) {
            animation-delay: -0.144s;
        }

        .pre-loader .lds-roller div:nth-child(4):after {
            top: 72px;
            left: 40px;
        }

        .pre-loader .lds-roller div:nth-child(5) {
            animation-delay: -0.18s;
        }

        .pre-loader .lds-roller div:nth-child(5):after {
            top: 71px;
            left: 32px;
        }

        .pre-loader .lds-roller div:nth-child(6) {
            animation-delay: -0.216s;
        }

        .pre-loader .lds-roller div:nth-child(6):after {
            top: 68px;
            left: 24px;
        }

        .pre-loader .lds-roller div:nth-child(7) {
            animation-delay: -0.252s;
        }

        .pre-loader .lds-roller div:nth-child(7):after {
            top: 63px;
            left: 17px;
        }

        .pre-loader .lds-roller div:nth-child(8) {
            animation-delay: -0.288s;
        }

        .pre-loader .lds-roller div:nth-child(8):after {
            top: 56px;
            left: 12px;
        }

        @keyframes lds-roller {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        #topnav {
            background: white;
        }

        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Animation for spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="page-loader" class="page-loader">
        <div class="spinner"></div>
    </div>
    <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">


        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('issuer/assets/images/users/avatar-1.png') }}" alt="user-image" class="rounded-circle">
                        <span class="d-none d-sm-inline-block ml-1">{{ Auth::user()->identity ? Auth::user()->identity->first_name . ' ' . Auth::user()->identity->last_name : Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <a href="{{ route('profile') }}" class="dropdown-item notify-item" >
                            <i class="mdi mdi-account-outline"></i>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('issuersecurity') }}" class="dropdown-item notify-item">
                            <i class="mdi mdi-account-outline"></i>
                            <span>Security</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item notify-item" style="color:black"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i
                                class="mdi mdi-logout-variant"></i><span>Logout</span></a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </div>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('dashboard') }}" class="logo text-center">
                    <span class="logo-lg">
                        <img src="{{ logo() }}" alt="" height="45">
                        <!-- <span class="logo-lg-text-light">Zircos</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">Z</span> -->
                        <img src="{{ favicon() }}" alt="" height="40">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <i class="mdi mdi-menu"></i>
                    </button>
                </li>
            </ul>
        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <a class="waves-effect waves-light" href="{{ route('dashboard') }}">
                                    <i class="mdi mdi-view-dashboard"></i><span>Dashboard</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ url('issuer/investments') }}" class="waves-effect waves-light">
                                    <i class="mdi mdi-human-greeting"></i>
                                    <span>Investments</span>
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a class="waves-effect waves-light" href="{{ route('tokenList') }}">
                                    <i class="mdi mdi-layers"></i><span>Token Acquired</span>
                                </a> --}}
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-wallet"></i>
                                    <span>Wallet </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('issuerWallet') }}" class="waves-effect waves-light">
                                            {{-- <i class="mdi mdi-wallet"></i> --}}
                                            <span>Deposit</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('issuer/withdrawETH') }}" class="waves-effect waves-light">
                                            {{-- <i class="mdi mdi-arrow-down-box"></i> --}}
                                            <span>Withdraw</span>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    {{-- <i class="mdi mdi-coins"></i> --}}
                                    <i class="mdi mdi-nut"></i>

                                    <span>Create Asset </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a href="{{ route('asset_fund') }}">
                                            <span>Create Asset token</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-light" href="{{ route('token') }}">
                                            <span>Create Property token</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-light" href="{{ route('utility-token') }}">
                                            <span>Create Utility token</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="waves-effect waves-light" href="{{ route('tokenRequest') }}">
                                            {{-- <i class="mdi mdi-google-pages"></i> --}}
                                            <span>Pending Assets</span>
                                        </a>
                                    </li>
                                 </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-home-map-marker"></i>
                                    <span>Deployed Assets </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a class="" href="{{ route('property') }}">
                                           <span>Assets List</span>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ url('/issuer/whitelist_request') }}" class="">
                                            <span>Property Withdraw Request</span>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ url('/issuer/purchase_request') }}" class="">
                                            <span>Property Purchase Request</span>
                                        </a>
                                    </li>

                                    {{-- <li>
                                        <a class="waves-effect waves-light" href="{{ route('tokenUsers') }}">
                                            <i class="mdi mdi-treasure-chest"></i>
                                            <span>Token Holders</span>
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            {{-- <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-chart-areaspline"></i>
                                    <span>Trades </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a class="" href="{{ url('/issuer/trade') }}">
                                            <span>Trades List</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('issuer/open_trade') }}" class="">
                                            <span>Open Trade</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('issuer/trade_history') }}" class="">
                                            <span>Trade History</span>
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}


                            <li>
                                <a class="waves-effect waves-light" href="{{ route('keystore') }}">
                                    <i class="mdi mdi-lock"></i><span>Manage Kesystore</span>
                                </a>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-chart-areaspline"></i>
                                    <span>Payments </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a class=""  href="{{ route('payments') }}">
                                            <span>Add Banks</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class=""  href="{{ route('crypto.payments') }}">
                                            <span>Manage Crypto Address</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/issuer/propertyBuyRequest') }}" class="">
                                            <span>Pending Payments</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/issuer/buy_requests') }}" class="">
                                            <span>Payment History</span>
                                        </a>
                                    </li>
                                </li>


                                    @if($pageVisibility->get('plaid')['value'])
                                    <li>
                                        <a class=""  href="{{ route('plaid.index') }}">
                                            <span>Connect Your Bank</span>
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="waves-effect waves-light">
                                    <i class="mdi mdi-chart-areaspline"></i>
                                    <span>Reports </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li>
                                        <a class=""  href="{{ route('report.capital') }}">
                                            <span>Capital</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class=""  href="{{ route('report.sales') }}">
                                            <span>Sales</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a class=""  href="{{ route('report.investors') }}">
                                            <span>Investors</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->


        <!-- End Navigation Bar-->
        {{-- @yield('content') --}}

        <div class="content-page">
            <div class="">
                @include('common.notify')
            </div>

            @yield('content')

        </div>

    </div>
    <!-- END wrapper -->

    <!-- Right bar overlay-->

    <script src="{{ asset('issuer/assets/js/vendor.min.js') }}"></script>

    @yield('scripts')
    <script src="{{ asset('issuer/assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('issuer/assets/js/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();

            toastr.success('Copied.')
        }

        $('input[type=number]').on('keypress', function(e) {
            var ev = e || window.event;
            var key = ev.keyCode || ev.which;
            key = String.fromCharCode(key);
            var regex = /^[0-9]*\.?[0-9]*$/;

            if (!regex.test(key) || this.value > 1000000000000000) {
                ev.returnValue = false;
                if (ev.preventDefault) ev.preventDefault();
            }
        })

        $('.allowAlphaOnly').on('keypress', function(e) {
            var ev = e || window.event;
            var key = ev.keyCode || ev.which;
            key = String.fromCharCode(key);
            var regex = /^[a-zA-Z]+$/;

            if (!regex.test(key)) {
                ev.returnValue = false;
                if (ev.preventDefault) ev.preventDefault();
            }
        })

        $('.allowAlphaSpace').on('keypress', function(e) {
            var ev = e || window.event;
            var key = ev.keyCode || ev.which;
            key = String.fromCharCode(key);
            var regex = /^[a-zA-Z\s]+$/;

            if (!regex.test(key)) {
                ev.returnValue = false;
                if (ev.preventDefault) ev.preventDefault();
            }
        })

        $('input[type=file]').on('change', function(e) {
            // console.log(this.files[0].size)
            $(this).next('span').remove()
            if (this.files[0].size > 4194304) {
                $(this).after("<span class='text-danger'>* Maximum file size 4MB! * </span>")
                this.value = "";
            };
        })
        $(".count").each(function() {
            $(this)
                .prop("Counter", 0)
                .animate({
                    Counter: $(this).text(),
                }, {
                    duration: 3000,
                    easing: "swing",
                    step: function(now) {
                        $(this).text(Math.ceil(now));
                    },
                });
        });
    </script>
    <script>
        window.onload = function () {
            const loader = document.getElementById('page-loader');
            const content = document.getElementById('content');

            setTimeout(() => {
                loader.style.display = 'none';
                content.style.display = 'block';
            }, 1000);
        };
    </script>

 <script src="{{ asset('issuer/assets/js/app.min.js') }}"></script>
</body>

</html>
