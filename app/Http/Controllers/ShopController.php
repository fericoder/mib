<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Brand;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('shop.index', compact('categories'));
    }



    public function product(Request $request)
    {
//        $shop = \Auth::user()->shop;
        $categories = Category::all();
        $product = Product::where('id', $request->id)->first();
        return view('shop.product', compact('product', 'categories'));
    }












    public function category(Request $request)
    {
        $categories = Category::all();
        $category = Category::where('id', $request->id)->first();
        $products = Product::where('category_id', $category->id)->paginate(20);
        return view('shop.category', compact('category', 'categories', 'products'));
    }

    public function brand(Request $request)
    {
        $categories = Category::all();
        $brand = Brand::where('id', $request->id)->first();
        $products = $brand->products->where('status', 'enable');
        return view('shop.brand', compact('brand', 'categories', 'products'));
    }


    public function search(Request $request)
    {

        $sortBy = 'id';
        $orderBy = 'desc';
        $perPage = 20;
        if ($request->has('orderBy')) $orderBy = $request->orderBy;
        if ($request->has('keyword')) $keyword = $request->keyword;
        if ($request->has('perPage')) $perPage = $request->perPage;
        if ($request->has('sortBy')) $sortBy = $request->sortBy;
        $categories = Category::all();
        $category = Category::where('id', $request->category)->first();
        $products = Product::where('title', 'like', '%' . $request->keyword . '%')->orderBy($sortBy, $orderBy)->paginate($perPage)->appends([request()->except('page', '_token') , 'sortBy' => $sortBy, 'orderBy' => $orderBy, 'perPage' => $perPage, 'keyword' => $keyword]);
        isset($category) ? $products = Product::where('title', 'like', '%' . $request->keyword . '%')->where('category_id', $request->category)->orderBy($sortBy, $orderBy)->paginate($perPage)->appends([request()->except('page', '_token') , 'sortBy' => $sortBy, 'orderBy' => $orderBy, 'perPage' => $perPage, 'keyword' => $keyword]) : '';

        return view('shop.category', compact('category', 'categories', 'products', 'keyword', 'perPage'));
    }


}
