<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShopSettingRequest;
use App\Http\Requests\ShopContactRequest;
use App\Http\Requests\ShopThemeRequest;
use App\Http\Controllers\Controller;
use App\Shop;


class ShopSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shop = \Auth::user()->shop()->first();
        return view('dashboard.settings', compact('shop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShopSetting  $shopSetting
     * @return \Illuminate\Http\Response
     */
    public function show(ShopSetting $shopSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShopSetting  $shopSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopSetting $shopSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShopSetting  $shopSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop = \Auth::user()->shop()->first();

            $shop->update([
            'shegeft' => $request->shegeft,
            'porbazdid' => $request->porbazdid,
            'jadidtarin' => $request->jadidtarin,
            'porforoosh' => $request->porforoosh,
            'brands' => $request->brands,
            'pardakhtDarMahal' => $request->pardakhtDarMahal,
            'pardakhtBaDargah' => $request->pardakhtBaDargah,
            'checkOutDescription' => $request->checkOutDescription,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'about_header' => $request->about_header,
            'about_main' => $request->about_main,
            'telegram' => $request->telegram,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'whatsapp' => $request->whatsapp,
        ]);

        alert()->success('اطلاعات فروشگاه بروز شد.', 'بروز شد');
        return redirect()->back();
    }




    public function updateContact(ShopContactRequest $request){

        $shop = \Auth::user()->shop()->first()->shopContact()->get()->first()->update([
            'tel' => $this->fa_num_to_en($request->tel),
            'shop_email' => $request->shop_email,
            'address' => $request->address,
            'city' => $request->city,
            'province_id' => $request->province_id,
            'telegram_url' => $request->telegram_url,
            'instagram_url' => $request->instagram_url,
            'facebook_url' => $request->facebook_url,
            'soroush_url' => $request->soroush_url,
            'bisphone_url' => $request->bisphone_url,
            'Igap_url' => $request->Igap_url,
            'gap_url' => $request->gap_url,
            'wispi_url' => $request->wispi_url,
            'bale_url' => $request->bale_url,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);

        alert()->success('تغییرات شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('shop-setting.index');
    }


    public function updateSetting(ShopThemeRequest $request){
        if($request->file('watermark') == null){
            $watermark = \Auth::user()->shop()->first()->watermark;
        }
        else{
            $watermark = $this->uploadFile($request->file('watermark'), false, false);
        }

        if(isset($request->slide_category))
            $slide_category = $request->slide_category;
        else
            $slide_category = null;

        $shop = \Auth::user()->shop()->first()->update([
            'menu_show' => $request->menu_show,
            'menu_show_count' => $request->menu_show_count,
            'slide_category' => $slide_category,
            'cat_image_status' => $request->cat_image_status,
            'watermark_status' => $request->watermark_status,
            'buyCount_show' => $request->buyCount_show,
            'watermark' => $watermark,
            'special_offer' => $request->special_offer,
            'special_offer_text' => $request->special_offer_text,
            'color_1' => $request->color_1,
            'color_2' => $request->color_2,
            'color_3' => $request->color_3,
            'color_4' => $request->color_4,
            'VAT' => $request->VAT,
        ]);
        alert()->success('تغییرات شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('shop-setting.index');
    }




    public function updateTemplate(ShopThemeRequest $request){
        $request->validate([
            'template_id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
        ]);
        $shop = \Auth::user()->shop()->first()->update([
            'template_id' => $request->template_id,
        ]);
        alert()->success('تغییرات شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('shop-setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShopSetting  $shopSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopSetting $shopSetting)
    {
        //
    }

    public function destroyImage(Request $request){
        $request->validate([
            'type' => 'required|in:icon,logo',
        ]);
        $shop = \Auth::user()->shop()->first();
        if($request->type == 'icon'){
            $shop->update([
                'icon' => null
            ]);
        }
        else{
            $shop->update([
                'logo' => null
            ]);
        }
    }
}
