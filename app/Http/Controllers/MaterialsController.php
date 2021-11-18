<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\Comment;
use App\Models\Rate;
use App\Models\Bookmark;
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
		return view('materials.home', ['types' => MaterialsTypes::all(), 'levels' => Level::all()]);
    }
    public function getMaterialsByPage(Request $request)
    {
        if($request->ajax())
        {
            $materials = Material::with('typeRow')->with('levelRow')->with('image')->orderBy('id', 'DESC')->paginate(15);
            foreach($materials as $material)
            {
                $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
            }
            //limit pages
            if ( $request->page > ($materials->lastPage()) )
            {
                abort(404);
            }
            return view('materials.materialsList', ['materials' => $materials]);
        }
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
            $materials = $materials->orderBy('id', 'DESC')->paginate(15, ['*'], 'page')->withQueryString();
            foreach($materials as $material)
            {
                $material['updated'] = Carbon::parse($material->updated_at)->diffForHumans();
            }
            if ( $request->page > ($materials->lastPage()) )
            {
                abort(404);
            }
            return view('materials.materialsList', ['materials' => $materials , 'search' => true]);
        }
    }
    public function showMaterial(String $id)
    {
        $comments = Comment::with('user')->get()->where('m_id', '=', $id);
        foreach($comments as $commant)
        {
            $commant['created'] = Carbon::parse($commant->created_at)->diffForHumans();
        }
        $rate = Rate::where('m_id', '=', $id)->where('u_id', '=', Auth::id())->value('rate') ?? 0;
        $isBookmarked = Bookmark::where('m_id', '=', $id)->where('u_id', '=', Auth::id())->exists();
        $material = Material::with('image')->find($id);
        if($material)
        {
            return view('materials.show', ['material' => Material::find($id), 'comments' => $comments, 'rate' => $rate, 'isBookmarked' => $isBookmarked]);
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
    public function bookmarkMaterial(String $id, Request $request)
    {
        # if bookmark exist delete it and if not exist create it.
        $bookmark = Bookmark::where(['u_id' => Auth::id(), 'm_id' => $id]);
        if($bookmark->count() == 0)
        {
            $newbookmark = new Bookmark();
            $newbookmark->u_id = Auth::id();
            $newbookmark->m_id = $id;
            $newbookmark->save();
            return ('Sucssfully added bookmark '.$id);
        }else{
            $bookmark->delete();
            return 'Sucssfully deleted bookmark '.$id;
        }
    }
    public function bookmarks()
    {
        $bookmarks = DB::table('materials')
        ->join('bookmarks', 'materials.id', '=', 'bookmarks.m_id')
        ->join('files', 'materials.image_id', '=', 'files.id')
        ->where('u_id', '=', Auth::id())
        ->orderBy('materials.id', 'DESC')
        ->select(['materials.id', 'materials.subject', 'materials.image_id', 'materials.description', 'materials.updated_at', 'files.path'])
        ->paginate(15);
        foreach($bookmarks as $material)
        {
            $material->updated = Carbon::parse($material->updated_at)->diffForHumans();
        }
        return view('materials.bookmarks', ['bookmarks' => $bookmarks]);
    }
}
