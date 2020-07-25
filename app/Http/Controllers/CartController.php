<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Category;
use App\Shop;
use App\Product;
use App\CartProduct;
use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Session;
use Request as RequestFacade;
use App\SpecificationItem;

class CartController extends \App\Http\Controllers\Controller {

    public function show($shopName) {
        try
        {

            $shop = Shop::where('english_name', $shopName)->first();
            $cart = \Auth::user()->cart()->get()->first();
            $categories = Category::all();

            if (!$cart){
                alert()->warning('سبد خرید شما خالی است.');
                return redirect()->back();
            }

            if(isset($cart->products)){
                foreach($cart->products as $product){
                    if($product->type == 'product' && $product->amount != null and $product->amount < 1){
                        CartProduct::where('product_id', '=', $product->id)->delete();
                    }
                    if($product->status == 'disable'){
                        CartProduct::where('product_id', '=', $product->id)->delete();
                    }
                    if($product->color_amount_status == 'enable'){
                        if($product->amount == null and $product->type = "product"){
                            foreach($cart->cartProduct as $cartProductSingle){
                                if($cartProductSingle->product->colors->where('id', $cartProductSingle->color->id)->first()->pivot->amount <= 0){
                                    CartProduct::where('product_id', '=', $product->id)->delete();
                                }
                            }
                        }
                    }
                }
            }
            if($cart){
                $cartProduct = CartProduct::where('cart_id', $cart->id);
                if($cartProduct->count() == 0){
                    Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
                }
            }


            if (\Auth::user()->cart()->get()->count() != 0) {
                $specificationItems = collect();
                foreach ($cart->cartProduct as $cartProduct){
                    if($cartProduct->specification != null){
                        foreach($cartProduct->specification as $specification){
                            $specificationItem = SpecificationItem::find($specification);
                            $specificationItems[] = $specificationItem;
                        }
                    }
                }
                $specificationItem = $specificationItems->unique('id');

                $products = \Auth::user()->cart()->get()->first()->products;
                return view("shop.cart", compact('shop', 'products','cart','specificationItems', 'categories'));
            } else {
                alert()->warning('سبد خرید شما خالی است.');
                return redirect()->back();
            }
        }


        catch(\Exception $e)
        {
            Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
            return redirect()->back()->withErrors(['با عرض پوزش محصولات سبد خرید شما به دلیل مشکلات محصول حذف شد. لطفا دوباره تلاش نمایید.']);
        }

    }





