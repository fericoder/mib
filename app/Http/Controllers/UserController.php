<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
class UserController extends Controller
{
    public function index(){
        $shop = \Auth::user()->shop()->first();
        $users = $shop->users()->where('type', 'customer')->get();
        return view('dashboard.users.index', compact('shop', 'users'));

    }

    public function edit(User $user){
        $shop = \Auth::user()->shop()->first();
        return view('dashboard.users.edit', compact('shop', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'mobile' => 'required',
            'status' => 'required',
            'email' => 'required',
            'crm_id' => 'nullable',
            'pezeshkiNo' => 'nullable',
            'moarref' => 'nullable',
            'job' => 'nullable',
        ]);


        $user->update([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'email' => $request->email,
            'crm_id' => $request->crm_id,
            'pezeshkiNo' => $request->pezeshkiNo,
            'moarref' => $request->moarref,
            'job' => $request->job,
        ]);

        alert()->success('کاربر مورد نظر ویرایش شد', 'انجام شد');
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'mobile' => 'required',
            'status' => 'required',
            'email' => 'required',
            'crm_id' => 'nullable',
            'pezeshkiNo' => 'nullable',
            'moarref' => 'nullable',
            'job' => 'nullable',
            'meliPic' => 'nullable',
            'nezamPic' => 'nullable',
            'javazPic' => 'nullable',
        ]);


        if ($request->file('meliPic')){
            $meliPic = $this->uploadFile($request->file('meliPic'), false, true);
        }else{
            $meliPic = '';
        }
        if ($request->file('nezamPic')){
            $nezamPic = $this->uploadFile($request->file('nezamPic'), false, true);
        }else{
            $nezamPic = '';
        }

        if ($request->file('javazPic')){
            $javazPic = $this->uploadFile($request->file('javazPic'), false, true);
        }else{
            $javazPic = '';
        }


        User::create([
            'fName' => $request->fName,
            'lName' => $request->lName,
            'mobile' => $this->fa_num_to_en($request->mobile),
            'status' => $request->status,
            'email' => $request->email,
            'crm_id' => $this->fa_num_to_en($request->crm_id),
            'pezeshkiNo' => $this->fa_num_to_en($request->pezeshkiNo),
            'moarref' => $this->fa_num_to_en($request->moarref),
            'job' => $request->job,
            'password' => \Hash::make($request->password),
            'meliPic' => $meliPic['original'],
            'nezamPic' => $nezamPic['original'],
            'javazPic' => $javazPic['original'],
            'shop_id' => \Auth::user()->shop->id,
        ]);

        alert()->success('کاربر مورد نظر ایجاد شد', 'انجام شد');
        return redirect()->back();
    }

    public function purchases(User $user){
        $shop = \Auth::user()->shop()->first();
        $purchases = $user->purchases()->where('shop_id', $shop->id)->get();
        return view('dashboard.users.purchases', compact('shop', 'user', 'purchases'));
    }



    public function purcheseShow($userID, $id){

        $user = User::find($userID);
        $shop = \Auth::user()->shop()->first();
        $purchase = $user->purchases()->where('id', $id)->get()->first();
        return view('dashboard.users.purchase-show', compact('purchase', 'shop'));

    }


}
