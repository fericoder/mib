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
use App\SpecificationItemGroup;

class CartController extends \App\Http\Controllers\Controller {

    public function show() {
        try
        {
            $cart = \Auth::user()->cart()->get()->first();
            $categories = Category::all();
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
                return view("shop.cart", compact('products','cart','specificationItems', 'categories'));
            } else {
                $products = null;
                $cart = null;
                $specificationItems = null;
                return view("shop.cart", compact('products','cart','specificationItems', 'categories'));
            }
        }


        catch(\Exception $e)
        {

            Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
            return redirect()->back()->withErrors(['با عرض پوزش محصولات سبد خرید شما به دلیل مشکلات محصول حذف شد. لطفا دوباره تلاش نمایید.']);
        }

    }



    public function addToCart($userID, CartRequest $request) {

        $product = Product::where('id', $request->product_id)->get()->first();
        $newGroup = NULL;
        if($product->no_specification_status == 'disable' and $product->groups->count() != 0){
            if($request->specification){
            $groups = SpecificationItemGroup::where('product_id', $product->id)->get();
            foreach($groups as $group){
                $reqSpec = $request->specification;
                $gpSpec = $group->specification_items;
                sort($reqSpec);
                sort($gpSpec);
                if($reqSpec == $gpSpec)
                $newGroup = $group;
            }
        }
            if($newGroup == null){
                return redirect()->back()->withErrors(['محصولی با این خصوصیات وجود ندارد']);
            }
        }
        elseif($product->no_specification_status == 'enable'){
            $newGroup = $product->groups->first();
        }
        else{
            $newGroup = new \stdClass();
            $newGroup->id = null;
            $newGroup->p_id = null;
        }
        if($newGroup->amount <= 0){
            return redirect()->back()->withErrors(['کالای مورد نظر موجود نمیباشد']);
        }

        if (\Auth::user()->cart()->count() == 0) {
            $cart = new Cart;
            $cart->user_id = \Auth::user()->id;
            $cart->status = 0;
            $cart->save();
        }

        $cartProduct = DB::table('cart_product')->where('product_id', '=', $request->product_id)->where('cart_id', '=', \Auth::user()->cart()->get()->first()->id)->where('group_id', '=', $newGroup->id)->where('deleted_at', null)->first();
        $userCartShopID = \Auth::user()->cart()->get()->first()->shop_id;
            $productPrice = $product->price;
        if($request->quantity == null){
            $request->merge(['quantity' => 1]);
        }

        if (is_null($cartProduct)) {
            DB::transaction(function () use ($request, $productPrice, $newGroup) {
                DB::table('cart_product')->insert([
                    ['product_id' => $request->product_id,'quantity' => $request->quantity, 'cart_id' => \Auth::user()->cart()->get()->first()->id, 'group_id' => $newGroup->id, 'total_price' => $productPrice, 'p_id' => $newGroup->p_id, 'user_id' => \Auth::user()->id, 'crm_id' => \Auth::user()->crm_id, 'created_at' => now()]
                    , ]);

                $total_price = 0;
                foreach(\Auth::user()->cart()->get()->first()->cartProduct as $cartProduct){
                    $total_price += $cartProduct->total_price;
                }
                $cartUpdate = \Auth::user()->cart()->get()->first()->update([
                    'total_price' => $total_price,
                    'updated_at' => now()
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
