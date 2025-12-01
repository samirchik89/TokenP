<!DOCTYPE html>
<html>

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="keywords" content="Real Estate" />
    <meta name="description" content="Real Estate">
    <meta name="author" content="STO">
    <title>{{ $project_name }} | Build Your Real Estate Portfolio</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

     <!-- App css -->
     {{-- <link href="{{ asset('issuer/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"
     id="bootstrap-stylesheet" /> --}}
    <!-- Google Webfonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('issuer/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('issuer/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <!-- Style -->
    @include('include.styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- End Style -->
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

        .body.no-sidebar .content-page {
            margin-left: auto !important;
            margin-right: auto !important;
            padding: 20px !important;
            max-width: 100%; /* or whatever width suits your design */
        }

        .body.no-sidebar .content-page-inner {
            width: 100% !important;
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

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    <div id="page-loader" class="page-loader">
        <div class="spinner"></div>
    </div>
    <div class="body black_menu_me {{ !Auth::check() ? 'no-sidebar' : '' }}">

        <!-- Header -->
        @if (!Auth::check())
            @include('include.header')
        @else
            @include('include.new_header')
        @endif

        @if (Request::is('/'))
            @include('include.header')

        @endif
        @if (Auth::check())
            @include('include.sidebar')
        @endif

        <!-- End Header -->

        <div class="content-page mainlayout-height">
            <div class="content-page-inner">
                @include('common.notify', ['investor' => true])
            </div>
            @yield('content')
            <div class="mt-3">
                @include('include.footer')
            </div>
        </div>
    </div>


    <script src="{{ asset('asset/package/js/jquery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                loader.style.display = 'none';

            }, 1000);
        };
    </script>
    <!-- Scripts -->
    @include('include.scripts')

</body>

</html>
