<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $comments = Comment::all();
        return view('dashboard.comment.index', compact('comments' ));
    }


    public function notApproved()
    {
        $comments = Comment::orderBy('created_at', 'desc')->where('approved', '0')->with('user', 'commentable')->get();
        return view('dashboard.comment.index', compact('comments'));
    }
    public function approve($id, $commentable_id)
    {
        Comment::where('id', $id)->update(['approved' => 1]);
        alert()->success('نظر باموفقیت تایید شد.', 'انجام شد');
        return redirect()->back();
    }


    public function comment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'
        ]);
        Comment::create(array_merge([
            'user_id' => auth()->user()->id,
        ], $request->all() ));
        alert()->success('نظر شما پس از تایید برروی سایت قرار میگیرد.', 'انجام شد');
        return redirect()->back();
    }



    public function answer(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required|min:3|max:1000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'
        ]);
        Comment::create(array_merge([
            'user_id' => auth()->user()->id,
        ], $request->all() ));
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }

    public function restore(Request $request){

        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
        ]);
        $comment = Comment::withTrashed()->find($request->id);
        if (\Auth::user()->is_superAdmin != 1) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }
        $comment->restore();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
