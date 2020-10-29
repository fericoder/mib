<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $items = \DB::table('specification_item_groups')->whereColumn('amount', '<=', 'min_amount')->get();
        return view('dashboard.index', compact('items'));
    }

    public function warehouse()
    {
        $items = \DB::table('specification_item_groups')->get();
        return view('dashboard.warehouse', compact('items'));
    }
}
