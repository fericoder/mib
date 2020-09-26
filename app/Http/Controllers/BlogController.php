<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('dashboard.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'sourceName' => 'nullable',
            'image' => 'nullable',
        ]);

        if ($request->file('image') == null){
            $blog = Blog::create(['type' => $request->type, 'title' => $request->title, 'description' => $request->description, 'body' => $request->body, 'sourceName' => $request->sourceName]);
        }else{
            $image = $this->uploadFile($request->file('image'));
            $blog = Blog::create(['type' => $request->type, 'image' => $image, 'title' => $request->title, 'description' => $request->description, 'body' => $request->body, 'sourceName' => $request->sourceName]);
        }



        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->route('blog.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('dashboard.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {

        $request->validate([
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'body' => 'required',
            'sourceName' => 'nullable',
            'image' => 'nullable',
        ]);


        if ($request->file('image') == null){
            $blog->update(['type' => $request->type, 'title' => $request->title, 'description' => $request->description, 'body' => $request->body, 'sourceName' => $request->sourceName]);
        }else{
            $icon = $this->uploadFile($request->file('image'));
            $blog->update(['type' => $request->type, 'image' => $image, 'title' => $request->title, 'description' => $request->description, 'body' => $request->body, 'sourceName' => $request->sourceName]);
        }

        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->route('blog.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog, Request $request)
    {
        Blog::find($request->id)->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }
}
