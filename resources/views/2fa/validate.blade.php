@extends('layout.auth')

@section('content') 
<div class="form-holder">
    <div class="form-content">
        <div class="form-items">
           <div class="card-box twofactorBox">
                    <div class="card-header"><h5>Two Factor Authentication</h5></div>

                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="/2fa/validate">
                            {!! csrf_field() !!} 

                            <div class="row form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                                <label class="col-12 control-label">One Time Password</label>

                                <div class="col-sm-6">
                                    <input type="number" class="form-control" name="totp">
                                    @if ($errors->has('totp'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('totp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary twoFactorBtn">
                                        <i class=""></i>Validate
                                    </button>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection