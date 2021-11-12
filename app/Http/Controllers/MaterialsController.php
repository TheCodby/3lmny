<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\Comment;
use App\Models\Rate;
use Carbon\Carbon;
use Auth;
use Validator;
use DB;

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
        $materials = Material::with('materialTypes')->with('levelName')->orderBy('id', 'DESC')->paginate(15);
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
        //limit pages
        if ( $request->page > ($materials->lastPage()) )
        {
            abort(404);
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
        $rate = Rate::where('m_id', '=', $id)->where('u_id', '=', Auth::id())->value('rate');
        $material = Material::find($id);
        if($material)
        {
            return view('materials.show', ['material' => Material::find($id), 'comments' => $comments, 'rate' => $rate]);
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
    public function filterMaterials(Request $request)
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
        $materials = $materials->orderBy('id', 'DESC')->paginate(15);
        foreach($materials as $material)
        {
            $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
        }
        return view('materials.home', ['materials' => $materials, 'types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
    public function rateMaterial(String $id, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'rate' => 'required|integer|min:0|max:5',
        ]);
        if($validator->fails())
        {
            abort(404);
        }
        $update = Rate::updateOrInsert(['u_id' => Auth::id(), 'm_id' => $id], ['rate' => $request->rate]);
    }
}
