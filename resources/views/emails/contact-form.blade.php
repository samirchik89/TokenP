<!DOCTYPE html>
<html>
    <head>
        <title>Contact Form Submission - TokenEasy</title>
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
                                        <!-- Body -->
                                        <table cellspacing="0" cellpadding="0" width="100%">
                                            <tbody>
                                              <tr>
                                                  <td style="text-align: center; padding: 20px 0 10px;">
                                                      <h2 style="font-size: 18px; font-weight: 300; color: #161f2b; margin: 0; font-weight: 600;">New Contact Form Submission</h2>
                                                  </td>
                                              </tr>
                                                <tr>
                                                    <td style="text-align: center; padding: 10px 0 10px;">
                                                        <h2 style="font-size: 15px; font-weight: 500; line-height: 40px; color: #161f2b; margin: 0;">
                                                            A new contact form has been submitted on the TokenEasy website.
                                                        </h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 20px 40px;">
                                                        <table cellspacing="0" cellpadding="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding: 10px 0; border-bottom: 1px solid #e4e4e4;">
                                                                        <strong style="color: #161f2b; font-size: 14px;">Name:</strong>
                                                                        <span style="color: #161f2b; font-size: 14px; margin-left: 10px;">{{ $name ?? 'Not provided' }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 10px 0; border-bottom: 1px solid #e4e4e4;">
                                                                        <strong style="color: #161f2b; font-size: 14px;">Email:</strong>
                                                                        <span style="color: #161f2b; font-size: 14px; margin-left: 10px;">{{ $email ?? 'Not provided' }}</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 10px 0;">
                                                                        <strong style="color: #161f2b; font-size: 14px;">Message:</strong>
                                                                        <div style="color: #161f2b; font-size: 14px; margin-top: 10px; line-height: 1.6; background-color: #f8f9fa; padding: 15px; border-radius: 5px;">
                                                                            {{ $text ?? 'No message provided' }}
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center; padding: 20px 0 20px;">
                                                        <p style="font-size: 14px; color: #161f2b; margin: 0;">
                                                            This message was sent from the contact form on the TokenEasy website.
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Footer -->
                        <table cellspacing="0" cellpadding="0" width="100%" style="text-align: center; background: #646464;">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="font-size: 13px; color: #fff; padding-top: 20px;">TokenEasy - End-to-end tokenization platform</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="font-size: 12px; color: #fff; padding-bottom: 20px;">© {{ date('Y') }} TokenEasy. All rights reserved.</p>
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