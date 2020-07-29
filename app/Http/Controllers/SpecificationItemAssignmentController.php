<?php

namespace App\Http\Controllers;

use App\Specification;
use App\SpecificationItem;
use Illuminate\Http\Request;

class SpecificationItemAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecificationItem $specificationItem)
    {
        $specificationItems = $this->getAllSpecificationItems($specificationItem->id);
        return view('dashboard.specification-item.assignment' , compact('specificationItem', 'specificationItems'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecificationItem $specificationItem, Request $request)
    {
        $specificationItem->assignmentItems()->sync($request->specificationItems);
        alert()->success('دسته بندی جدید شما باموفقیت اضافه شد.', 'ثبت شد');
        return redirect()->route('specification-item.main', $specificationItem->specification->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAllSpecificationItems($exceptItemId){
        $specificationItems = collect();
        $specificationItem = SpecificationItem::find($exceptItemId);
        $specifications = Specification::where('id', '!=', $specificationItem->specification->id)->get();
        foreach ($specifications as $specification) {
            foreach($specification->items as $item) {
                $specificationItems[] = $item;
            }

      }
        return $specificationItems;
    }
}
