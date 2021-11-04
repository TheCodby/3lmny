<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use Carbon\Carbon;

class MaterialsController extends Controller
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
        $materials = Material::with('materialTypes')->with('levelName')->get();
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
		return view('browse.home', ['materials' => $materials, 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
    public function showMaterial()
    {
        
    }
}
