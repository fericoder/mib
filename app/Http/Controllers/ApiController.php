<?php

namespace App\Http\Controllers;

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
        if (!is_numeric($request->$this->fa_num_to_en(user_id))){
            abort(403, 'Invalid User');
        }
        if (!\DB::table('users')->where('crm_id', $this->fa_num_to_en($request->user_id))->first()){
            abort(403, 'Invalid User');
        }
        $purchases = \DB::table('user_purchases')->where('user_id', \DB::table('users')->where('crm_id', $this->fa_num_to_en($request->user_id))->first()->id)->get();
        return response()->json($purchases);

    }


}
