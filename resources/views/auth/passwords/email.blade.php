@extends('layout.auth')

@section('content')
<!-- <div class="container">
    <div class="row">
        <div class="col-sm-6 offset-md-3 top_rate">
            <div class="card-box twofactorBox mt-5">
                <div class="card-header"><h5>{{ __('Reset Password') }}</h5></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-12 col-form-label text-left">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                            <div class="text-center col-xl-12 mt-3">
                                <a href="{{ url('/login') }}" class="link">Back to Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
        @include('common.notify')
            <h3>Get more things done with Login platform.</h3>
            <p>If you have account with us,please log in.You can also use your social accounts to access the
                login.</p>
            <div class="page-links">
                <a href="{{ url('/trigger_mail') }}" class="active">Forget Password</a>
            </div>
            <form method="POST" action="{{ url('/trigger_mail') }}">
                @csrf
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="input-group mb-2">
                    <input id="email" placeholder="Email ID (xyz@gmail.com)"  type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>


                <div class="form-button mb-3">
                    <button type="submit"  class="ibtn btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                    <a href="{{ url('/login') }}" class="">Back to Login</a>
                    <p></p>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
