<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google reCAPTCHA Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Google reCAPTCHA v2.
    | You need to get your site key and secret key from:
    | https://www.google.com/recaptcha/admin
    |
    */

    'site_key' => env('RECAPTCHA_SITE_KEY', ''),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Version
    |--------------------------------------------------------------------------
    |
    | The version of reCAPTCHA to use. Currently supports v2.
    |
    */
    'version' => 'v2',

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Theme
    |--------------------------------------------------------------------------
    |
    | The theme for reCAPTCHA widget. Options: light, dark
    |
    */
    'theme' => 'light',

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Size
    |--------------------------------------------------------------------------
    |
    | The size of reCAPTCHA widget. Options: normal, compact, invisible
    |
    */
    'size' => 'normal',

    /*
    |--------------------------------------------------------------------------
    | reCAPTCHA Type
    |--------------------------------------------------------------------------
    |
    | The type of reCAPTCHA. Options: image, audio
    |
    */
    'type' => 'image',
];
