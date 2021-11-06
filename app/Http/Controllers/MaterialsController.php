<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\Comment;
use Carbon\Carbon;
use Auth;
use Validator;

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
		return view('materials.home', ['materials' => $materials, 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
    public function showMaterial(String $id)
    {
        $comments = Comment::with('user')->get()->where('m_id', '=', $id);
        foreach($comments as $commant)
        {
            $commant['created'] = Carbon::parse($commant->created_at)->diffForHumans();
        }
        $material = Material::find($id);
        if($material)
        {
            return view('materials.show', ['material' => Material::find($id), 'comments' => $comments]);
        }
        else
        {
            return redirect()
                ->route('materials', $id);
        }
    }
    public function addComment(String $id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'required|max:500',
        ]);
        if($validator->fails())
		{
			return redirect()
                ->route('materials.show', $id)
				->withErrors($validator)
				->withInput();
		}
        $request['m_id'] = $id;
        $request['u_id'] = Auth::id();
        $comment = Comment::create(request(['comment', 'm_id', 'u_id']));
        if($comment)
        {
            return redirect()
            ->route('materials.show', $id)
            ->with('message', 'Successfully added comment');
        }
    }
    public function deleteComment(String $id, String $commentID)
    {
        $comment = Comment::findOrFail($commentID);
        if(Auth::id() != $comment->u_id)
        {
            return redirect()
                ->route('materials.show', $id);
        }
		if($comment)
		{
			$comment->delete();
			return redirect()
                ->route('materials.show', $id)
                ->with('message', 'Successfully deleted a comment ');
		}else{
			return redirect()
                ->route('materials.show', $id);
		}
    }
}
