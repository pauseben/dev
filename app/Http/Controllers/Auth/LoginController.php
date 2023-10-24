<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\RolesController;

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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Admin oldalra átirányítás
     *
     */
    protected function redirectTo()
    {
        activity()->event('login')->log('Bejelentkezés');
        if(auth()->user()->getRoleNames()[0] == RolesController::SUPER_ADMIN || auth()->user()->getRoleNames()[0] == RolesController::ADMIN ){
            return '/home';
        }else{
            return '/users/profile';
        }
        
    }
}
