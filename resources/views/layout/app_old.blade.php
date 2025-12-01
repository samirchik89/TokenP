<!DOCTYPE html>
<html>

<head>
    <title>{{ Setting::get('site_title') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:300,400,500,700" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="{{ asset('asset/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/css/slick.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/slick-theme.css') }}">

    <!-- Data Table CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/datatables.min.css') }}" />
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/jquery.dataTables.min.css') }}" /> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/responsive.dataTables.min.css') }}" />


    <!-- Style CSS -->
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <style type="text/css">
        .errors {
            color: #f00;
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
</head>

<body>
    @if (Auth::check())
        @include('include.header')
        <main class="content-wrapper">
        @else
            <main class="content-wrapper login">
    @endif

    @if (Auth::check())
        @include('common.notify')
    @endif

    @yield('content')

    </main>
    @include('include.footer')

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- jquery -->
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <!-- bootstrap-4 -->
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap-popper.min.js') }}"></script>
    <!-- <script src="{{ asset('asset/js/bootstrap-slim.min.js') }}"></script> -->
    <!-- Fontawesome -->
    <script type="text/javascript" src="{{ asset('asset/js/all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/fontawesome.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/slick.min.js') }}"></script>

    <!-- Data Table CSS -->


    <script type="text/javascript" src="{{ asset('asset/js/datatables.min.js') }} "></script>
    <!-- <script type="text/javascript" src="{{ asset('asset/js/dataTables.bootstrap4.min.js') }} "></script> -->
    <script type="text/javascript" src="{{ asset('asset/js/dataTables.responsive.min.js') }}"></script>

    <!-- Google chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Scripts -->
    <script type="text/javascript" src="{{ asset('asset/js/script.js') }}"></script>

    <script>
        $('input[type=number]').on('keypress', function(e) {
            var ev = e || window.event;
            var key = ev.keyCode || ev.which;
            key = String.fromCharCode(key);
            var regex = /^[0-9]*\.?[0-9]*$/;

            if (!regex.test(key) || this.value > 100000000000) {
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
    </script>
    @yield('scripts')

</body>

</html>
