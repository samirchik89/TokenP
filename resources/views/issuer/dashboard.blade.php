@extends('issuer.layout.base')

<!-- START content-page -->
@section('content')
    <!-- START content-page -->
    <div class="content-page-inner">

        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6"><h1>Issuer Dashboard</h1></div>
              <div class="col-sm-6">
                @include('issuer.layout.breadcrumb',['items' => [
                    [
                        'title' => 'user.dashboard'
                    ]
                ]])
              </div>
            </div>
          </div>
        </div>
        <!-- Header Banner End -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <!-- Start container-fluid -->
                        <div class="container-fluid wizard-border">

                            <!-- Statistics Cards Row -->
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="widget-inline">
                                            <div class="row justify-content-center">

                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-primary text-primary">
                                                        <div class="card-body">
                                                          <h5 class="card-title text-primary"><i class="fas fa-comment-dollar"></i><b>$ <span class="count"> {{ @$totalDealSize }} </span></b></h5>
                                                          <p class="card-text">Total Asset Value</p>
                                                        </div>
                                                      </div>

                                                </div>

                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-danger text-danger">
                                                        <div class="card-body">
                                                          <h5 class="card-title text-danger"><i class="fas fa-address-book fa-co"></i><b><span class="count">{{ @$request_token }}</span></b></h5>
                                                          <p class="card-text">New Asset Requests</p>
                                                        </div>
                                                      </div>
                                                </div>



                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-warning text-warning">
                                                        <div class="card-body">
                                                          <h5 class="card-title text-warning"><i class="fas fa-coins fa-co"></i><b><span class="count">{{ @$tokenCounts['deployed_assets'] ?? 0 }}</span></b></h5>
                                                          <p class="card-text">RWA (Real World Assets)</p>
                                                        </div>
                                                      </div>
                                                </div>

                                                <div class="col-xl-3 col-sm-6">
                                                    <div class="card shadow-none bg-transparent border border-success text-success">
                                                        <div class="card-body">
                                                          <h5 class="card-title text-success"><i class="fa fa-building fa-co"></i><b><span class="count">{{ @$tokenCounts['property'] }}</span></b></h5>
                                                          <p class="card-text">Properties Deployed</p>
                                                        </div>
                                                      </div>
                                                </div>

                                                <div class="col-xl-3 col-sm-6 mt-2">
                                                    <div class="card shadow-none bg-transparent border border-info text-info">
                                                        <div class="card-body">
                                                          <h5 class="card-title text-info"><i class="fa fa-building fa-co"></i><b><span class="count">{{ @$tokenCounts['utility'] }}</span></b></h5>
                                                          <p class="card-text">Utility</p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($notifications) && $notifications->count())
                                <div class="card-box border rounded p-3 mb-4 rb" style="background-color: #ffffff;">
                                    <div class="card-header approval-section-header" style="background-color: #ffffff; margin: 1rem 1rem 0 1rem; gap: 5px;">
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <i class="fas fa-bell fa-lg text-dark fa-2x"></i>
                                            <h3 style="margin: 0; font-weight: bold;">Recent Alerts</h3>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row m-0 mb-4"><!-- div-parent -->

                                            <div class="col-12" style="max-height: 550px; overflow-y: auto;"> <!-- shows approx 5 cards -->
                                                @foreach($notifications as $notification)
                                                    @php
                                                        $alert = $notification->alert_class;
                                                    @endphp

                                                    <div class="card-box border rounded p-3 mb-3 notification-card"
                                                        style="border-left: 4px solid {{ $alert['color'] }} !important; background-color: #f9f9f9; position: relative;">

                                                        <div class="card-header approval-section-header" style="background-color: #f9f9f9;">
                                                            <div class="approval-header-flex d-flex justify-content-between align-items-center">
                                                                <div class="approval-header-left d-flex align-items-center gap-3">
                                                                    <div class="icon-wrapper" style = "margin-right:10px;">
                                                                        @switch($notification->notification_type)
                                                                            @case('success')
                                                                                <i class="fas fa-check-circle fa-2x" style="color: #28a745;"></i>
                                                                                @break
                                                                            @case('warning')
                                                                                <i class="fas fa-exclamation-triangle fa-2x" style="color: #ffc107;"></i>
                                                                                @break
                                                                            @case('error')
                                                                            @case('danger')
                                                                                <i class="fas fa-times-circle fa-2x" style="color: #dc3545;"></i>
                                                                                @break
                                                                            @case('info')
                                                                                <i class="fas fa-info-circle fa-2x" style="color: #17a2b8;"></i>
                                                                                @break
                                                                            @default
                                                                                <i class="fas fa-bell fa-2x" style="color: #6c757d;"></i>
                                                                        @endswitch
                                                                    </div>

                                                                    <div>
                                                                        <h5 class="mb-1 fw-bold" style="color: {{ $alert['color'] }};">{{ $notification->title }}</h5>
                                                                        <p class="text-muted mb-0 small">{{ $notification->description }}</p>
                                                                    </div>
                                                                </div>

                                                                <!-- Close Button -->
                                                                <button type="button"
                                                                    onclick="removeNotificationCard(this)"
                                                                    class="btn btn-sm btn-light border-0"
                                                                    style="position: absolute; top: 10px; right: 10px;"
                                                                    aria-label="Close">
                                                                    <i class="fas fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                            <!-- Main Dashboard Cards -->
                            <div class="row mt-4">

                                <!-- Fiat Wallet Management -->
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="card-box h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3" style="margin-right: 15px;">
                                                    <i class="fas fa-wallet fa-2x text-muted"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Fiat Wallet Management</h5>
                                                    <p class="text-muted mb-0">Manage your fiat wallet with platform admin</p>
                                                </div>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('issuerWallet') }}" class="btn btn-primary btn-sm flex-fill m-1">
                                                    Deposit
                                                </a>

                                                <a href="{{ route('withdrawETH') }}" class="btn btn-outline-primary btn-sm flex-fill m-1">
                                                    Withdraw
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Asset Creation & Deployment -->
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="card-box h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3" style="margin-right: 15px;">
                                                    <i class="fas fa-plus-square fa-2x text-muted"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Create & Deploy Assets</h5>
                                                    <p class="text-muted mb-0">Create and deploy assets in blockchain</p>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                @if($isDemo)
                                                    <div class="demo-pointer-container">
                                                        <div class="demo-pointer-text">
                                                            <i class="fas fa-hand-point-down"></i> Click here
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="d-flex flex-wrap">
                                                    <a href="{{ route($isDemo ? 'token-demo' : 'token') }}" class="btn btn-success btn-sm me-2 m-1 property-btn {{ $isDemo ? 'demo-pointer' : '' }}" id="propertyBtn">
                                                        {{ $isDemo ? 'Click here' : 'Property' }}
                                                    </a>
                                                    <a href="{{ route('asset_fund') }}" class="btn btn-outline-primary btn-sm me-2 m-1">RWA Assets</a>
                                                    <a href="{{ route('utility-token') }}" class="btn btn-outline-primary btn-sm m-1">Utility</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Asset Requests (Conditional) -->
                                @if(@$request_token > 0)
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                                    <div class="card-box">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3" style="margin-right: 15px;">
                                                        <i class="fas fa-exclamation-triangle fa-2x "></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-1">Asset Requests</h5>
                                                        <p class="text-muted mb-0">You have {{ @$request_token }} asset requests pending with admin</p>
                                                    </div>
                                                </div>
                                                <a href="{{route('tokenRequest')}}" class="btn btn-primary">
                                                    View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <!-- View Deployed Assets -->
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="card-box h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3" style="margin-right: 15px;">
                                                    <i class="fas fa-list-alt fa-2x text-muted"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Deployed Assets</h5>
                                                    <p class="text-muted mb-0">View your deployed assets in blockchain</p>
                                                </div>
                                            </div>
                                            <a href="{{Route('property')}}" class="btn btn-primary w-100">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- KeyStore Management -->
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                    <div class="card-box h-100">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3" style="margin-right: 15px;">
                                                    <i class="fas fa-key fa-2x text-muted"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">KeyStore Management</h5>
                                                    <p class="text-muted mb-0">Manage your blockchain private keys</p>
                                                </div>
                                            </div>
                                            <a href="{{Route('keystore')}}" class="btn btn-primary w-100">
                                                Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Channels -->
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                                    <div class="card-box">
                                        <div class="card-body p-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3" style="margin-right: 15px;">
                                                    <i class="fas fa-credit-card fa-2x text-muted"></i>
                                                </div>
                                                <div>
                                                    <h5 class="mb-1">Payment Channels</h5>
                                                    <p class="text-muted mb-0">Setup and manage your payment channels to receive funds from investors</p>
                                                </div>
                                            </div>
                                            <a href="{{Route('crypto.payments')}}" class="btn btn-primary">
                                                Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            @php
                                $userdata = json_encode(array_values($tokens ?? []));
                            @endphp

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END content-page -->
@endsection

