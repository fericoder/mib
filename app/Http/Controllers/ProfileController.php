<?php

namespace App\Http\Controllers;

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
}
