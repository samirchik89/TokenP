@extends('layout.issuerauth')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
@section('content')
    {{-- <section class="login-section">
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


                    <-- <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div> --!>

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
    </section> --}}
    <div class="form-holder">
        <div class="form-content">
            <div class="form-items">
                <h3>Get more things done with Login platform.</h3>
                <p>If you have account with us,please log in.You can also use your social accounts to access the
                    login.</p>
                <div class="page-links">
                    <a href="{{ url('/login') }}" class="active">Login</a>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    @include('common.notify')
                    <!-- <input class="form-control" type="text" name="username" placeholder="E-mail Address"
                            required> -->
                    <div class="input-group mb-2">
                        <input placeholder="xyz@gmail.com" id="email_address" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ old('email') }}" required autofocus>
                        <span id="email_error" style="display:none;color:red;">Enter valid e-mail</span>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <!-- <input class="form-control" type="password" name="password" placeholder="Password" required> -->
                    <div class="input-group">
                        <input id="password" placeholder="Password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required>
                        <i class="far fa-eye" id="togglePassword"></i>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-button">
                        <!-- <a href="#" class="ibtn">Login</a> -->
                        <button type="submit" class="ibtn">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <p class="forgot-link">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </p>
                    {{-- <p>Dont have an account? <a href="{{ url('/issuer/register') }}"> Sign up </a></p> --}}
                    <p>Dont have an account? <br> <a href="{{ url('/register') }}"> Sign up </a>as Investor / <a
                            href="{{ url('/issuer/register') }}"> Sign up </a> as Issuer</p>
                </form>
                <div class="other-links">
                    <span>Or login with</span><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"><i
                            class="fab fa-google"></i></a><a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .input-group>.custom-file,
        .input-group>.custom-select,
        .input-group>.form-control {
            flex: none;
            width: 100%;
        }

        .input-group i {
            margin-top: 10px;
            cursor: pointer;
            margin-left: -30px;
            z-index: 10;
        }

        .fa,
        .far,
        .fas {
            display: inline;
        }
    </style>
    <script type="text/javascript">
        function preventBack() {
            console.log("prevent")
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(function() {
            $('#email_address').on('keyup', function() {
            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.value);
            if (!re) {
                $('#email_error').show();
            } else {
                $('#email_error').hide();
            }
        })
        // fa-eye fa-eye-slash
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the icon
            this.classList.toggle('fa-eye-slash');

        });
    </script>
@endsection
