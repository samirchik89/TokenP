@extends('admin.layout.base')

@section('title', 'Admin Google Two Factor Authendication ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box bg-white text-center p-30">
        	<div class="auth-section">
	            <h5>@lang('admin.include.g2f_auth')</h5>

                <div class="panel-body">
                    @lang('admin.include.g2f_auth_disable')
                    <br /><br />
                    
                </div>
	        </div>
        </div>
    </div>
</div>
@endsection