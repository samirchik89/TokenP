<!DOCTYPE html>
<html>

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="keywords" content="Real Estate" />
    <meta name="description" content="Real Estate">
    <meta name="author" content="STO">
    <title>{{ $project_name }} | Build Your Real Estate Portfolio</title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Webfonts -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />

    <!-- Style -->
    @include('include.styles')
    <!-- End Style -->
    <style>
        span.progress-txt {
            min-height: 60px;
        }

        .pro-name {
            min-height: 102px;
        }

        .pro-box.equal-height {
            min-height: 690px;
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

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
    <div class="body">

        <!-- Header -->
        @include('include.header')
        <!-- End Header -->

        @yield('content')
        <!-- Footer -->
        {{-- @include('include.footer') --}}

        <!-- End Footer -->
    </div>

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

    <!-- Scripts -->
    @include('include.scripts')
</body>

</html>
