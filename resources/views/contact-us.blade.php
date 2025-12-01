@extends('layout.app')

@section('content')
<!-- Breadcrumb -->
<div class="page-content">
    <div class="pro-breadcrumbs">
        <div class="container">
            <a href="{{url('/dashboard')}}" class="pro-breadcrumbs-item">Home</a>
            <span>/</span>
            <a href="#" class="pro-breadcrumbs-item">Contact Us</a>
        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- Property Head Starts -->
    <div class="property-head grey-bg pt30">
        <div class="container">
            <div class="property-head-btm row">
                <div class="col-md-12">
                    <h2 class="pro-head-tit">Contact Us</h2>
                    {{-- <p class="pro-head-txt">Hello, User</p> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Property Head Ends -->

    <!-- Property Tab Starts -->
    <div class="property-tab">
        <div class="pro-tab-wrap">
            <div class="container">
              <p>{{ Setting::get('enquiry_mail') }}</p>
            </div>
        </div>
        <!-- Tab panes -->
    </div>
</div>
<!-- Property Tab Ends -->
@endsection


@section('scripts')
<script type="text/javascript">
    //My Investment
    Highcharts.chart('container-chat', {
        chart: {
            type: 'column'
        },
        xAxis: {
            categories: ['Apr 18', 'May 18', 'Jun 18', 'Jul 18', 'Aug 18', 'Sep 18', 'Oct 18', 'Nov 18', 'Dec 18', 'Jan 18', 'Feb 18', 'Mar 18']
        },
        yAxis: {
            labels: {
                formatter: function() {
                    if (this.value >= 1E6) {
                        return (this.value / 1000000).toFixed(2) + 'M';
                    }
                    return this.value / 1000 + 'k';
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Sample Property I',
            data: [815, 2323, 1224, 1427, 2122, 5323, 2216, 4453, 9231, 3242, 6434, 5325]
        }, {
            name: 'Sample Property II',
            data: [1235, 2132, 3543, 2342, 2351, 3464, 5632, 1321, 5648, 3245, 4636, 1233]
        }, {
            name: 'Sample Property III',
            data: [2343, 5324, 3454, 6432, 7535, 3123, 1239, 4654, 3236, 7555, 2317, 9323]
        }]
    });

    //My Investment 2
    Highcharts.chart('container-chat2', {
        chart: {
            type: 'column'
        },
        xAxis: {
            categories: ['Apr 18', 'May 18', 'Jun 18', 'Jul 18', 'Aug 18', 'Sep 18', 'Oct 18', 'Nov 18', 'Dec 18', 'Jan 18', 'Feb 18', 'Mar 18']
        },
        yAxis: {
            labels: {
                formatter: function() {
                    if (this.value >= 1E6) {
                        return (this.value / 1000000).toFixed(2) + 'M';
                    }
                    return this.value / 1000 + 'k';
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Sample Property I',
            data: [815, 2323, 1224, 1427, 2122, 5323, 2216, 4453, 9231, 3242, 6434, 5325]
        }, {
            name: 'Sample Property II',
            data: [1235, 2132, 3543, 2342, 2351, 3464, 5632, 1321, 5648, 3245, 4636, 1233]
        }, {
            name: 'Sample Property III',
            data: [2343, 5324, 3454, 6432, 7535, 3123, 1239, 4654, 3236, 7555, 2317, 9323]
        }]
    });

    //My Investment3
    Highcharts.chart('container-chat3', {
        chart: {
            type: 'column'
        },
        xAxis: {
            categories: ['Apr 18', 'May 18', 'Jun 18', 'Jul 18', 'Aug 18', 'Sep 18', 'Oct 18', 'Nov 18', 'Dec 18', 'Jan 18', 'Feb 18', 'Mar 18']
        },
        yAxis: {
            labels: {
                formatter: function() {
                    if (this.value >= 1E6) {
                        return (this.value / 1000000).toFixed(2) + 'M';
                    }
                    return this.value / 1000 + 'k';
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Sample Property I',
            data: [815, 2323, 1224, 1427, 2122, 5323, 2216, 4453, 9231, 3242, 6434, 5325]
        }, {
            name: 'Sample Property II',
            data: [1235, 2132, 3543, 2342, 2351, 3464, 5632, 1321, 5648, 3245, 4636, 1233]
        }, {
            name: 'Sample Property III',
            data: [2343, 5324, 3454, 6432, 7535, 3123, 1239, 4654, 3236, 7555, 2317, 9323]
        }]
    });

    // Bar Chart 1
    Highcharts.chart('container', {
        data: {
            table: 'datatable'
        },
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        yAxis: {
            categories: ['2000$', '4000$', '6000$', '8000$', '10000$', '12000$'],
            title: {
                text: 'Dollars',
                overflow: 'justify'
            }
        },

        tooltip: {
            formatter: function() {
                return '<b>' + this.series.name + '</b><br/>' +
                    this.point.y + ' ' + this.point.name.toLowerCase();
            }
        }
    });
    // End Bar Chart 1

    //owlCarousel
    $(".owl-carousel").owlCarousel({

        autoPlay: false, //Set AutoPlay to 3 seconds
        dots: false,
        items: 3,
        itemsDesktop: [1199, 3],
        itemsDesktopSmall: [979, 2]
    });
    //owlCarousel

    /* Signature Code */
    function readURL(input) {
        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();

                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();

                $('.image-title').html(input.files[0].name);
            };

            reader.readAsDataURL(input.files[0]);

        } else {
            removeUpload();
        }
    }

    function removeUpload() {
        $('.file-upload-input').replaceWith($('.file-upload-input').clone());
        $('.file-upload-content').hide();
        $('.image-upload-wrap').show();
    }
    $('.image-upload-wrap').bind('dragover', function() {
        $('.image-upload-wrap').addClass('image-dropping');
    });
    $('.image-upload-wrap').bind('dragleave', function() {
        $('.image-upload-wrap').removeClass('image-dropping');
    });
    /*End Signature Code */

    $(function() {
        $("#map").googleMap({
            zoom: 15, // Initial zoom level (optional)
            coords: [17.438136, 78.395246], // Map center (optional)
            type: "ROADMAP" // Map type (optional)
        });
    })

    //Date Picker 

    $('#datePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });
</script>
@endsection
