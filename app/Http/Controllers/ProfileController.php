<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\User;
use Validator;
use Auth;
use Carbon\Carbon;

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
        $user = User::with('levelRow')->find(Auth::id());
        return view('profile.show', ['user' => $user]);
    }
    public function showEditProfile()
    {        
        return view('profile.edit', ['levels' => Level::all(), 'user' => User::select('age', 'level', 'major', 'interests')->with('levelRow')->find(Auth::id())]);
    }
    public function editProfile(Request $request)
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
				->route('profile.edit')
				->withErrors($validator)
				->withInput();
		}
        $update = User::where('id', '=', Auth::id())->update(['age' => $request->age, 'level' => $request->level, 'major' => $request->major, 'interests' => $request->interests]);
        if($update)
        {
            return redirect()
				->route('profile.edit')
                ->with('message', 'Successfully edited your profile.');
        }else{
            return redirect()
				->route('profile.edit')
				->withInput();
        }
    }
    public function showProfile(String $id)
    {
        $user = User::findOrFail($id);
        if($$user){
            return view('profile.show', ['user' => $user]);
        }else{
            return redirect()->route('index');
        }
    }
}
