<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Carbon\Carbon;

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
        $newMsg = DB::table('contacts')
        ->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip' => $request->ip(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        return response()
        ->json(['message' => 'Your message sent successfully to admin team.']);
    }
    public function read(int $id, Request $request)
    {
        $read = DB::table('contacts')
        ->where('id', '=', $id)
        ->update(['admin_read' => 1]);
        return response('', 200);
    }
}
