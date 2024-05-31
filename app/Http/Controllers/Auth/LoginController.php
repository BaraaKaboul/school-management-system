<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Traits\AuthTrait;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthTrait;
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

//    use AuthenticatesUsers;
//
//    /**
//     * Where to redirect users after login.
//     *
//     * @var string
//     */
////    لازم نغير الرابط هون مشان يتوجه بشكل صحيح عالداشبورد بعد عملية تسجيل الدخول بس لازم نغيرها من RouteServiceProvider مو من هون
//    protected $redirectTo = '/dashboard';
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    public function login(Request $request)
    {
        if (Auth::guard($this->checkGuard($request))->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->redirect($request);
        }
        else{
            return redirect()->back()->with('message','يوجد مشكلة في معلومات تسجيل الدخول');
        }
    }

    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('selection');
    }
}
