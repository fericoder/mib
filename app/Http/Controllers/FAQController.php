<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ErrorLog;
use App\Http\Requests\FAQRequest;
use App\FAQ;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $faqs = FAQ::all();
      return view('dashboard.faq.index', compact('faqs'));
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
    public function store(FAQRequest $request)
    {

                  $faq = new FAQ;
                  $faq->title = $request->title;
                  $faq->question = $request->question;
                  $faq->answer = $request->answer;
                  $faq->save();
                  alert()->success('سوال جدید شما باموفقیت اضافه شد.', 'ثبت شد');
                  return redirect()->route('faqs.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function show(FAQ $fAQ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function edit(FAQ $fAQ, $id)
    {
        $faq = FAQ::find($id);
        return view('dashboard.faq.edit', compact('faq'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function update(FAQRequest $request, $id)
    {
        $faq = FAQ::find($id)->update([
          'title' => $request->title,
          'question' => $request->question,
          'answer' => $request->answer,
      ]);


      alert()->success('سوال شما با موفقیت ویرایش شد', 'ثبت شد');
      return redirect()->route('faqs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FAQ  $fAQ
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $request->validate([
        'id' => 'required|numeric|min:1|max:10000000000|regex:/^[0-9]+$/u',
  ]);
      $faq = FAQ::find($request->id);
      if (\Auth::user()->type != 'admin') {
              alert()->error('شما مجوز مورد نظر را ندارید.', 'انجام نشد');
              return redirect()->back();
            }
               $faq->delete();
               alert()->success('درخواست شما با موفقیت انجام شد.', 'انجام شد');
               return redirect()->back();
    }


    // public function restore(Request $request){
    // }

}
