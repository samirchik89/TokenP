@extends('layout.auth')

@section('content')
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
        @include('common.notify')
            <form method="POST" action="{{ url('/check_password') }}">
                @csrf
                <div class="form-group row">
                    <b><label for="token_symbol" class="col-md-2 col-form-label"> Email</label></b>
                    <div class="col-md-10">
                        <input class="form-control" type="email" value="{{$user->email}}" name="email" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <b><label for="token_symbol" class="col-md-2 col-form-label"> Password</label></b>
                    <div class="col-md-10">
                        <input class="form-control" type="password" value="" name="password">
                    </div>
                </div>
                <div class="form-group row">
                    <b><label for="token_symbol" class="col-md-2 col-form-label">Confirm Password</label></b>
                    <div class="col-md-10">
                        <input class="form-control" type="password" value="" name="confirm_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-number-input" class="col-md-2 col-form-label"></label>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary mr-1 w-md">Reset Password</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection
