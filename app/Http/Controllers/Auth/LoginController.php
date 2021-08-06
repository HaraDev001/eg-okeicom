<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // dd('OK');
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン後のリダイレクト先。スマホかどうかで分岐
     *
     * @var string
     */
    public function redirectTo()
    {
        $agent = new Agent();
        // if($agent->isMobile()) {
        //     return route('mypage.u.index');
        // } else {
        //     return $this->redirectTo;
        // }
        return $this->redirectTo;
    }
}
