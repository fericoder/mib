<?php

namespace App\Http\Controllers;

use App\SpecificationItem;
use App\Specification;
use App\Http\Requests\SpecificationItemRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SpecificationItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function main($id){
        $shop = \Auth::user()->shop()->first();
        $specification = Specification::find($id);
        $specificationItems = $specification->items;
        return view('dashboard.specification-item.index' , compact('specification' , 'shop','specificationItems'));
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
    public function store(SpecificationItemRequest $request)
    {
        $specificationItem = new SpecificationItem;
        $specificationItem->name = $request->name;
        $specificationItem->price = $this->fa_num_to_en($request->price);
        $specificationItem->specification_id = $request->specification_id;
        $specificationItem->shop_id = \Auth::user()->shop_id;
        $specificationItem->save();
        alert()->success('خصوصیت جدید شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\specificationItem  $specificationItem
     * @return \Illuminate\Http\Response
     */
    public function show(specificationItem $specificationItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\specificationItem  $specificationItem
     * @return \Illuminate\Http\Response
     */
    public function edit(specificationItem $specificationItem, Request $request)
    {
        $shop = \Auth::user()->shop()->first();
        return view('dashboard.specification-item.edit', compact('specificationItem', 'shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\specificationItem  $specificationItem
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificationItemRequest $request, specificationItem $specificationItem)
    {
        $specificationItem = SpecificationItem::where('id', $specificationItem->id)->update([
            'name' => $request->name,
            'price' => $this->fa_num_to_en($request->price),
        ]);


        alert()->success(' گزینه شما با موفقیت ویرایش شد.', 'ثبت شد');
        return redirect()->back();
    }



    public function changeStatus(Request $request){
        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
        ]);
        $specificationItem = SpecificationItem::find($request->id);
        if($specificationItem->status == 'disable')
            $specificationItem->status = 'enable';
        else
            $specificationItem->status = 'disable';
        $specificationItem->save();
        return back();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\specificationItem  $specificationItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(specificationItem $specificationItem, Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
        ]);
        $specificationItem = SpecificationItem::find($request->id);
        if ($specificationItem->specification->shop->user_id !== \Auth::user()->id) {
            alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
            return redirect()->back();
        }
        $specificationItem->delete();
        alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
        return redirect()->back();
    }





}
