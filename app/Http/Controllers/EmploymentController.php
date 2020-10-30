<?php

namespace App\Http\Controllers;

use App\Employment;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    public function index()
    {
        $employments = Employment::all();
        return view('dashboard.employment.index', compact('employments'));
    }


    public function show(Employment $employment)
    {
        return view('dashboard.employment.show', compact('employment'));
    }


}
