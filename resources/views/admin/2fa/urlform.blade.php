@extends('admin.layout.base')

@section('title', 'Admin Google Two Factor Authendication ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box bg-white p-30">
            <div class="auth-section">
                <h5 class="text-center">@lang('user.2factor.secret_key')</h5>
                    

                <div class="panel-body">
                    @lang('user.2factor.url_form')
                    <br />
                     <form class="form-horizontal" role="form" method="POST" action="/admin/2fa/urlvalidate">
                            {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('totp') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label p-0">@lang('user.onetime_pass')</label>

                            <div class="col-md-6">
                                <input type="hidden" name="route_url" value="{{$url_param}}" />
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
       
@endsection


@section ('scripts')

      <script type="text/javascript">
    function myfuncgoogleotp() {

        var otp=$('#totp').val();

        $.ajax({
              url: "{{url('/admin/g2fotpcheckenable')}}",
              type: "POST",
              data:{"_token": '{{ csrf_token() }}','totp':otp}
        }).done(function(response){

            console.log(response);
            if(response.status==1){
                //$("#otp_msg").html('<span style="color:green;">'+response.message+'</span>');
                //$("#otp_msg").show().delay(5000).fadeOut();                
                window.location.href="{{url('/admin/Google2fa')}}?google_succ=1";
            }else{
                $("#otp_msg").html('<span style="color:red;">'+response.message+'</span>');
                $("#otp_msg").show().delay(5000).fadeOut();
            }
            

        }).fail(function(jqXhr,status){

        });

    }
</script>

@endsection