<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	protected function show()
	{
		return view('auth.login');
	}
	protected function check(Request $request)
	{
		$validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
		if($validator->fails())
		{
			return back()
				->withErrors($validator)
				->withInput();
		}
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
            return redirect(RouteServiceProvider::HOME);
        }
		return back()
			->withErrors([
				'email' => trans('auth.failed'),
			])
			->withInput();
		
	}
}
