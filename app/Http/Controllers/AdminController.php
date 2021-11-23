<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\File;
use App\Models\User;
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
		return view('admin.home', ['materials' => $this->getMaterialsPerPage($request), 'types' => MaterialsTypes::all(), 'levels' => Level::all(), 'users' => User::all(), 'contacts' => $this->getMessagesPerPage($request), 'notifications' => ['contacts' => DB::table('contacts')->where('admin_read', '=', '0')->count()]]);
    }
	public function getMaterialsPerPage(Request $request)
    {
        $materials = Material::paginate(15, ['*'], 'Page');
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
        //limit pages
        if ( $request->page > ($materials->lastPage()) )
        {
            abort(404);
        }
		return view('admin.materials.materialTable', ['materials' => $materials]);
    }
	public function filterMaterials(Request $request)
    {
        if($request->ajax())
        {
            $subject = $request->input('subject');
            $type = $request->input('type');
            $level = $request->input('level');
            $keywords = $request->input('keywords');
            $materials = Material::where('subject', 'LIKE', '%'.$subject.'%')
                ->where('keywords', 'LIKE', '%'.$keywords.'%');
            if($level != 'all'){
                $materials->where('level', '=', $level);
            };
            if($type != 'all'){
                $materials->where('type', '=', $type);
            };
            $materials = $materials->orderBy('id', 'DESC')->paginate(15, ['*'], 'Page')->withQueryString();
            foreach($materials as $material)
            {
                $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
            }
            if ( $request->page > ($materials->lastPage()) )
            {
                abort(404);
            }
            return view('admin.materials.materialTable', ['materials' => $materials , 'search' => true]);
        }
    }
	public function getMessagesPerPage(Request $request)
    {
        $contacts = DB::table('contacts')
		->orderByRaw('admin_read = 1 ASC')
		->paginate(15, ['*'], 'Page');
        //limit pages
        if ( $request->page > ($contacts->lastPage()) )
        {
            abort(404);
        }
		return view('admin.contacts.contactsList', ['contacts' => $contacts]);
    }
	public function AddMaterial(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string',
			'description' => 'required|string',
			'url' => 'required|url',
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
		$name = $request->file('image')->getClientOriginalName();
		$file_name = $request->file('image')->hashName();
		$path = $request->file('image')->store('public/uploads/materials');
		$file = File::create(['name' => $name, 'path' => $file_name]);
		###
		$data = request(['subject', 'description', 'url', 'type', 'level', 'keywords']);
		$data['image_id'] = $file->id;
		$material = Material::create($data);
		$materials = Material::with('typeRow')->with('levelRow')->get()->where('id', '=', $material->id);
		if($material)
		{
			$discordMsg = new DiscordWebhook();
			$discordMsg->SendNotification("We Added ".$material->subject, $material->description, url("/Materials/{$material->id}"), $material->typeRow->name, $material->levelRow->name, asset('storage/uploads/materials/'.$file_name));
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
		return view('admin.materials.edit', ['material' => Material::with('typeRow')->with('image')->with('levelRow')->find($id), 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
	}
	public function EditMaterial(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'subject' => 'required|string',
			'description' => 'required|string',
			'url' => 'required|url',
			'type' => 'required|numeric',
			'level' => 'required|numeric',
			'keywords' => 'nullable|string',
			'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
		]);
		if($validator->fails())
		{
			return redirect()
				->route('admin.materials.edit', $id)
				->withErrors($validator)
				->withInput();
		}
		$data = request(['subject', 'description', 'url', 'type', 'level', 'keywords']);
		if($request->file('image'))
		{
			#upload image in public file
			$name = $request->file('image')->getClientOriginalName();
			$file_name = $request->file('image')->hashName();
			$path = $request->file('image')->store('public/uploads/materials');
			$file = File::create(['name' => $name, 'path' => $file_name]);
			$data['image_id'] = $file->id;
		}
		$keywords = explode(',', $request->keywords);
		$keywords = json_encode($keywords);
		$update = Material::where('id', '=', $id)->update($data);
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
	public function getUsersPerPage(Request $request)
	{
		$users = User::paginate(15, ['*'], 'Page');
        //limit pages
        if ( $request->page > ($users->lastPage()) )
        {
            abort(404);
        }
		return view('admin.users.usersList', ['users' => $users]);
	}
	public function filterUser(Request $request)
	{
		if($request->ajax())
        {
            $value = $request->input('value');
            $method = $request->input('method');
			if($method != 'username' && $method != 'email')
			{
				abort(400);
			}
            $users = User::where($method, 'LIKE', '%'.$value.'%');
            $users = $users->orderBy('id', 'DESC')->paginate(15, ['*'], 'Page')->withQueryString();
            if ( $request->page > ($users->lastPage()) )
            {
                abort(404);
            }
            return view('admin.users.usersList', ['users' => $users , 'search' => true]);
        }
	}
}
