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

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/login/css/iofrm-theme3.css') }}">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>

<style>
    .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
        background-image: none !important;
    }

    .info-holder p {
        color: #fff !important;
    }

    .here-btn {
        color: #fff !important;
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


<body>


    <div class="form-body" class="container-fluid">

        <div class="row">
            <div class="img-holder">
                <div class="bg" style="opacity: 0.5;"></div>
                {{-- <div class="info-holder">
                    <p>
                        Welcome, and thank you for choosing {{ Setting::get('site_title') }} as your gateway to
                        raising awareness and funding for your initiative.
                        We are here to guide you through the necessary steps required to ensure the success and
                        protection of your
                        project. </p>
                    <p>
                        Let’s make it happen !
                    </p>
                    <p>
                        Though the process always begins with the submission and review of your Prospectus or Offering
                        Memorandum,
                        we encourage you to reach out to our “onboarding customer service” to help expedite and support
                        your
                        experience.
                    </p>
                    <p>Once approved, you will be given access to set up your Member Account to start the offering
                        process.</p>
                    <p>You can submit your Prospectus/ OM by clicking <a class="here-btn"
                            href="{{ url('/issuer/register') }}">Here</a>. </p>
                </div> --}}
            </div>
            @yield('content')
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
            $('.pass-match-error').remove();
            $('.registerButton').attr('disabled', false);
            if (!regex.test(key)) {
                $('.pass-match-error').remove();
                $('.registerButton').attr('disabled', true);
                $('.registerButton').after(
                    '<span class="text-danger pass-match-error">Please fill valid details!</span>')
                //    window.location.href = '#'
                $(this).after(
                    "<span class='text-danger pb-3 d-block'>Password must be 6 digits, must contain 1 capital letter, 1 special character, 1 number </span>"
                )
            }
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            $('#confirm_password').next('span').remove();
            $('.registerButton').attr('disabled', false);
            if (password != confirm_password) {
                $('.pass-match-error').remove();
                $('.registerButton').attr('disabled', true);
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
