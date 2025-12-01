@extends('layout.auth')
<style>
    span#email_error {
        width: 100%;
    }

    form-holder {
    margin-left: 550px;
    width: 100%;
}

.form-holder .form-content {
    position: relative;
    text-align: center;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    min-height: 100%;
    top: 75px
}

.form-holder .form-content ::-webkit-input-placeholder {
    color: #526489;
}

.form-holder .form-content :-moz-placeholder {
    color: #526489;
}

.form-holder .form-content ::-moz-placeholder {
    color: #526489;
}

.form-holder .form-content :-ms-input-placeholder {
    color: #526489;
}

</style>

@section('content')
    <!-- <section class="login-section">
                        <div class="container">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="login-box col-md-6 mb-4 mt-4">

                                    @include('common.notify')
                                    <a href="/" class="logoLogin"><img src="/logo.png" class="img-fluid"></a>
                                    <h3 class="text-center mb-3">Investor</h3>
                                    <div>
                                        <label>{{ __('E-Mail Address') }}</label>
                                        <div class="input-group">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
    @endif
                                        </div>
                                    </div>

                                    <div>
                                        <label>{{ __('Password') }}</label>
                                        <div class="input-group">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
    @endif
                                        </div>
                                    </div>


                                    {{-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">

                            <label class="form-check-label" for="remember">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div> --}}

                                    <div class="">
                                        <button type="submit"  class="btn btn-theme-dark">
                                            {{ __('Login') }}
                                        </button>

                                        <a href="{{ url('/register') }}" class="btn btn-light">Sign Up</a>
                                    </div>

                                    <div class="forgot-link">
                                        @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
    @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section> -->
    <div class="form-holder">
        <div class="form-content">
            <div class="form-items">
                <h3>Welcome, Investor.
                    @if($isDemo)
                        Please use the text credentials below to login to demo account.
                    @else
                        Please login with your user and password.
                    @endif
                    </h3>
                {{-- <p>If you have account with us, please login or you can click links at the bottom to register as Investor</p> --}}
                {{-- <div class="page-links">
                    <a href="{{ url('/login') }}" class="active">Login</a>
                </div> --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @include('common.notify')

                    <div class=" mb-2">
                        <input id="email_address" type="email" placeholder="xyz@gmail.com"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" required autofocus>

                        <span id="email_error" style="display:none;color:red;">Enter valid e-mail</span>
                    </div>

                    <div class="">
                        <input id="password" type="password" placeholder="Password"
                            class="mt-3 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required>
                    </div>

                    @include('components.recaptcha')

                    <div class="form-button mt-3">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                    @if(!$isDemo)
                    <p class="forgot-link">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                    <div class="d-flex align-items-center">
                        <div>Register as Issuer: <a href="{{ url('/issuer/register') }}" class=" btn-sm btn-link">Issuer Registration</a></div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div>Register as Investor: <a href="{{ url('/register') }}" class=" btn-sm btn-link">Investor Registration</a></div>
                    </div>
                    @endif
                    <!-- <p>Dont have an account? <br><a href="{{ url('/register') }}"> Sign up </a>as Investor / <a
                            href="{{ url('/issuer/register') }}"> Sign up </a> as Issuer</p> -->
                </form>

                @include('layout.links')
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script type="text/javascript">
        function preventBack() {
            window.history.forward();

        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
    <script>
        $(function() {
            $('#email_address').on('keyup', function() {
                var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.value);
                if (!re) {
                    $('#email_error').show();
                } else {
                    $('#email_error').hide();
                }
            });

            // Auto-fill demo credentials if available
            @if(isset($demoCredentials) && $demoCredentials)
                $('#email_address').val('{{ $demoCredentials["email"] }}');
                $('#password').val('{{ $demoCredentials["password"] }}');
            @endif
        });
    </script>
@endsection
