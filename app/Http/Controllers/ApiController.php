<?php

namespace App\Http\Controllers;

use App\User;
use App\UserPurchase;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function inventory(Request $request)
    {
        if ($request->token !== 'cAxNzPS33wbX1pjbVEg1'){
            abort(403, 'Unauthorized Action');
        }
        if (!is_numeric($this->fa_num_to_en($request->amount))){
            abort(403, 'Invalid Amount');
        }
        if (!\DB::table('specification_item_groups')->where('p_id', $this->fa_num_to_en($request->id))->first()){
            abort(403, 'Invalid Id');
        }
        \DB::table('specification_item_groups')->where('p_id', $this->fa_num_to_en($request->id))->update(['amount' => $this->fa_num_to_en($request->amount)]);
        return response()->json(['Massage' => 'Done!', 'New Amount Is' => $this->fa_num_to_en($request->amount)]);

    }


    public function purchases(Request $request)
    {
        if ($request->token !== 'cAxNzPS33wbX1pjbVEg1'){
            abort(403, 'Unauthorized Action');
        }
        if (!is_numeric($request->user_id)){
            abort(403, 'Invalid User');
        }
        if (!\DB::table('users')->where('crm_id', $this->fa_num_to_en($request->user_id))->first()){
            abort(403, 'Invalid User');
        }
        $id = User::where('crm_id', $this->fa_num_to_en($request->user_id))->first()->id;
        $purchases = UserPurchase::with('cart.products')->where('user_id', $id)->withTrashed()->get();
        return response()->json($purchases);

    }


}
