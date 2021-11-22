<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'subject' => 'required|string|max:50',
            'message' => 'required|string',
        ]);
        if($validator->fails())
        {
            return response()
            ->json($validator->errors());
        }
        return response()
        ->json(['message' => 'Your message sent successfully to admin team.']);
    }
}
