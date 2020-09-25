<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::orderBy('created_at', 'desc')->get();
        return view('dashboard.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.banners.create');
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
            'image' => 'required',
        ]);

        $image = $this->uploadFile($request->file('image'));
        $banner = Banner::create(['type' => $request->type, 'image' => $image, 'title' => $request->title, 'description' => $request->description, 'body' => $request->body, 'sourceName' => $request->sourceName]);

        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->route('banner.index');

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
        $banner = Banner::find($id);
        return view('dashboard.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {

        if ($request->file('image') == null){
            $banner->update(['title' => $request->title, 'url' => $request->url]);
        }else{
            $icon = $this->uploadFile($request->file('image'));
            $banner->update(['title' => $request->title, 'url' => $request->url, 'slide_path', $request->image ]);
        }

        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->route('banner.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner, Request $request)
    {
        Banner::find($request->id)->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }
}
