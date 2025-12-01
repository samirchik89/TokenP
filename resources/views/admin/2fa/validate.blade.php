@extends('admin.layout.auth')

@section('content')
<div class="sign-form">
    <div class="row">
        <div class="col-md-12">
            <div class="two-fac">
                <div class="box b-a-0">
                    <div class="p-2 text-xs-center bg-w">
                        <h5 class="m-0">@lang('user.2fa')</h5>
                    </div>

                    <div class="panel-body bg-w">
                        <!-- <form class="form-horizontal" role="form" method="POST" action="{{url('/admin/2fa/validate')}}"> -->
                        <form class="form-horizontal" role="form" method="POST" action="/admin/2fa/validate">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label class="control-label text-xs-center">@lang('user.onetime_pass')</label>
                                </div>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="totp">                       
                                    @if ($errors->has('totp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('totp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary m-t-10">
                                        <i class=""></i>@lang('user.validate')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
