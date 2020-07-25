<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
class UserController extends Controller
{
    public function index(){
        $shop = \Auth::user()->shop()->first();
        $users = $shop->users()->where('type', 'customer')->get();
        return view('dashboard.users.index', compact('shop', 'users'));

    }


    public function purchases(User $user){
        $shop = \Auth::user()->shop()->first();
        $purchases = $user->purchases()->where('shop_id', $shop->id)->get();
        return view('dashboard.users.purchases', compact('shop', 'user', 'purchases'));
    }



    public function purcheseShow($userID, $id){

        $user = User::find($userID);
        $shop = \Auth::user()->shop()->first();
        $purchase = $user->purchases()->where('id', $id)->get()->first();
        return view('dashboard.users.purchase-show', compact('purchase', 'shop'));

    }


}
