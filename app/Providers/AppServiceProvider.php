<?php

namespace App\Providers;

use App\Services\PlaidService;
use App\Services\TokenPaymentService;
use App\Services\Investorservice;
use App\PageVisibility;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Services\RecaptchaService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Add custom reCAPTCHA validation rule
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            try {
                $recaptchaService = app(RecaptchaService::class);
                return $recaptchaService->verify($value);
            } catch (\Exception $e) {
                Log::error('reCAPTCHA validation error: ' . $e->getMessage());
                return false;
            }
        }, 'The reCAPTCHA verification failed. Please try again.');

        View::share('pageVisibility', Schema::hasTable('page_visibilities') ? PageVisibility::getItems()->keyBy('key') : collect([]));
        // View::share('support_email','support@tokenize.ai');
        View::share('logo',asset('assets/icon/logo.png'));
        View::share('project_name','Token easy');
        View::share('isDemo',config('app.is_demo', false));

        View::share('phone_number','');
        View::share('address','');
        View::share('support_email','');

        View::share('linkedin','https://www.linkedin.com/company/tokeneasy-io/');
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PlaidService::class, function ($app) {
            return new PlaidService();
        });

        $this->app->singleton(TokenPaymentService::class, function ($app) {
            return new TokenPaymentService();
        });

        $this->app->singleton(Investorservice::class, function ($app) {
            return new Investorservice();
        });
    }
}
