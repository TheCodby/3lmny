<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class DonationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $available_amounts = ['5','10','20','50', '100'];
        return view('donation.index', ['available_amounts' => $available_amounts]);
    }
    public function success(Request $request)
    {
        dd($request->all());
    }
    public function cancelled(Request $request)
    {
        dd($request);
    }
    public function notify(Request $request)
    {
        dd($request);
    }
}