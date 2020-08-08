<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartProduct;
use App\UserPurchase;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = \Auth::user()->shop()->first();
        $purchases = $shop->purchases;
        $shopSpecifications = $shop->specifications;
        return view('dashboard.purchase.index', compact('purchases', 'shop', 'shopSpecifications'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = \Auth::user()->shop()->first();
        $purchase = $shop->purchases()->where('id', $id)->get()->first();
        $specificationItems = collect();
        if($purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->shop->specifications != null){
            foreach($purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->shop->specifications()->withTrashed()->get() as $specification){
                foreach ($purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->cartProduct as $cartProduct) {
                    if($cartProduct->specification != null){
                        foreach ($cartProduct->specification as $itemId) {
                            foreach ($specification->items()->withTrashed()->get()->where('id', $itemId) as $item) {
                                $specificationItems[] = $item;
                            }
                        }
                    }
                }
            }
        }
        return view('dashboard.shop.purchase.show', compact('purchase', 'shop', 'specificationItems'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function changeStatus(Request $request){
        $request->validate([
            'id' => 'numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
            'status' => 'required|in:notPaid,paid,shipped,processing,delivered'
        ]);
        $shop = \Auth::user()->shop()->first();
        $purchase = $shop->purchases->where('id', $request->id)->first();
        $purchase->status = $request->status;
        $purchase->save();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
            'purchaseid' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u'
        ]);
        $cartProduct = CartProduct::find($request->id);
        $purchase = UserPurchase::find($request->purchaseid);
        if ($purchase->shop->user_id !== \Auth::user()->id) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }
        if ($cartProduct->cart()->withTrashed()->get()->first()->shop->user_id !== \Auth::user()->id) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }

        DB::transaction(function () use ($purchase, $cartProduct) {
            $cartProduct->delete();
            $newTotalPrice = $purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->cartProduct->sum('total_price');
            $purchase->update([
                'total_price' => $newTotalPrice
            ]);
            alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
            return redirect()->back();
        });


    }


    public function restore(Request $request){

        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
        ]);
        $cartProduct = CartProduct::withTrashed()->where('id', $request->id)->get()->first();
        $purchase = UserPurchase::withTrashed()->where('id', $request->purchaseid)->get()->first();
        if (\Auth::user()->is_superAdmin != 1) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }
        if ($cartProduct->cart()->withTrashed()->get()->first()->shop->user_id !== \Auth::user()->id) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }

        DB::transaction(function () use ($purchase, $cartProduct) {
            $cartProduct->restore();
            $newTotalPrice = $purchase->cart()->withTrashed()->where('status' , 1)->get()->first()->cartProduct->sum('total_price');
            $purchase->update([
                'total_price' => $newTotalPrice
            ]);
            alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
            return redirect()->back();
        });

        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }


}
