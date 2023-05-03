<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemandController extends Controller
{
    public function table()
    {
        return view('parent.demand-table');
    }
}
