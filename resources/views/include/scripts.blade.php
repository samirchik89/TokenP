
<!-- JavaScript Files -->
@if(!Request::is('investment'))
<script src="{{ asset('asset/package/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('issuer/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('issuer/assets/js/app.min.js') }}"></script>
@else
<script src="{{ asset('issuer/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('issuer/assets/js/app.min.js') }}"></script>
<script src="{{ asset('asset/package/js/bootstrap.min.js') }}"></script>
@endif

<!-- Data Table -->
<script src="{{ asset('asset/package/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('asset/package/js/datatable/pdfmake.min.js') }}"></script>
<!-- End Data Table -->
<script src="{{ asset('asset/package/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('asset/package/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ asset('asset/package/js/jquery.flexslider.js') }}"></script>
<script src="{{ asset('asset/package/js/jquery.animateNumber.js') }}"></script>
<script src="{{ asset('asset/package/js/jquery.appear.js') }}"></script>
<script src="{{ asset('asset/package/js/stellar.js') }}"></script>
<script src="{{ asset('asset/package/js/animations.js') }}"></script>
<!-- Include Bootstrap Datepicker -->
<script src="{{ asset('asset/package/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Wizard -->
<script src="{{ asset('asset/package/js/wizard/jquery.tooltipster.min.js') }}"></script>
<script src="{{ asset('asset/package/js/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('asset/package/js/wizard/wizard.js') }}"></script>
<!-- Owl -->
<script src="{{ asset('asset/package/js/owl.carousel.js') }}"></script>
<!-- Select -->
<!-- <script src="{{ asset('asset/package/js/jquery.nice-select.min.js') }}"></script> -->
<!-- Slick Slider -->
<script src="{{ asset('asset/package/js/slick.min.js') }}"></script>
<!-- High Chart JS -->
<script src="{{ asset('asset/package/js/highcharts.js') }}"></script>
<script src="{{ asset('asset/package/js/data.js') }}"></script>
<script src="{{ asset('asset/package/js/exporting.js') }}"></script>
<script src="{{ asset('asset/package/js/export-data.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('asset/package/js/chart.min.js') }}"></script>
<!-- Canvas JS -->
<script src="{{ asset('asset/package/js/graph.min.js') }}"></script>
<!-- Social Share JS -->
<script src="{{ asset('asset/package/js/TweenMax.min.js') }}"></script>
<!-- Tool Tip -->
<script src="{{ asset('asset/package/js/tooltipster.bundle.min.js') }}"></script>
<!-- Match Height JS -->
<script src="{{ asset('asset/package/js/jquery.matchHeight-min.js') }}"></script>
{{-- <script src="{{asset('asset/package/js/main.js')}}"></script> --}}
<!-- PopImage JS -->
<script src="{{ asset('js/popImg.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $(".popImage").popImg();
    });
</script>
<!-- Chat JS Start -->


<!-- TODO: Missing CoffeeScript 2 -->
<script>
    $(document).ready(function() {
        $(".table-currencies").click(function() {
            $('.table-currencies').removeClass('introactive');
            $(this).addClass('introactive');
        });
    });
</script>


<script>
    $(document).ready(function() {
        // DataTable initialisation
        $('.datatable-full').DataTable(

            {
                "order": [
                    [1, "desc"]
                ],
                "dom": '<"dt-buttons"Bf><"clear">lirtp',
                "paging": true,
                "autoWidth": true,
                "buttons": [
                    'colvis',
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    'print'
                ]
            });
    });
</script>


