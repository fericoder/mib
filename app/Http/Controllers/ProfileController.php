<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
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
        $user = \Auth::user();
        return view('shop.profile.addresses', compact('categories', 'user'));
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
