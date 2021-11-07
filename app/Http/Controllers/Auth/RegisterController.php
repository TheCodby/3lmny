<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
	
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	protected function show()
	{
		return view('auth.register');
	}
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'username' => 'required|string|unique:users|max:255',
			'email' => 'required|string|email|unique:users|max:255',
			'password' => 'required|string|min:8|confirmed',
		]);
		if($validator->fails())
		{
			return back()
				->withErrors($validator)
				->withInput();
		}
		$user = User::create(request(['username', 'email', 'password']));
		if($user)
		{
			if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('profile.complete');
            }
		}
    }
}
