<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class MailgunTestController extends Controller
{
    /**
     * Show a simple test page
     */
    public function index()
    {
        return view('mailgun.test');
    }

    /**
     * Send a test email
     */
    public function sendTestEmail(Request $request)
    {
        try {
            $request->validate([
                'to_email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required|string'
            ]);

            $toEmail = $request->to_email;
            $subject = $request->subject;
            $message = $request->message;

            // Check if mail is enabled
            if (!config('mail.MAIL_STATUS', false)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mail sending is disabled. Set MAIL_STATUS=true in your .env file.'
                ]);
            }

            Mail::to($toEmail)->send(new WelcomeMail([
                'name' => 'Test',
                'email' => $toEmail,
                'email_token' => base64_encode($toEmail)
            ]));
            // Send simple text email
            // Mail::raw($message, function ($mail) use ($toEmail, $subject) {
            //     $mail->to($toEmail)
            //          ->subject($subject);
            // });

            Log::info("Test email sent successfully to: {$toEmail}");

            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully to ' . $toEmail
            ]);

        } catch (Exception $e) {
            Log::error('Test email sending failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send test email: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Quick test method - send email to a hardcoded address
     */
    public function quickTest()
    {
        try {
            $toEmail = 'test@example.com'; // Change this to your test email
            $subject = 'Mailgun Test Email';
            $message = 'This is a test email from your Laravel application using Mailgun. If you receive this, Mailgun is working correctly!';

            // Check if mail is enabled
            if (!config('mail.MAIL_STATUS', false)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mail sending is disabled. Set MAIL_STATUS=true in your .env file.'
                ]);
            }

            // Send simple text email
            Mail::raw($message, function ($mail) use ($toEmail, $subject) {
                $mail->to($toEmail)
                     ->subject($subject);
            });

            Log::info("Quick test email sent successfully to: {$toEmail}");

            return response()->json([
                'success' => true,
                'message' => 'Quick test email sent successfully to ' . $toEmail
            ]);

        } catch (Exception $e) {
            Log::error('Quick test email sending failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to send quick test email: ' . $e->getMessage()
            ]);
        }
    }
}