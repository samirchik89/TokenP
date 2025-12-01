<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RecaptchaService
{
    /**
     * Verify reCAPTCHA response
     *
     * @param string $recaptchaResponse
     * @param string $remoteIp
     * @return bool
     */
    public function verify($recaptchaResponse, $remoteIp = null)
    {
        if (empty($recaptchaResponse)) {
            return false;
        }

        $secretKey = config('recaptcha.secret_key');

        if (empty($secretKey)) {
            Log::warning('reCAPTCHA secret key not configured');
            return false;
        }

        try {
            $client = new Client();

            // Safely get the remote IP address
            $remoteIpAddress = $remoteIp;
            if (empty($remoteIpAddress) && app()->bound('request')) {
                try {
                    $remoteIpAddress = app('request')->ip();
                } catch (\Exception $e) {
                    $remoteIpAddress = null;
                }
            }

            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => $secretKey,
                    'response' => $recaptchaResponse,
                    'remoteip' => $remoteIpAddress,
                ]
            ]);
            // dd($response->getBody()->getContents());

            if ($response->getStatusCode() === 200) {
                $result = json_decode($response->getBody()->getContents(), true);
                return $result['success'] ?? false;
            }

            Log::error('reCAPTCHA verification failed', [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()->getContents()
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('reCAPTCHA verification error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return false;
        }
    }

    /**
     * Get reCAPTCHA site key
     *
     * @return string
     */
    public function getSiteKey()
    {
        try {
            return config('recaptcha.site_key') ?: '';
        } catch (\Exception $e) {
            Log::error('reCAPTCHA getSiteKey error: ' . $e->getMessage());
            return '';
        }
    }

    /**
     * Check if reCAPTCHA is enabled
     *
     * @return bool
     */
    public function isEnabled()
    {
        try {
            $siteKey = config('recaptcha.site_key');
            $secretKey = config('recaptcha.secret_key');

            return !empty($siteKey) && !empty($secretKey);
        } catch (\Exception $e) {
            Log::error('reCAPTCHA isEnabled error: ' . $e->getMessage());
            return false;
        }
    }
}
