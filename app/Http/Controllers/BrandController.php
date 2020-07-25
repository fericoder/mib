<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('dashboard.brand.index' , compact('brands'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        //check if icon is null or not
        if($request->file('icon') == null){
            $icon = null;
        }
        else{
            $icon = $this->uploadFile($request->file('icon'), false, true);
        }
        $brand = new Brand;
        $brand->shop_id = \Auth::user()->shop_id;
        $brand->name = $request->name;
        $brand->icon = $icon;
        $brand->save();
        alert()->success('برند جدید شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('brands.index');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $shop = \Auth::user()->shop()->first();
        return view('dashboard.brand.edit', compact('brand', 'shop'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, Brand $brand)
    {
        //check if icon is null or not
        if($request->file('icon') == null){
            $icon = \Auth::user()->shop()->first()->brands()->where('id', $brand->id)->get()->first()->icon;
        }
        else{
            $icon = $this->uploadFile($request->file('icon'), false, true);
        }
        $productCategory = \Auth::user()->shop()->first()->brands()->where('id', $brand->id)->get()->first()->update([
            'name' => $request->name,
            'icon' => $icon
        ]);


        alert()->success('برند شما با موفقیت بروز شد.', 'ثبت شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $brand = Brand::where('id' , $request->id)->first()->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();

    }
}
