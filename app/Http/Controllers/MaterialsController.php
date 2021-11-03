<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

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
		return view('browse.home', ['materials' => Material::all()]);
    }
    public function showMaterial()
    {
        
    }
}
