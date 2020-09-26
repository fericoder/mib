<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Category;
use App\Product;
use App\Brand;
use App\FAQ;
use App\Shop;
use App\Specification;
use App\SpecificationItem;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $shop = Shop::where('english_name', 'keyvan')->first();
        return view('shop.index', compact('categories', 'shop'));
    }



    public function product(Request $request)
    {

        $categories = Category::all();
        $product = Product::where('id', $request->id)->firstOrFail();
        $product->increment('viewCount');
        $galleries = $product->galleries;
        $items = collect();
        $itemIds = collect();
        foreach($product->groups as $group){
           foreach($group->specification_items as $item){
                    $specificationItem = SpecificationItem::where('id', $item)->get()->first();
                    if(!$items->contains($specificationItem))
                    $items[] = $specificationItem;
                    if(!$itemIds->contains($item))
                    $itemIds[] = $item;
                   }
        }
        $specifications = collect();
        foreach($items as $item){
            $specification = $item->specification;
            if(!$specifications->contains($specification))
            $specifications[] = $specification;
        }

        return view('shop.product', compact('product', 'categories','items', 'specifications','itemIds', 'galleries'));
    }



    // public function getRelatedItems(Request $request){
    //     dd($request->all());
    //     $request->validate([
    //       'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
    // ]);
    //     $features = collect();
    //     if($this->getAllParentCategories($request->id)->count() == 0){
    //       $features[] = ProductCategory::find($request->id)->features;
    //     }
    //     else{
    //       $features[] = ProductCategory::find($request->id)->features;
    //       foreach($this->getAllParentCategories($request->id) as $category){
    //         $features[] = ProductCategory::find($category->id)->features;
    //     }
    //     }
    // return response()->json($features);
    //   }




    public function category(Request $request)
    {
        $categories = Category::all();
        $category = Category::where('id', $request->id)->first();
        $categoryChildren = $category->children;
        $categoryChildrenChildren = $category->categoryChildren;
        $subCategories = $this->getAllSubCategories($category->id)->where('parent_id', $category->id);
        $products = $this->getAllCategoriesProducts((int)$category->id);
        $total = $products->count();
        $perPage = 16; // How many items do you want to display.
        $currentPage = request()->page; // The index page.
        $productsPaginate = new LengthAwarePaginator($products->forPage($currentPage, $perPage), $total, $perPage, $currentPage);
        return view('shop.category', compact('category', 'categories', 'products', 'productsPaginate'));
    }

    public function brand(Request $request)
    {
        $categories = Category::all();
        $brand = Brand::where('id', $request->id)->first();
        $products = $brand->products->where('status', 'enable');
        $total = $products->count();
        $perPage = 16; // How many items do you want to display.
        $currentPage = request()->page; // The index page.
        $productsPaginate = new LengthAwarePaginator($products->forPage($currentPage, $perPage), $total, $perPage, $currentPage);
        return view('shop.brand', compact('brand', 'categories', 'products', 'productsPaginate'));
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

        $total = $products->count();
        $perPage = 16; // How many items do you want to display.
        $currentPage = request()->page; // The index page.
        $productsPaginate = new LengthAwarePaginator($products->forPage($currentPage, $perPage), $total, $perPage, $currentPage);


        return view('shop.category', compact('category', 'categories', 'productsPaginate', 'keyword', 'perPage'));
    }


    public function aboutUs(){

        $categories = Category::all();
        $shop = Shop::find(1);
        return view('shop.about-us',compact('categories','shop'));

    }

    public function contactUs(){

        $categories = Category::all();
        $shop = Shop::find(1);
        return view('shop.contact-us',compact('categories','shop'));

    }

    public function faq(){

        $categories = Category::all();
        $faqs = FAQ::all();
        return view('shop.faq',compact('categories','faqs'));

    }



    public function getRelatedItems(Request $request){

        $item_ids = [];
        if($request->item_id != null){
            foreach($request->item_id as $item_id){
                if($item_id != null){
                    $item_ids[] = $item_id;
                }
            }
        }

        $product = Product::where('id', $request->product_id)->first();
        if ($item_ids == null) {

        $items = collect();
        $itemIds = collect();
        foreach($product->groups as $group){
           foreach($group->specification_items as $item){
                    $specificationItem = SpecificationItem::where('id', $item)->get()->first();
                    if(!$items->contains($specificationItem))
                    $items[] = $specificationItem;
                    if(!$itemIds->contains($item))
                    $itemIds[] = $item;
                   }
        }
        $specifications = collect();
        foreach($items as $item){
            $specification = $item->specification;
            if(!$specifications->contains($specification))
            $specifications[] = $specification->load('items');
        }
        $arrayJson = array('items'=>$items->toArray(),'itemIds'=>$itemIds->toArray(),'specifications'=>$specifications->sortByDesc('order')->unique('id')->values());

        return response()->json($arrayJson);
        } else {
            $request->validate([
            'item_id' => 'required',
      ]);

            $userSelectedId =  $item_ids;
            $productGroups = $product->groups;
            $items = collect();
            $itemIds = collect();

            foreach ($productGroups as $group) {
                //check if selected item is in items
                if(count(array_intersect($userSelectedId, $group->specification_items)) == count($userSelectedId)){
                    foreach ($group->specification_items as $item) {
                        $specificationItem = SpecificationItem::where('id', $item)->get()->first();
                        if (!$items->contains($specificationItem)) {
                            $items[] = $specificationItem;
                        }
                        if (!$itemIds->contains($item)) {
                            $itemIds[] = $item;
                        }
                    }
                }
            }


            $specifications = collect();
            foreach ($items as $item) {
                $specification = $item->specification;
                if (!$specifications->contains($specification)) {
                    $specifications[] = $specification->load('items');
                }
            }
            $arrayJson = array('items'=>$items->toArray(),'itemIds'=>$itemIds->toArray(),'specifications'=>$specifications->sortByDesc('order')->unique('id')->values());

            return response()->json($arrayJson);
        }
    }

    public static function getAllSubCategories($cat_id) {
        $allSubCategories = collect();
        if (Category::find($cat_id)->children()->exists()) {
            foreach (Category::find($cat_id)->children()->get() as $subCategory) {
                $allSubCategories[] = $subCategory;
                if ($subCategory->children()->exists()) {
                    foreach ($subCategory->children()->get() as $subSubCategory) {
                        $allSubCategories[] = $subSubCategory;

                        if ($subSubCategory->children()->exists()) {
                            foreach ($subSubCategory->children()->get() as $subSubSubCategory) {
                                $allSubCategories[] = $subSubSubCategory;
                                if ($subSubSubCategory->children()->exists()) {
                                    foreach ($subSubSubCategory->children()->get() as $subSubSubSubCategory) {
                                        $allSubCategories[] = $subSubSubSubCategory;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return $allSubCategories;
    }

    public function getAllCategoriesProducts($cat_id) {
        $allProducts = collect();
        foreach (Category::find($cat_id)->products()->get() as $product) {
            $allProducts[] = $product;
        }
        foreach (Category::find($cat_id)->children()->get() as $subCategory) {
            foreach ($subCategory->products()->get() as $product) {
                $allProducts[] = $product;
            }
            if ($subCategory->children()->exists()) {
                foreach ($subCategory->children()->get() as $subSubCategory) {
                    foreach ($subSubCategory->products()->get() as $product) {
                        $allProducts[] = $product;
                    }
                }
                if ($subSubCategory->children()->exists()) {
                    foreach ($subSubCategory->children()->get() as $subSubSubCategory) {
                        foreach ($subSubSubCategory->products()->get() as $product) {
                            $allProducts[] = $product;
                        }
                        if ($subSubSubCategory->children()->exists()) {
                            foreach ($subSubSubCategory->children()->get() as $subSubSubSubCategory) {
                                foreach ($subSubSubSubCategory->products()->get() as $product) {
                                    $allProducts[] = $product;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $allProducts;
    }


    public static function getItemsGroup($specificationItemsArray) {
        $allItems = collect();
        foreach($specificationItemsArray as $specificationItemArray){
            $item = SpecificationItem::find($specificationItemArray);
            $allItems[] = $item->name;
        }
        return $allItems;
    }


    public function pages(Request $request)
    {
        $blog = Blog::where('id', $request->id)->first();
        $categories = Category::all();
        $shop = Shop::where('english_name', 'keyvan')->first();

        return view('shop.page', compact('blog', 'categories', 'shop'));
    }

    public function blogs(Request $request)
    {
        $blogs = Blog::where('type', 'article')->paginate(15);
        $categories = Category::all();
        $shop = Shop::where('english_name', 'keyvan')->first();

        return view('shop.blogs', compact('blogs', 'categories', 'shop'));
    }

    public function blog(Request $request)
    {
        $blog = Blog::where('id', $request->id)->first();
        $categories = Category::all();
        $shop = Shop::where('english_name', 'keyvan')->first();

        return view('shop.blog', compact('blog', 'categories', 'shop'));
    }

}