<style>

/* Blinking animation for Property button */
@keyframes blink {
    0% {
        box-shadow: 0 0 5px #28a745, 0 0 10px #28a745, 0 0 15px #28a745;
        transform: scale(1);
    }
    50% {
        box-shadow: 0 0 10px #28a745, 0 0 20px #28a745, 0 0 30px #28a745;
        transform: scale(1.05);
    }
    100% {
        box-shadow: 0 0 5px #28a745, 0 0 10px #28a745, 0 0 15px #28a745;
        transform: scale(1);
    }
}

/* Demo pointer animation */
@keyframes demoPointer {
    0% {
        box-shadow: 0 0 5px #ff6b35, 0 0 10px #ff6b35, 0 0 15px #ff6b35;
        transform: scale(1);
        background-color: #ff6b35;
    }
    50% {
        box-shadow: 0 0 10px #ff6b35, 0 0 20px #ff6b35, 0 0 30px #ff6b35;
        transform: scale(1.1);
        background-color: #ff5722;
    }
    100% {
        box-shadow: 0 0 5px #ff6b35, 0 0 10px #ff6b35, 0 0 15px #ff6b35;
        transform: scale(1);
        background-color: #ff6b35;
    }
}

/* Up-down animation for pointer text */
@keyframes upDownAnimation {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

.demo-pointer-container {
    position: relative;
    width: 100%;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    margin-bottom: 15px;
}

.demo-pointer-text {
    display: inline-block;
    background: linear-gradient(45deg, #ff6b35, #ff5722);
    color: white;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
    animation: upDownAnimation 2s ease-in-out infinite;
    position: relative;
    z-index: 20;
    margin-left: 0;
    transform: translateX(8px);
}

.demo-pointer-text i {
    margin-right: 8px;
    font-size: 16px;
    animation: upDownAnimation 2s ease-in-out infinite;
}

.demo-pointer-text::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 8px solid #ff6b35;
}

.property-btn {
    animation: blink 2s infinite;
    position: relative;
    z-index: 10;
}

.property-btn:hover {
    animation: none;
    box-shadow: 0 0 15px #28a745, 0 0 25px #28a745, 0 0 35px #28a745 !important;
    transform: scale(1.1) !important;
}

.demo-pointer {
    animation: demoPointer 1.5s infinite !important;
    background-color: #ff6b35 !important;
    border-color: #ff6b35 !important;
    color: white !important;
    font-weight: bold !important;
    cursor: pointer !important;
}

.demo-pointer:hover {
    animation: none !important;
    box-shadow: 0 0 20px #ff6b35, 0 0 30px #ff6b35, 0 0 40px #ff6b35 !important;
    transform: scale(1.15) !important;
    background-color: #ff5722 !important;
    border-color: #ff5722 !important;
}
</style>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
{{-- <script src="{{asset('assets_m/plugins/global/plugins.bundle.js')}}"></script> --}}
		{{-- <script src="{{asset('assets_m/js/scripts.bundle.js')}}"></script> --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{asset('assets_m/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="{{asset('assets_m/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets_m/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/intro.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/utilities/modals/users-search.js')}}"></script>
<script>

// Property button click handler for demo mode
document.addEventListener('DOMContentLoaded', function() {
    const propertyBtn = document.getElementById('propertyBtn');
    if (propertyBtn) {
        propertyBtn.addEventListener('click', function() {
            // Stop the blinking animation
            propertyBtn.style.animation = 'none';
            propertyBtn.style.boxShadow = '';
            propertyBtn.style.transform = '';
        });
    }
});

function removeNotificationCard(button) {
    const card = button.closest('.notification-card');
    const container = card.parentElement;
    card.remove();
    // If no more notification cards remain, remove the entire alert section
    if (container.querySelectorAll('.notification-card').length === 0) {
        const alertSection = container.closest('.card-box');
        if (alertSection) {
            alertSection.style.display = 'none';
        }
    }
}
var userdata= "{{ $userdata }}";
// alert(JSON.parse(userdata))

var KTChartsWidget4 = function () {
    // Private methods
    var initChart = function() {
        var element = document.getElementById("kt_charts_widget_4");

        if (!element) {
            return;
        }

		// alert(values)


		// console.log(userdata);
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var lightColor = KTUtil.getCssVariableValue('--bs-primary');

        var options = {
            series: [{
                name: 'Total No Of Asset Acquired',
                data:  JSON.parse(userdata)
			           }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {

            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0,
                    stops: [0, 80, 100]
                }
            },
            stroke: {
                curve: 'smooth',
                show: true,
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC',''],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                tickAmount: 6,
                labels: {
                    rotate: 0,
                    rotateAlways: true,
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    position: 'front',
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    formatter: undefined,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },

            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function (val) {
                        return  parseInt(val) +' Assets'
                    }
                }
            },
            colors: [lightColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };

        var chart = new ApexCharts(element, options);

        // Set timeout to properly get the parent elements width
        setTimeout(function() {
            chart.render();
        }, 200);
    }


    // Public methods
    return {
        init: function () {
            initChart();
        }
    }
}();


            </script>

