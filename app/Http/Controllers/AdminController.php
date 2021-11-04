<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Discord\DiscordWebhook;

class AdminController extends Controller
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
		return view('admin.home', ['materials' => Material::all(), 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
	public function AddMaterial(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string',
			'description' => 'required|string',
			'url' => 'required|string',
			'type' => 'required|integer',
			'level' => 'required|integer',
			'keywords' => 'nullable|string',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin')
				->withErrors($validator)
				->withInput();
		}
		$keywords = explode(',', $request->keywords);
		$keywords = json_encode($keywords);
		$data = request(['subject', 'description', 'url', 'type', 'level']);
		$data['keywords'] = $keywords;
		$material = Material::create($data);
		$materials = Material::with('materialTypes')->with('levelName')->get()->where('id', '=', $material->id);
		if($material)
		{
			$discordMsg = new DiscordWebhook();
			$discordMsg->SendNotification("We Added ".$material->subject, $material->description, url("/Materials/{$material->id}"), $material->materialTypes->name, $material->levelName->name);
			return redirect()
				->route('admin')
				->with('message', 'Successfully created a material '. $request->subject);
		}
	}
	public function DeleteMaterial(Request $request)
	{
		$material = Material::findOrFail($request->id);
		if($material)
		{
			$material->delete();
			return redirect()
				->route('admin')
				->with('message', 'Successfully deleted a material '.$material->subject);
		}else{
			return redirect()
				->route('admin');
		}
	}
	public function AddType(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:20',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin')
				->withErrors($validator)
				->withInput();
		}
		$type = MaterialsTypes::create(request(['name']));
		if($type)
		{
			return redirect()
				->route('admin')
				->with('message', 'Successfully created a type '.$request->name);
		}else{
			return redirect()
				->route('admin');
		}
	}
	public function DeleteType(Request $request)
	{
		$type = MaterialsTypes::findOrFail($request->id);
		if($type)
		{
			$type->delete();
			return redirect()
				->route('admin')
				->with('message', 'Successfully deleted a type '.$type->name);
		}else{
			return redirect()
				->route('admin');
		}
	}
	public function AddLevel(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:20',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin')
				->withErrors($validator)
				->withInput();
		}
		$type = Level::create(request(['name']));
		if($type)
		{
			return redirect()
				->route('admin')
				->with('message', 'Successfully created a level '.$request->name);
		}else{
			return redirect()
				->route('admin');
		}
	}
	public function DeleteLevel(Request $request)
	{
		$type = Level::findOrFail($request->id);
		if($type)
		{
			$type->delete();
			return redirect()
				->route('admin')
				->with('message', 'Successfully deleted a level '.$type->name);
		}else{
			return redirect()
				->route('admin');
		}
	}
}