<script>
    'use strict';

    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    (function(global) {
        var MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        var COLORS = [
            '#4dc9f6',
            '#f67019',
            '#f53794',
            '#537bc4',
            '#acc236',
            '#166a8f',
            '#00a950',
            '#58595b',
            '#8549ba'
        ];

        var Samples = global.Samples || (global.Samples = {});
        var Color = global.Color;

        Samples.utils = {
            // Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
            srand: function(seed) {
                this._seed = seed;
            },

            rand: function(min, max) {
                var seed = this._seed;
                min = min === undefined ? 0 : min;
                max = max === undefined ? 1 : max;
                this._seed = (seed * 9301 + 49297) % 233280;
                return min + (this._seed / 233280) * (max - min);
            },

            numbers: function(config) {
                var cfg = config || {};
                var min = cfg.min || 0;
                var max = cfg.max || 1;
                var from = cfg.from || [];
                var count = cfg.count || 8;
                var decimals = cfg.decimals || 8;
                var continuity = cfg.continuity || 1;
                var dfactor = Math.pow(10, decimals) || 0;
                var data = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = (from[i] || 0) + this.rand(min, max);
                    if (this.rand() <= continuity) {
                        data.push(Math.round(dfactor * value) / dfactor);
                    } else {
                        data.push(null);
                    }
                }

                return data;
            },

            labels: function(config) {
                var cfg = config || {};
                var min = cfg.min || 0;
                var max = cfg.max || 100;
                var count = cfg.count || 8;
                var step = (max - min) / count;
                var decimals = cfg.decimals || 8;
                var dfactor = Math.pow(10, decimals) || 0;
                var prefix = cfg.prefix || '';
                var values = [];
                var i;

                for (i = min; i < max; i += step) {
                    values.push(prefix + Math.round(dfactor * i) / dfactor);
                }

                return values;
            },

            months: function(config) {
                var cfg = config || {};
                var count = cfg.count || 12;
                var section = cfg.section;
                var values = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = MONTHS[Math.ceil(i) % 12];
                    values.push(value.substring(0, section));
                }

                return values;
            },

            color: function(index) {
                return COLORS[index % COLORS.length];
            },

            transparentize: function(color, opacity) {
                var alpha = opacity === undefined ? 0.5 : 1 - opacity;
                return Color(color).alpha(alpha).rgbString();
            }
        };

        // DEPRECATED
        window.randomScalingFactor = function() {
            return Math.round(Samples.utils.rand(-100, 100));
        };

        // INITIALIZATION

        Samples.utils.srand(Date.now());



    }(this));


    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
        'November', 'December'
    ];

    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };

    var config = {
        type: 'line',
        data: {
            labels: ['April 2018', 'May 2018', 'June 2018', 'July 2018', 'August 2018', 'September 2018'],
            datasets: [{
                label: 'Purchase',
                backgroundColor: window.chartColors.red,
                borderColor: window.chartColors.red,
                data: [186, 3311, 633, 2221, 5783, 8478],
                fill: false,
            }, {
                label: 'Sale',
                fill: false,
                backgroundColor: window.chartColors.blue,
                borderColor: window.chartColors.blue,
                data: [586, 5114, 7633, 3221, 3783, 5478],
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Investment Timeline'
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        min: 0,
                        max: 9000,

                        // forces step size to be 5 units
                        stepSize: 1000
                    }
                }]
            }
        }
    };
    /*
    window.onload = function() {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myLine = new Chart(ctx, config);

         var ctx2 = document.getElementById('canvas2').getContext('2d');
        window.myLine = new Chart(ctx2, config);
    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return randomScalingFactor();
            });
        });

        window.myLine.update();
    });

    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[config.data.datasets.length % colorNames.length];
        var newColor = window.chartColors[colorName];
        var newDataset = {
            label: 'Dataset ' + config.data.datasets.length,
            backgroundColor: newColor,
            borderColor: newColor,
            data: [],
            fill: false
        };

        for (var index = 0; index < config.data.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        config.data.datasets.push(newDataset);
        window.myLine.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
        if (config.data.datasets.length > 0) {
            var month = MONTHS[config.data.labels.length % MONTHS.length];
            config.data.labels.push(month);

            config.data.datasets.forEach(function(dataset) {
                dataset.data.push(randomScalingFactor());
            });

            window.myLine.update();
        }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
        config.data.datasets.splice(0, 1);
        window.myLine.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
        config.data.labels.splice(-1, 1); // remove the label first

        config.data.datasets.forEach(function(dataset) {
            dataset.data.pop();
        });

        window.myLine.update();
    });*/
</script>
<!-- End Chat JS -->
<!-- Map JS -->
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC808NpIO-MZ_C-nXv21zGFDKC1OUm_MkQ"></script>
<script src="{{ asset('asset/package/js/jquery.googlemap.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $("#map").googleMap({
            zoom: 15, // Initial zoom level (optional)
            coords: [48.895651, 2.290569], // Map center (optional)
            type: "ROADMAP" // Map type (optional)
        });
    })
</script>

@yield('scripts')
