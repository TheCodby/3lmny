<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\File;
use App\Discord\DiscordWebhook;
use Carbon\Carbon;

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
		$materials = Material::paginate(15, ['*'], 'MaterialsPage');
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
        //limit pages
        if ( $request->page > ($materials->lastPage()) )
        {
            abort(404);
        }
		return view('admin.home', ['materials' => $materials, 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
	public function AddMaterial(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string',
			'description' => 'required|string',
			'url' => 'required|string',
			'type' => 'required|numeric',
			'level' => 'required|numeric',
			'keywords' => 'nullable|string',
			'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin')
				->withErrors($validator)
				->withInput();
		}
		#upload image in public file
		$saveFile = new File();
		$name = $request->file('image')->getClientOriginalName();
		$path = $request->file('image')->store('public/materials');
		$file = File::create(['name' => $name, 'path' => $path]);
		###
		$data = request(['subject', 'description', 'url', 'type', 'level', 'keywords']);
		$data['image_id'] = $file->id;
		$material = Material::create($data);
		$materials = Material::with('typeRow')->with('levelRow')->get()->where('id', '=', $material->id);
		if($material)
		{
			$discordMsg = new DiscordWebhook();
			$discordMsg->SendNotification("We Added ".$material->subject, $material->description, url("/Materials/{$material->id}"), $material->typeRow->name, $material->levelRow->name);
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
			if($type->delete())
			{
				$materials = Material::all();

				Material::where('type','=',$request->id)
				->update(['type' => null]);
			}
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
		$level = Level::findOrFail($request->id);
		if($level)
		{
			if($level->delete())
			{
				$materials = Material::all();

				Material::where('level','=',$request->id)
				->update(['level' => null]);
			}
			return redirect()
				->route('admin')
				->with('message', 'Successfully deleted a level '.$level->name);
		}else{
			return redirect()
				->route('admin');
		}
	}
	public function showEditMaterial(String $id)
	{
		return view('admin.materials.edit', ['material' => Material::with('typeRow')->with('levelRow')->find($id), 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
	}
	public function EditMaterial(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string',
			'description' => 'required|string',
			'url' => 'required|string',
			'type' => 'required|numeric',
			'level' => 'required|numeric',
			'keywords' => 'nullable|string',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin.materials.edit', $id)
				->withErrors($validator)
				->withInput();
		}
		$keywords = explode(',', $request->keywords);
		$keywords = json_encode($keywords);
		$update = Material::where('id', '=', $id)->update(['subject' => $request->subject, 'description' => $request->description, 'url' => $request->url, 'type' => $request->type, 'level' => $request->level, 'keywords' => $request->keywords]);
        if($update)
        {
            return redirect()
				->route('admin.materials.edit', $id)
                ->with('message', 'Successfully edited this material.');
        }else{
            return redirect()
				->route('admin.materials.edit', $id)
				->withInput();
        }
	}
}