    public function addToCart($shopName, $userID, CartRequest $request) {

        $product = Product::where('id', $request->product_id)->get()->first();
        if($product->type == 'product' && $product->amount != null and $product->amount < 0){
            return redirect()->back()->withErrors(['کالای مورد نظر موجود نمیباشد']);
        }
        if($product->color_amount_status == 'enable'){
            if($product->type == 'product' && $product->amount == null and $product->color_amount_status == 'enable'){
                if($product->colors->where('id', $request->color)->first()->pivot->amount <= 0){
                    return redirect()->back()->withErrors(['کالای مورد نظر موجود نمیباشد']);
                }
            }
        }
        foreach($product->specifications()->where('type', 'radio')->get() as $radioSpecification){
            if($radioSpecification->items->count() > 0){
                foreach($request->specification as $specificationSingle){
                    if($specificationSingle == null){
                        return redirect()->back()->withErrors(['کالای مورد نظر با خصوصیت انتخابی موجود نمیباشد.']);
                    }
                }
                if($product->specifications()->where('type', 'radio')->count() != 0 and !isset($request->specification)){
                    return redirect()->back()->withErrors(['باید خصوصیت تک انتخابی کالا انتخاب شود']);
                }
            }
        }
        if($product->specification_amount_status == 'enable'){
            foreach($product->specifications as $specificationSingleOrg){
                foreach($request->specification as $specificationRequest){
                    foreach($specificationSingleOrg->items->where('id', $specificationRequest) as $singleItem){
                        if($singleItem->productSpecificationItems->where('product_id', $product->id)->first()->amount <= 0)
                            return redirect()->back()->withErrors(['کالای مورد نظر با خصوصیت انتخابی موجود نمیباشد.']);
                    }
                }
            }
        }
        if (\Auth::user()->cart()->count() == 0) {
            $cart = new Cart;
            $cart->user_id = \Auth::user()->id;
            $cart->shop_id = Shop::where('english_name', $shopName)->first()->id;
            $cart->status = 0;
            $cart->save();
        }
        if($request->specification != null){
            $specificationOrg = json_encode($request->specification);
        }else{
            $specificationOrg = null;
        }
        $cartProduct = DB::table('cart_product')->where('product_id', '=', $request->product_id)->where('cart_id', '=', \Auth::user()->cart()->get()->first()->id)->where('color_id', '=', $request->color)->where('specification', '=', $specificationOrg)->where('deleted_at', null)->first();
        $userCartShopID = \Auth::user()->cart()->get()->first()->shop_id;
        $currentshopID = Shop::where('english_name' , $shopName)->get()->first()->id;
        if($product->off_price != null and $product->off_price_started_at < now() and $product->off_price_expired_at > now()){

            $productPrice = $product->off_price;
        }else{
            $productPrice = $product->price;
        }
        if($request->quantity == null){
            $request->merge(['quantity' => 1]);
        }
        if(!isset($request->specification)){
            $specification = null;
        }
        else{
            $specification = json_encode($request->specification);
        }
        $specificationPrice = 0;
        if($request->specification != null){
            foreach($request->specification as $specificationItem){
                $specificationItem = SpecificationItem::find($specificationItem);
                $specificationPrice += $specificationItem->price;
            }
        }
        if (is_null($cartProduct) and $userCartShopID == $currentshopID) {
            if (\Auth::user()->cart()->count() != 0) {
                foreach(\Auth::user()->cart()->get()->first()->products()->get() as $singleCartProduct){
                    if($singleCartProduct->type != $product->type ){
                        toastr()->error('نوع کالا های سبد خرید باید یکسان باشند', '');
                        return redirect()->back();
                    }
                }
            }
            DB::transaction(function () use ($request, $specification, $specificationPrice, $productPrice) {
                DB::table('cart_product')->insert([
                    ['product_id' => $request->product_id,'quantity' => $request->quantity, 'cart_id' => \Auth::user()->cart()->get()->first()->id, 'color_id' => $request->color, 'total_price' => $productPrice, 'specification' => $specification, 'specification_price' => $specificationPrice]
                    , ]);

                $total_price = 0;
                foreach(\Auth::user()->cart()->get()->first()->cartProduct as $cartProduct){
                    $total_price += $cartProduct->total_price;
                }
                $cartUpdate = \Auth::user()->cart()->get()->first()->update([
                    'total_price' => $total_price,
                ]);

            });
            alert()->success('افزوده شد.', '');
            return redirect()->back();
        }
        else {
            alert()->error('محصول از قبل در سبد خرید شما وجود دارد.', '');
            return redirect()->back();
        }
    }


    public function removeFromCart(Request $request){
        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
            'cartProductId' => 'required|numeric|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
            'cart' => 'required|numeric|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u',
            'color' => 'nullable|numeric|min:1|max:10000000000|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي. ]+$/u'
        ]);
        if (\Auth::user()->cart->user_id !== \Auth::user()->id) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }
        DB::transaction(function () use ($request) {
            CartProduct::where([
                ['product_id', '=', $request->id],
                ['id', '=', $request->cartProductId],
                ['cart_id', '=', $request->cart],
                ['color_id', '=', $request->color],
            ])->delete();

            $cartProduct = CartProduct::where('cart_id', \Auth::user()->cart()->get()->first()->id);
            if($cartProduct->count() == 0){
                Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
            }
        });

        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart) {
        //

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart) {
        //

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart) {
        //

    }
}
