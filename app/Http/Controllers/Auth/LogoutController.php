<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	// Where to redirect user after logout
	//
    public function __invoke(Request $request)
    {
        Session::flush();
        Auth::logout();
  
        return Redirect(RouteServiceProvider::HOME);
    }
}
