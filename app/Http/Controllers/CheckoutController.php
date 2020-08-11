<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Category;
use App\Shop;
use App\Http\Requests\CheckOutRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cart;
use App\UserPurchase;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        foreach($request->except('_token') as $cartProductId => $quantity){

            $cartProductUpdate = \Auth::user()->cart()->get()->first()->cartProduct()->where('id', $cartProductId)->update([
                'quantity' => $quantity,
            ]);

        }
        $categories = Category::all();
        $cart = \Auth::user()->cart()->get()->first();
        $user = \Auth::user();
        $shop = Shop::where('english_name', 'keyvan')->first();
        return view('shop.checkout', compact('categories', 'user', 'shop', 'cart'));
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
    public function store(CheckOutRequest $request)
    {
      $cart = \Auth::user()->cart()->get()->first();
      $total_price = \Auth::user()->cart()->get()->first()->total_price;
      $purchase = new UserPurchase;
      $purchase->cart_id = $cart->id;
      $purchase->user_id = \Auth::user()->id;
      $purchase->date = \Morilog\Jalali\Jalalian::forge('today')->format('%Y/%m/%d');
      $purchase->address_id = $request->address;
      $purchase->shipping = 'post';
      $purchase->payment_method = $request->payment_method;
      $purchase->shipping_price = 0;
      $purchase->total_price = $total_price;
      $purchase->save();
      DB::table('carts')->where('id', '=', \Auth::user()->cart()->get()->first()->id)->update(['status' => 1]);
      Cart::where('id', \Auth::user()->cart()->get()->first()->id)->get()->first()->delete();
      alert()->success('خرید شما با موفقیت ثبت شد.', '');
       return redirect()->route('profile.orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
