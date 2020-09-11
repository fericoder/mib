<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Shop;
use App\Tag;
use App\Brand;
use App\Cart;
use App\CartProduct;
use App\ErrorLog;
use App\Color;
use App\Specification;
use App\Value;
use App\Facility;
use App\Dashboard;
use App\ProductCategory;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\SpecificationItem;
use App\SpecificationItemGroup;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::all();
        $specifications = Specification::whereHas('items')->orderBy('order', 'DESC')->get();
        return view('dashboard.product.index', compact('categories','products', 'brands', 'specifications'));

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
    public function store(ProductRequest $request)
    {
        //check if product category is null
        if($request->productCat_id == "null"){
            $request->merge(['productCat_id' => null]);
        }
        if($request->brand_id == "null"){
            $request->merge(['brand_id' => null]);
        }
        //validate product category if is null or not
        $request->validate(['productCat_id' => 'required']);
        if($request->file('catalog') == null){
            $catalog = '';
        }
        else{
            $request->validate(['catalog' => 'mimes:pdf']);
            $catalog = $this->uploadFile($request->file('catalog'), false, false);
        }
        $image = $this->uploadFile($request->file('image'), false, true);
        if ($request->enable != "on")
            $request->enable = 0;
        else
            $request->enable = 1;

        if ($request->no_specification_status != "on")
              $request->merge(['no_specification_status' => 'disable']);
        else
        $request->merge(['no_specification_status' => 'enable']);

        if($request->measure != null){
            $request->measure = $this->fa_num_to_en($request->measure);
        }
        //check weight of product and change fa number to en
        if($request->weight != null){
            $request->weight = $this->fa_num_to_en($request->weight);
        }

                $product = Product::create([
                    'title' => $request->title,
                    'type' => 'product',
                    'category_id' => $request->productCat_id,
                    'brand_id' => $request->brand_id,
                    'measure' => $request->measure,
                    'weight' => $request->weight,
                    'price' => $this->fa_num_to_en($request->price),
                    'shortDescription' => $request->shortDescription,
                    'country_id' => $request->country_id,
                    'description' => $request->description,
                    'aparat' => $request->aparat,
                    'shegeftangiz' => $request->shegeftangiz,
                    'userPrice' => $request->userPrice,
                    'no_specification_status' => $request->no_specification_status,
                    'image' => $image,
                    'catalog' => $catalog,
                    'shop_id' => \Auth::user()->shop_id,
                    'description' => $request->description,
                ]);

                if($request->no_specification_status == 'disable'){
                if ($request->group[1]['p_id'] != null and $request->group[1]['amount'] != null and isset($request->group[1]['items'])) {
                    if (isset($request->group)) {
                        foreach ($request->group as $group) {
                            $groupItem = new SpecificationItemGroup;
                            $groupItem->specification_items = $group['items'];
                            $groupItem->product_id = $product->id;
                            $groupItem->amount = $this->fa_num_to_en($group['amount']);
                            $groupItem->min_amount = $this->fa_num_to_en($group['min_amount']);
                            $groupItem->p_id = $this->fa_num_to_en($group['p_id']);
                            $groupItem->save();
                        }
                    }
                }
              }
              else{
                  $product->update([
                    'amount' => $this->fa_num_to_en($request->group[1]['amount']),
                    'min_amount' => $this->fa_num_to_en($request->group[1]['min_amount']),
                    'p_id' => $this->fa_num_to_en($request->group[1]['p_id'])
                  ]);
              }

        if($product)
                {
                    DB::transaction(function () use ($request, $product) {
                        $tagIds = [];
                        $sepecificationIds = [];

                        //get all tags of product
                        $tagNames = explode(',',$request->get('tags'));
                        foreach($tagNames as $tagName)
                        {
                            $tag = Tag::firstOrCreate(['name'=>$tagName]);
                            // $tag = Tag::firstOrCreate(['name'=>$tagName, 'shop_id' =>Auth::user()->shop()->first()->id]);
                            if($tag)
                            {
                                $tagIds[] = $tag->id;
                            }
                        }
                        $product->tags()->sync($tagIds);
                    });
                }
                alert()->success('محصول جدید شما باموفقیت اضافه شد.', 'ثبت شد');
                return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $shop = \Auth::user()->shop()->first();
        $tags = [];
        foreach($product->tags as $tag){
            $tags[] = $tag->name;
        }
        $specifications = Specification::whereHas('items')->orderBy('order', 'DESC')->get();
        $tags = implode(',', $tags);
        $categories = \Auth::user()->shop()->first()->categories()->doesntHave('children')->get();
        $brands = \Auth::user()->shop()->first()->brands()->get();
        $lastGroupId = SpecificationItemGroup::latest('id')->first()->id;
        return view('dashboard.product.edit', compact('product','categories','brands','tags', 'shop', 'specifications','lastGroupId'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
      if ($product->no_specification_status == 'disable') {
        $request->merge(['p_id' => null]);
        $request->merge(['amount' => null]);
        $request->merge(['min_amount' => null]);
      }

        if($request->file('image') == null){
            $image = $product->image;
        }
        else{
            $request->validate(['image' => 'mimes:jpeg,png,jpg,gif|max:2048']);
            $image = $this->uploadFile($request->file('image'), false, true);
        }
        if($request->file('catalog') == null){
            $catalog = $product->catalog;
        }
        else{
            $request->validate(['catalog' => 'mimes:pdf']);
            $catalog = $this->uploadFile($request->file('catalog'), false, false);
        }

        if($request->brand_id == "null"){
            $request->merge(['brand_id' => null]);
        }

        if ( $request->enable != "on")
            $request->enable = 0;
        else
            $request->enable = 1;

        if($request->weight != null){
            $request->weight = $this->fa_num_to_en($request->weight);
        }
        $updatedProduct = $product->update([
            'title' => $request->title,
            'type' => $request->type,
            'category_id' => $request->productCat_id,
            'brand_id' => $request->brand_id,
            'measure' => $request->measure,
            'weight' => $request->weight,
            'aparat' => $request->aparat,
            'price' => $this->fa_num_to_en($request->price),
            'shegeftangiz' => $request->shegeftangiz,
            'userPrice' => $request->userPrice,
            'p_id' => $request->p_id,
            'amount' => $request->amount,
            'min_amount' => $request->min_amount,
            'shortDescription' => $request->shortDescription,
            'country_id' => $request->country_id,
            'description' => $request->description,
            'image' => $image,
            'catalog' => $catalog,
        ]);

        if (isset($request->group)){
            $gp_request = [];
            $gp_product = [];
            foreach($request->group as $groupId => $group)
            {
                if(strpos($groupId, 'new') === false){
                    $gp_request[] = $groupId;
                }
            }

            foreach($product->groups as $gp){
                $gp_product[] = $gp->id;
            }

            if ((count(array_diff($gp_product, $gp_request))) != 0) {
                foreach(array_diff($gp_product,$gp_request) as $gp_id){
                    $specificationGroup = SpecificationItemGroup::find($gp_id);
                    CartProduct::where('group_id', $gp_id)->delete();
                    $specificationGroup->delete();
            }
            }

            foreach($request->group as $groupId => $group)
            {
                if(strpos($groupId, 'new') !== false){
                    $groupItem = new SpecificationItemGroup;
                    $groupItem->specification_items = $group['items'];
                    $groupItem->product_id = $product->id;
                    $groupItem->amount = $this->fa_num_to_en($group['amount']);
                    $groupItem->min_amount = $this->fa_num_to_en($group['min_amount']);
                    $groupItem->p_id = $this->fa_num_to_en($group['p_id']);
                    $groupItem->save();
                }
                else{
                    SpecificationItemGroup::updateOrCreate(['id' => $groupId],
                    ['specification_items' => $group['items'], 'product_id' => $product->id, 'amount' => $this->fa_num_to_en($group['amount']), 'min_amount' => $this->fa_num_to_en($group['min_amount']), 'p_id' => $this->fa_num_to_en($group['p_id'])]);
                }
            }

        }
        else{
            foreach($product->groups as $singleGp){
                CartProduct::where('group_id', $singleGp->id)->delete();
            }
            $product->groups()->delete();
        }

        if($updatedProduct)
        {
            $tagIds = [];
            $sepecificationIds = [];


            //get all tags of product
            $tagNames = explode(',',$request->get('tags'));
            foreach($tagNames as $tagName)
            {
                $tag = Tag::firstOrCreate(['name'=>$tagName]);
                if($tag)
                {
                    $tagIds[] = $tag->id;
                }
            }

            if($request->get('specifications')){
                foreach($request->get('specifications') as $specificationName)
                {
                    $specification = Specification::firstOrCreate(['id'=>$specificationName]);
                    if($specification)
                    {
                        $sepecificationIds[] = $specification->id;
                    }
                }
                $product->specifications()->sync($sepecificationIds);
            }



            $product->tags()->sync($tagIds);
            // $product->colors()->sync($colorIds);
            $product->specifications()->sync($sepecificationIds);
        }
        alert()->success('محصول شما باموفقیت ویرایش شد.', 'ثبت شد');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $carts = Cart::all();
        foreach($carts as $cart){
          foreach($cart->cartProduct as $cartProduct){
            $deletedProduct = $cartProduct->product()->where('id', $request->id)->get()->first();
            if($deletedProduct){
              $cartProduct->where('product_id', $deletedProduct->id)->delete();
            }
          }
        }
        $product = Product::where('id' , $request->id)->first()->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();

    }

    public function getSpecificationItems(Request $request){
        $request->validate([
            'selected_specificationIds.*' => 'required|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
        ]);
        $items = [];
        foreach ($request->selected_specificationIds as $specificationId) {
            $items[] = Specification::find($specificationId)->items;
        }

        return response()->json($items);
    }

}
