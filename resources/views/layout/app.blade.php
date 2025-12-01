<!DOCTYPE html>
<html   lang="en"
class="layout-navbar-fixed layout-menu-fixed layout-wide"
dir="ltr"
data-skin="default"
    data-assets-path="{{ asset('assets/') }}"
    data-template="vertical-menu-template"
    data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>{{ $project_name }} | Build Your Real Estate Portfolio</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

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

    <script src="https://cdn.jsdelivr.net/npm/ethers@5.6.2/dist/ethers.umd.min.js"></script>

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    {{-- @include('include.styles') --}}

    <!-- endbuild -->

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <link href="{{asset('asset/package/css/custom.css')}}?v=1" rel="stylesheet">
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <style>
        span.progress-txt {
            min-height: 60px;
            overflow: hidden
        }

        .pro-name {
            min-height: 102px;
        }

        .pro-box.equal-height {
            min-height: 740px;
        }

        .pro-name.pb-4 {
            min-height: 125px;
            overflow: hidden
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
            z-index: 999999;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #f3f3f3;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .mainlayout-height {
            overflow-y: auto;
            margin-top: 80px;
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
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('include.sidebar')
            <div class="layout-page">
                @include('issuer.layout.navbar')
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @include('common.notify')
                        @yield('content')
                    </div>
                    @include('issuer.layout.footer')
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
    <script>
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
            var regex = /^[a-zA-Z\s]+$/;

            if (!regex.test(key)) {
                ev.returnValue = false;
                if (ev.preventDefault) ev.preventDefault();
            }
        })

        $('.passwordField').on('keyup', function(e) {
            var ev = e || window.event;
            var key = ev.keyCode || ev.which;
            key = String.fromCharCode(key);
            var regex = /^(?=(.*[!@#$%^&*()\-__+.]){1,})(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})$/;
            $(this).next(span).remove()
            if (!regex.test(key)) {
                $(this).after(
                    "<span class='text-danger'>password must be 6 digits, must contain 1 capital letter, 1 special character, 1 number </span>"
                    )
                // if (ev.preventDefault) ev.preventDefault();
            }
        })

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            //   alert.slideDown();
            //     window.setTimeout(function() {
            //       alert.slideUp();
            //     }, 2500);
            toastr.success('Copied.')
        }

        $('input[type=file]').on('change', function(e) {
            var fieldFormat = $(this).data('format')
            var imageFormat = this.files[0].name.split('.').pop()
            $(this).next('span').remove()
            if (fieldFormat == 'image' && imageFormat != 'png' && imageFormat != 'jpg' && imageFormat != 'jpeg') {
                $(this).after("<span class='text-danger'>* File should be valid " + fieldFormat + " * </span>")
                this.value = "";
                return false;
            }
            if (this.files[0].size > 4194304) {
                $(this).after("<span class='text-danger'>* Maximum file size 4MB! * </span>")
                this.value = "";
            };
        })
    </script>
    <script>
        window.onload = function () {
            const loader = document.getElementById('page-loader');
            const content = document.getElementById('content');

            setTimeout(() => {
                if(loader){
                    loader.style.display = 'none';
                }

            }, 1000);
        };
    </script>
    <!-- Scripts -->
    @include('include.scripts')
    <!-- Page JS -->
    <style>
        .tab-pane.active {
            opacity: 1!important;
            transition: opacity 0.3s ease-in-out;
            display: block!important;
        }
    </style>
    @include('front.tawk')
</body>

</html>
