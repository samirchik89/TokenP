<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\RecaptchaService;
use Illuminate\Support\Facades\Log;

class VerifyRecaptcha
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
            public function handle($request, Closure $next)
    {
        try {
            $recaptchaService = app(RecaptchaService::class);

            // Only validate if reCAPTCHA is enabled
            if ($recaptchaService->isEnabled()) {
                $recaptchaResponse = $request->input('g-recaptcha-response');

                if (!$recaptchaService->verify($recaptchaResponse)) {
                    return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed. Please try again.']);
                }
            }

            return $next($request);
        } catch (\Exception $e) {
            Log::error('reCAPTCHA middleware error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'An error occurred during reCAPTCHA verification. Please try again.']);
        }
    }
}
