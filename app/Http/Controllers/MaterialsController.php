<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialsTypes;
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
        $materials = Material::with('materialTypes')->get();
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
		return view('browse.home', ['materials' => $materials, 'types' => MaterialsTypes::all()]);
    }
    public function showMaterial()
    {
        
    }
}
