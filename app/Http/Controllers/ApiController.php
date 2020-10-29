<?php

namespace App\Http\Controllers;

use App\CartProduct;
use App\SpecificationItemGroup;
use App\User;
use App\UserPurchase;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function generate(Request $request)
    {
            $token = md5(uniqid(rand(), true));
            \DB::table('tokens')->insert(['token' => $token, 'created_at' => now()]);
            return response()->json(['Token:' => "$token"]);
    }


    public function inventory(Request $request)
    {
        if (! \DB::table('tokens')->where('token', $request->token)->first()){
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


    public function userPurchases(Request $request)
    {
        if (! \DB::table('tokens')->where('token', $request->token)->first()){
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

    public function purchases(Request $request)
    {
        if (! \DB::table('tokens')->where('token', $request->token)->first()){
            abort(403, 'Unauthorized Action');
        }
        if (!is_numeric($request->from)){
            abort(403, 'Invalid Timestamp');
        }
        if (!is_numeric($request->to)){
            abort(403, 'Invalid Timestamp');
        }


        $timestampFrom = substr($request->from, 0, 10);
        $dateFrom = date('Y-m-d H:i:s', (int) $timestampFrom);

        $timestampTo = substr($request->to, 0, 10);
        $dateTo = date('Y-m-d H:i:s', (int) $timestampTo);

        $purchases = CartProduct::whereBetween('created_at', [$dateFrom, $dateTo])->select('id', 'p_id', 'quantity', 'total_price')->get();
        return response()->json($purchases);

    }


    public function amountReport(Request $request)
    {
        if (! \DB::table('tokens')->where('token', $request->token)->first()){
            abort(403, 'Unauthorized Action');
        }
        $amount = SpecificationItemGroup::with('product')->get();
        return response()->json($amount);

    }



}
