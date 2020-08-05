<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressesRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\InformationRequest;
use Illuminate\Http\Request;
use App\Category;

class ProfileController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $user = \Auth::user();
        return view('shop.profile.index', compact('categories', 'user'));
    }

    public function addressesShow()
    {
        $categories = Category::all();
        $addresses = Address::where('user_id', \Auth::user()->id)->get();
        $user = \Auth::user();
        return view('shop.profile.addresses', compact('categories', 'user', 'addresses'));
    }

    public function addressesStore(AddressesRequest $request)
    {
        $address = Address::create([
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'tel' => $request->tel,
            'zip_code' => $request->zip_code,
            'fullName' => $request->fullName,
            'user_id' => \Auth::user()->id,
        ]);

        alert()->success('آدرس جدید باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->back();

    }

    public function addressesDelete(Request $request)
    {
        $address = Address::where('id', $request->id)->first();
        if ($address->user_id == \Auth::user()->id){
            $address->delete();
        }
        alert()->success('آدرس باموفقیت حذف شد.', 'حذف شد');
        return redirect()->back();

    }

    public function informationShow()
    {
        $user = \Auth::user();
        $categories = Category::all();
        return view('shop.profile.information', compact('user', 'categories'));
    }

    public function informationUpdate(InformationRequest $request)
    {
        $meliPic = $this->uploadFile($request->file('meliPic'), false, true);
        $nezamPic = $this->uploadFile($request->file('nezamPic'), false, true);
        $user = \Auth::user();

        if ($request->file('javazPic')){
            $javazPic = $this->uploadFile($request->file('javazPic'), false, true);
            $user->update(['job' => $request->job, 'meliPic' => $meliPic, 'nezamPic' => $nezamPic, 'javazPic' => $javazPic]);
        }else{
            $user->update(['job' => $request->job, 'meliPic' => $meliPic, 'nezamPic' => $nezamPic]);
        }

        alert()->success('اطلاعات کاربری بروز شد');
        return redirect()->back();
    }


    public function passwordShow()
    {
        $categories = Category::all();
        $user = \Auth::user();
        return view('shop.profile.password', compact('categories', 'user'));
    }

    public function passwordStore(ChangePasswordRequest $request){

        if (!(\Hash::check($request->get('old_password'), \Auth::user()->password))) {
            alert()->warning('رمز عبور قدیم صحیح نمیباشد', 'خطا');
            return redirect()->back();
        }
        if(strcmp($request->get('old_password'), $request->get('password')) == 0){
            alert()->warning('رمز عبور قدیم و جدید یکسان میباشد', 'خطا');
            return redirect()->back();
        }


        $user = \Auth::user();
        $user->password = \Hash::make($request->get('password'));
        $user->save();
        alert()->success('اطلاعات شما با موفقیت ویرایش شد.', 'انجام شد');
        return redirect()->route('shop.profile.password');
    }


    public function orders()
    {
        $categories = Category::all();
        $user = \Auth::user();
        return view('shop.profile.orders', compact('categories', 'user'));
    }



}
