<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\User;
use Validator;
use Auth;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function showCompleteProfile()
    {        
        return view('profile.complete', ['levels' => Level::all(), 'user' => User::select('age', 'level', 'major', 'interests')->with('levelRow')->find(Auth::id())]);
    }
    public function completeProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'age' => 'nullable|integer|between:6,60',
            'level' => 'nullable|integer|exists:App\Models\Level,id',
            'major' => 'nullable|string',
            'interests' => 'nullable|string',
        ]);
        if($validator->fails())
		{
			return redirect()
				->route('profile.complete')
				->withErrors($validator)
				->withInput();
		}
        $update = User::where('id', '=', Auth::id())->update(['age' => $request->age, 'level' => $request->level, 'major' => $request->major, 'interests' => $request->interests]);
        if($update)
        {
            return redirect()
				->route('profile.complete')
                ->with('message', 'Successfully complete your account.');
        }else{
            return redirect()
				->route('profile.complete')
				->withInput();
        }
    }
}
