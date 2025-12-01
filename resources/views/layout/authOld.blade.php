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
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <!-- fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC:300,400,500,700" rel="stylesheet">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/iofrm-theme3.css') }}">



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('issuer/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('issuer/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet" />

    @include('include.styles')

    <style>
        .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
            background-image: none !important;
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


    <div class="" class="container-fluid">
        @include('include.header')

        <div class="row">
            <div class="col-lg-6 pl-0 p-0">
                <div class="img-holder">
                    <div class="bg"></div>
                    <div class="info-holder">

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- jquery -->
    <script type="text/javascript" src="{{ asset('asset/login/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/login/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/login/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/login/js/main.js') }}"></script>

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

        $('.passwordField').on('keyup', function(e) {
            var ev = e || window.event;
            var key = $(this).val();

            var regex = /^(?=(.*[A-Z]){1,})(?=(.*[0-9]){1,})(?=(.*[!@#$%^&*()\-__+.]){1,}).{6,}$/;
            $(this).next('span').remove()
            $('.registerButton').attr('disabled', false);
            $('.pass-match-error').remove();

            if (!regex.test(key)) {
                $('.registerButton').attr('disabled', true);
                $('.pass-match-error').remove();

                $('.registerButton').after(
                    '<span class="text-danger pass-match-error">Please fill valid details!</span>')
                //    window.location.href = '#';
                $(this).after(
                    "<span class='text-danger pb-3 d-block'>Password must be 6 digits, must contain 1 capital letter, 1 special character, 1 number </span>"
                )
            }
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            $('#confirm_password').next('span').remove();
            $('.registerButton').attr('disabled', false);
            if (password != confirm_password) {
                $('.registerButton').attr('disabled', true);
                $('.pass-match-error').remove();
                $('.registerButton').after(
                    '<span class="text-danger pass-match-error">Please fill valid details!</span>')
                //    window.location.href = '#'

                $('#confirm_password').after(
                    "<span class='text-danger pb-3 d-block'>Password Confirmation does not match</span>")
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
