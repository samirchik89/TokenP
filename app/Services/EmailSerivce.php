<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Send an email using a Blade template.
     *
     * @param string $to
     * @param string $subject
     * @param string $template
     * @param array $data
     * @return void
     */
    public function sendEmail(string $to, string $subject, string $template, array $data = [])
    {
        Mail::send($template, $data, function ($mail) use ($to, $subject) {
            $mail->to($to)
                 ->subject($subject);
        });
    }

    /**
     * Send profile approval email to a user.
     *
     * @param string $userEmail
     * @return void
     */
    public function sendProfileApprovalMail(string $userEmail)
    {
        $subject = 'Your Profile Has Been Approved!';
        $template = 'EmailTemplates.profile_approval'; // blade: resources/views/EmailTemplates/profile_approval.blade.php

        $data = [
            'email' => $userEmail,
            'content' => 'Congratulations, your profile has been successfully approved!' // Avoid "message" keyword
        ];

        $this->sendEmail($userEmail, $subject, $template, $data);
    }
}
