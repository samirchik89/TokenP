<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>{{ Setting::get('site_title', 'Ico Investors') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="pages/ico/60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="pages/ico/76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="pages/ico/120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="pages/ico/152.png">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link rel="stylesheet" type="text/css" href="{{asset('landing/css/styles.css')}}">
    <style type="text/css">
    .verify-sec {
        max-width: 550px;
        margin: 100px auto;
        border: 0px;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, .18);
        padding: 20px;
        text-align: center;
        background-color:#fff;
    }
    body {
        background-color: rgb(235,235,235);
    }

    .verify-sec h3, p {
        font-weight: normal;
        color: #AFA391;
        font-family: CircularStd-Medium, sans-serif;
    }
    </style>
</head>

<body class="fixed-header " >
    <div class="register-container full-height sm-p-t-30">
        <div class="d-flex justify-content-center flex-column full-height ">
            <!--<img height="50" src="{{ img(Setting::get('site_logo')) }}" alt="" />
             <h3>Pages makes it easy to enjoy what matters the most in your life</h3> -->
            <!--  <p>
          Create a pages account. If you have a facebook account, log into it for this process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a>
        </p> -->
            <div class="verify-sec text-center">
                <div class="verify-logo">
                    <img style="height: 20%;width: 20%;" src="{{ img(Setting::get('site_logo')) }}" alt="logo">
                </div>
                <h3>@lang('user.reg')</h3>
                <p>@lang('user.email_content') <a href="{{url('/login')}}">@lang('user.profiles.login')</a></p>
            </div>
        </div>
    </div>
</body>



</html>