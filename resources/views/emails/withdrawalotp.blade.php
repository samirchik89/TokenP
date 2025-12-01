
<!DOCTYPE html>
<html>
    <head>
        <title>EMail Template</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet" />
        <style>
            @media (max-width: 767px) {
                .new-tab {
                    padding: 10px !important;
                    width: 100%;
                    max-width: 100% !important;
                    min-width: 100% !important;
                }
            }
        </style>
    </head>
    <body style="height: 100%; width: 100%; background-color: #646464; font-family: 'Open Sans', sans-serif; margin: 0; padding: 0;">
        <table class="new-tab" cellpadding="0" cellspacing="0" style="margin: auto; width: 100%; max-width: 760px; min-width: 760px; margin-top: 175px; margin-bottom: 100px;">
            <tbody>
                <tr>
                    <td>
                        <table cellpadding="0" cellspacing="0" style="margin: auto; width: 100%;">
                            <tbody>
                                <tr>
                                    <td style="background-color: #ffffff; border-left: 1px solid #e4e4e4; border-right: 1px solid #e4e4e4; border-radius: 5px;">
                                        <!-- Header -->
                                        <table cellspacing="0" cellpadding="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center; padding: 30px 0 15px; border-bottom: 2px dotted #0d104d;"><img src="{{url('/')}}/logo.png" height="80px" /></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <!-- Body -->
                                        <table cellspacing="0" cellpadding="0" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center; padding: 30px 0 10px;">
                                                        <h4 style="font-size: 18px; font-weight: 300; line-height: 40px; color: #161f2b; margin: 0; font-weight: 600;">
                                                            Your Withdrawal OTP is 
                                                        </h4>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; padding: 30px 0 10px;">
                                                        <h2 style="font-size: 18px; font-weight: 300; line-height: 40px; color: #161f2b; margin: 0; font-weight: 600;">
                                                            {{ @$data['otp'] }}
                                                        </h2>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                        <!-- Footer -->
                        <table cellspacing="0" cellpadding="0" width="100%" style="text-align: center; background: #646464;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="font-size: 13px; color: #fff; padding-top: 20px;">Get the latest {{ Setting::get('site_title') }} App your phone</p>
                                    </td>
                                </tr>
                                <tr style="padding-bottom: 30px;">
                                    <td>
                                        <a href="#"><img src="{{url('/')}}/google-play-btn.png" height="40" /></a>
                                        <a href="#"><img src="{{url('/')}}/iosonappstore.png" height="40" /></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
