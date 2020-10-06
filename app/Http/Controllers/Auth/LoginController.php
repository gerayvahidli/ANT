<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/profile';

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function authenticate(Request $request)
    {
        $credentials = $request->only('Email', 'Password');
        $user = User::where('Email', $request->Email)->firstOrFail();
        if ($user->exists) {
//            dd(\Hash::check($request->Password, $user->Password));
            if (\Hash::check($request->Password, $user->Password)){
                Auth::attempt(['Email' => $user->Email, 'Password' => $request->Password]);
//                \Auth::loginUsingId($user->id);
                return redirect()->intended('/profile');
//                return $this->sendLoginResponse($request);
            }
            else {
                throw ValidationException::withMessages([
                    $this->username() => [trans('auth.failed')],
                ]);
            }
        }

    }*/
}
