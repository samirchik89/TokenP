<!DOCTYPE html>
<html
  lang="en"
  class="layout-navbar-fixed layout-wide"
  dir="ltr"
  data-skin="default"
  data-assets-path="../../assets/"
  data-template="front-pages"
  data-bs-theme="light">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title>@yield('title')</title>

    <link rel="shortcut icon" type="image/png" href="">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <link href="{{asset('asset/package/css/custom.css')}}?v=1" rel="stylesheet">
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Vendor CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('main/vendor/bootstrap4/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('main/vendor/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/animate.css/animate.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('main/vendor/jscrollpane/jquery.jscrollpane.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('main/vendor/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/switchery/dist/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/DataTables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/DataTables/Buttons/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="http://big-bang-studio.com/neptune/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css">
    <link rel="stylesheet" href="{{ asset('main/vendor/dropify/dist/css/dropify.min.css') }}">
    <!-- Multiselect -->
    <link href="{{ asset('main/assets/css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <!-- Date range picker -->

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('main/assets/css/core.css') }}">

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        window.Laravel = @json([
            'csrfToken' => csrf_token(),
        ])
    </script>
    <style type="text/css">
        .rating-outer span,
        .rating-symbol-background {
            color: #ffe000 !important;
        }

        .rating-outer span,
        .rating-symbol-foreground {
            color: #ffe000 !important;
        }

        .error {
            color: #f00 !important;
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
    </style>
    @yield('styles')
</head>

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('admin.include.nav')
            <div class="layout-page">
                @include('admin.include.header')
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @include('common.notify')
                        @yield('content')
                    </div>
                    @include('admin.include.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js  -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->

    <script src="{{ asset('assets/js/main.js') }}"></script>

    {{-- <script type="text/javascript" src="{{ asset('main/vendor/jquery/jquery-1.12.3.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ethers/5.2.umd/ethers.umd.min.js"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/tether/js/tether.min.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('main/vendor/bootstrap4/js/bootstrap.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('main/vendor/detectmobilebrowser/detectmobilebrowser.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('main/vendor/jscrollpane/jquery.mousewheel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/jscrollpane/mwheelIntent.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/jscrollpane/jquery.jscrollpane.min.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('main/vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('main/vendor/waves/waves.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/JSZip/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/pdfmake/build/pdfmake.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/pdfmake/build/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Buttons/js/buttons.html5.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Buttons/js/buttons.print.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/DataTables/Buttons/js/buttons.colVis.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('main/vendor/switchery/dist/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/dropify/dist/js/dropify.min.js') }}"></script>

    <script type="text/javascript"
        src="{{ asset('main/vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/clockpicker/dist/jquery-clockpicker.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('main/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/moment/moment.js') }}"></script>
    <script type="text/javascript" src="{{ asset('main/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

    <!-- Neptune JS -->
    {{-- <script type="text/javascript" src="{{ asset('main/assets/js/app.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('main/assets/js/demo.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('main/assets/js/forms-pickers.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('main/assets/js/tables-datatable.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('main/assets/js/forms-upload.js') }}"></script>
    <script src="{{ asset('main/assets/js/bootstrap-multiselect.js') }} "></script>
    <script src="{{ asset('main/assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('main/assets/js/additional-method.js') }}"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @yield('scripts')

    {{-- <script type="text/javascript" src="{{asset('asset/js/rating.js')}}"></script>
    <script type="text/javascript">
        $('.rating').rating();
    </script> --}}

    <script type="text/javascript">
        function sendcoin(wireid, wireamount) {

            console.log(wireamount);
            $('#wireamount').val(wireamount);
            $('#wireid').val(wireid);
            $('#wallet').modal('show');
        }
    </script>

</body>

</html>
