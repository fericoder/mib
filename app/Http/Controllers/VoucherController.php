<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Http\Controllers\Controller;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $vouchers = Voucher::all();
      return view('dashboard.voucher.index', compact('vouchers'));
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
      if($request->type != "on")
          $request->type = 'percentage';
      else
          $request->type = 'number';

   $voucher = \Auth::user()->shop()->first()->vouchers()->create([
       'name' => $request->name,
       'code' => $this->createRandomCode(),
       'type' => $request->type,
       'discount_amount' => $this->fa_num_to_en($request->discount_amount),
     ]);
     alert()->success('کد جدید شما باموفقیت اضافه شد.', 'ثبت شد');
     return redirect()->route('vouchers.index');
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
    public function edit($id)
    {
      $voucher = Voucher::find($id);
      return view('dashboard.voucher.edit', compact('voucher'));
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

  if($request->type != "on")
  $request->type = 'percentage';
  else
  $request->type = 'number';


    $voucher = \Auth::user()->shop()->first()->vouchers()->where('id',$id)->get()->first()->update([
        'name' => $request->name,
        'type' => $request->type,
        'discount_amount' => $this->fa_num_to_en($request->discount_amount),
      ]);
      alert()->success('کد تخفیف شما باموفقیت ویرایش شد.', 'ثبت شد');
      return redirect()->route('vouchers.index');

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
]);
    $voucher = Voucher::where('id' , $request->id)->get()->first();
             if ($voucher->shop()->get()->first()->user_id !== \Auth::user()->id) {
                 alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
                 return redirect()->back();
             }

             $voucherDelete = \Auth::user()->shop()->first()->vouchers()->where('id' , $request->id)->first()->delete();
             alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
              return redirect()->back();
    }

    public function createRandomCode() {
      $chars = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
            srand((double)microtime()*1000000);
            $i = 0;
            $pass = 'mib'.'-'.'' ;

            while ($i <= 4) {
                $num = rand() % 33;
                $tmp = substr($chars, $num, 1);
                $pass = $pass . $tmp;
                $i++;
            }
            return $pass;
}
}
