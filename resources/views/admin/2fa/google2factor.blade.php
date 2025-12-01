@extends('admin.layout.base')

@section('title', 'Admin Google Two Factor Authendication ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box bg-white text-center p-30">
            <div class="auth-section">
                <h5>@lang('admin.include.g2f_auth')</h5>

                <div class="panel-body p-t-20">
                    @if (Auth::user()->google2fa_secret)
				      	<a href="{{ url('admin/2fa/disable') }}" class="btn btn-warning">Disable 2FA</a>
				    @else
				      	<a href="{{ url('admin/2fa/enable') }}" class="btn btn-primary prime-color">Enable 2FA</a>
				    @endif
                    
                </div>
            </div>
         </div>
    </div>              
</div>
@endsection