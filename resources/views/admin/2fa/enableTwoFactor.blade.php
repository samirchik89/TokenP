@extends('admin.layout.base')

@section('title', 'Admin Google Two Factor Authendication ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box bg-white text-center p-30">
            <div class="auth-section">
                <h5>@lang('user.2factor.secret_key')</h5>
                    

                <div class="panel-body">
                    @lang('user.2factor.qrcode')
                    <br />
                    <img alt="Image of QR barcode" src="{{ $image }}" />

                    <br />
                    @lang('user.2factor.number') <code>{{ $secret }}</code>
                    <br /><br />

                    <br />
                    <input type="number" id="totp" name="totp" class="form-control" placeholder="Enter your otp" style="max-width: 300px;margin: 0 auto;" required /><br>
                    <center><button type="button" class="btn btn-primary" onclick="myfuncgoogleotp();" >Submit</button></center>
                    <br>

                    <p style="display: none;" id="otp_msg"></p>
                    
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
            if(response.status==1){                
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