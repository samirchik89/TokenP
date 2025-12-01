<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\RecaptchaService;

class RecaptchaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];

        // Add reCAPTCHA validation if enabled
        $recaptchaService = app(RecaptchaService::class);
        if ($recaptchaService->isEnabled()) {
            $rules['g-recaptcha-response'] = 'required|recaptcha';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
            'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed. Please try again.',
        ];
    }
}
