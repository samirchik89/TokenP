@extends('admin.layout.base')

@section('title', 'Dashboard ')

@section('styles')
<link rel="stylesheet" href="{{asset('main/vendor/jvectormap/jquery-jvectormap-2.0.3.css')}}">
@endsection
<style>
	#design {
  width: 190px;
  height: 254px;
  background: #07182E;
  position: relative;
  display: flex;
  color:white;
  place-content: center;
  place-items: center;
  overflow: hidden;
  border-radius: 20px;
}
.card{
	box-shadow: 2px 2px 12px 9px grey;

}
#design h2 {
  z-index: 1;
  color: white;
  font-size: 2em;
}

#design::before {
  content: '';
  position: absolute;
  width: 100px;
  background-image: linear-gradient(180deg, rgb(0, 183, 255), rgb(255, 48, 255));
  height: 130%;
  animation: rotBGimg 3s linear infinite;
  transition: all 0.2s linear;
}

@keyframes rotBGimg {
  from {
    transform: rotate(0deg);
  }

  to {
    transform: rotate(360deg);
  }
}

#design::after {
  content: '';
  position: absolute;
  background: #07182E;
  ;
  inset: 5px;
  border-radius: 15px;
}

/* .card:hover:before {
  background-image: linear-gradient(180deg, rgb(81, 255, 0), purple);
  animation: rotBGimg 3.5s linear infinite;
} */


</style>
@section('content')
<div class="content-area py-1">
	<div class="container-fluid">
		<div class="row row-md">
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h6 class="text-uppercase mb-1">Total Net Investments</h6>
						<h1 class="mb-1">{{ number_format(@$totalNetInvestment,2) }} $</h1>

					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-6 col-xs-12">

				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h6 class="text-uppercase mb-1">ETH Balance</h6>
						<h1 class="mb-1 text-center">{{ number_format(@$fiat_balance,2) }}$</h1>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h6 class="text-uppercase mb-1">MATIC Balance</h6>
						<h1 class="mb-1">{{number_format( @$ETH_balance,2) }} MATIC</h1>

					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-xs-12">
				<div class="box box-block bg-white tile tile-1 mb-2" id="design">
					<div class="t-icon right"></div>
					<div class="t-content">
						<h6 class="text-uppercase mb-1">MATIC Balance</h6>
						<h1 class="mb-1">{{number_format( @$ETH_balance,2) }} MATIC</h1>

					</div>
				</div>
			</div>
		</div>
		@php
			$userdata=json_encode(array_values($tokens));
			$userdata_i=json_encode(array_values($tokens_i));
		@endphp
        <div class="row">
		<div class="col-xl-6 col-md-6">
			<div class="card"style="width:640px;margin-left:0px">
				<h3 style="margin-left:50px;margin-top:20px">No Of Shares Acquired By Investors</h3>

		  <!--end::Info-->
		  <!--begin::Chart-->
		  <div id="kt_charts_widget_4" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
						  </div>
		</div>
		<div class="col-xl-6 col-md-6">
			<div class="card"style="width:640px;margin-left:0px">
				<h3 style="margin-left:50px;margin-top:20px">No Of Tokens Acquired By Issuers</h3>

		  <!--end::Info-->
		  <!--begin::Chart-->
		  <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
						  </div>
		</div>
        </div>
	</div>
</div>

@endsection
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="{{asset('assets_m/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets_m/js/scripts.bundle.js')}}"></script>
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
var userdata="{{ $userdata }}";
var userdata_i="{{ $userdata_i }}";
var KTChartsWidget4 = function () {
    // Private methods
    var initChart = function() {
        var element = document.getElementById("kt_charts_widget_4");

        if (!element) {
            return;
        }
		// console.log(userdata);
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var lightColor = KTUtil.getCssVariableValue('--bs-primary');

        var options = {
            series: [{
                name: 'Total No Of shares Acquired',
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
                        return  parseInt(val) +' Shares'
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
var KTChartsWidget3 = function () {
    // Private methods
    var initChart = function() {
        var element = document.getElementById("kt_charts_widget_3");

        if (!element) {
            return;
        }
		// console.log(userdata);
        var height = parseInt(KTUtil.css(element, 'height'));
        var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
        var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
        var baseColor = KTUtil.getCssVariableValue('--bs-primary');
        var lightColor = KTUtil.getCssVariableValue('--bs-primary');

        var options = {
            series: [{
                name: 'Total No Of Tokens Acquired',
                data:  JSON.parse(userdata_i)
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
                        return  parseInt(val) +' Tokens'
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

