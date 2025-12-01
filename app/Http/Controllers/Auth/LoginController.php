<?php

namespace App\Http\Controllers\Auth;

use Mail;
use Cache;
use App\User;
use App\Property;
use App\Mail\WelcomeMail;
use App\Services\DemoUserAutoFillService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CommonController;
use App\Http\Requests\ValidateSecretRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Services\RecaptchaService;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    protected $demoUserService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DemoUserAutoFillService $demoUserService)
    {
        $this->middleware('guest')->except('logout');
        $this->demoUserService = $demoUserService;
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        User::where('email', 'issuer@demo.com')->update(['password' => Hash::make('issuer@demo.com')]);
        User::where('email', 'investor@demo.com')->update(['password' => Hash::make('investor@demo.com')]);
        if (Auth::guard('admin')->check()) {
            return redirect('admin/home');
        }

        if (Auth::check()) {
            if (Auth::user()->user_type == 1)
                return redirect('/dashboard');
            else
                return view('issuer.dashboard');
        }

        if(config('app.is_demo')){
            $demoCredentials = $this->demoUserService->getDemoUserCredentials(request(),User::USER_TYPE_ISSUER);
        }else{
            $demoCredentials = [];
        }
        return view('auth.login', compact('demoCredentials'));
    }

    public function showLoginFormInvestor()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('admin/home');
        }

        if (Auth::check()) {
            if (Auth::user()->user_type == 1)
                return redirect('/dashboard');
            else
                Auth::logout();
        }

        if(config('app.is_demo')){
            $demoCredentials = $this->demoUserService->getDemoUserCredentials(request(),User::USER_TYPE_INVESTOR);
        }else{
            $demoCredentials = [];
        }
        return view('auth.investor-login', compact('demoCredentials'));
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        try {
            if ($user->google2fa_secret) {
                Auth::logout();

                $request->session()->put('2fa:user:id', $user->id);

                return redirect('2fa/validate');
            }

            if ($user->verified == 0) {
                $email_token = ['email_token'=>$user->email_token];
                if (env('MAIL_STATUS')==true) {
                    // Mail::to($user->email)->send(new WelcomeMail($email_token));
                }
                Auth::logout();
                \Session::flash('flash_error', 'Please verify your account by clicking link from your welcome mail...');
                return redirect('/login');
            }

            $user = User::where('email', $user->email)->first();
            $user->last_login_at = Carbon::now();
            $user->save();

            // Check if there's an intended URL stored in session (for investor login redirects)
            if (session()->has('intended_url')) {
                $intendedUrl = session('intended_url');
                session()->forget('intended_url');
                return redirect($intendedUrl);
            }

            // Default redirects
            if (Auth::user()->user_type == 1)
                $this->redirectTo = '/dashboard';
            else
                $this->redirectTo = '/issuer/dashboard';

            return redirect()->intended($this->redirectTo);
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function getValidateToken()
    {

        if (session('2fa:user:id')) {
            return view('2fa/validate');
        }

        return redirect('login');
    }

    /**
     *
     * @param  App\Http\Requests\ValidateSecretRequest $request
     * @return \Illuminate\Http\Response
     */

    public function validateG2fa(Request $request)
    {


        $user = $request->user();

        // // //encrypt and then save secret
        $user->google2fa_secret = $request->secret;
        $user->save();


        $this->postValidateToken($request);
    }

    public function postValidateToken(ValidateSecretRequest $request)
    {
        //get user id and create cache key
        $userId = $request->session()->pull('2fa:user:id');
        $key    = $userId . ':' . $request->totp;
        $user = User::where('id', $userId)->select('user_type')->first();
        //use cache to store token to blacklist
        \Cache::add($key, true, 4);
        Auth::loginUsingId($userId);
        //login and redirect user

        if ($request->ajax()) {
            return response()->json(['message' => "Success"], 200);
        } else {
            // Check if there's an intended URL stored in session (for investor login redirects)
            if (session()->has('intended_url')) {
                $intendedUrl = session('intended_url');
                session()->forget('intended_url');
                return redirect($intendedUrl);
            }

            // Default redirects
            if ($user->user_type == 1) {
                $this->redirectTo = '/dashboard';
            } else {
                $this->redirectTo = '/issuer/token-demo';
            }
            return redirect()->intended($this->redirectTo);
        }
    }

    /*
    * Used to Show Landing Page
    */
    public function welcome()
    {
        try {
            $property = (new Property)->getProperty(1);
            //print_r($property);
            $property = (new CommonController)->calculatePercentage($property);
            //echo count($property);
            return view('welcome', compact('property'));
        } catch (\Throwable $th) {
            //   dd($th->getMessage());
            return back()->with('flash_error', 'Unable to get dashboard details. Please try again later');
        }
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate reCAPTCHA if enabled
        $recaptchaService = app(RecaptchaService::class);
        if ($recaptchaService->isEnabled()) {
            $request->validate([
                'g-recaptcha-response' => 'required|recaptcha',
            ], [
                'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
                'g-recaptcha-response.recaptcha' => 'reCAPTCHA verification failed. Please try again.',
            ]);
        }

        // Call the parent login method from the trait and handle the response properly
        $response = $this->attemptLogin($request);

        if ($response === true) {
            // If login was successful, redirect to intended location
            return redirect()->intended($this->redirectPath());
        }

        // If login failed, redirect back with errors
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors(['email' => trans('auth.failed')]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
