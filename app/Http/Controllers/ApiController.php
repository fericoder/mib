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
        if (!is_numeric($request->amount)){
            abort(403, 'Invalid Amount');
        }
        if (!\DB::table('specification_item_groups')->where('p_id', $request->id)->first()){
            abort(403, 'Invalid Id');
        }
        \DB::table('specification_item_groups')->where('p_id', $request->id)->update(['amount' => $request->amount]);
        return response()->json(['Massage' => 'Done!', 'New Amount Is' => $request->amount]);

    }


    public function purchases(Request $request)
    {
        if ($request->token !== 'cAxNzPS33wbX1pjbVEg1'){
            abort(403, 'Unauthorized Action');
        }
        if (!is_numeric($request->user_id)){
            abort(403, 'Invalid User');
        }
        if (!\DB::table('users')->where('crm_id', $request->user_id)->first()){
            abort(403, 'Invalid User');
        }
        $purchases = \DB::table('user_purchases')->where('user_id', \DB::table('users')->where('crm_id', $request->user_id)->first()->id)->get();
        return response()->json($purchases);

    }


}
