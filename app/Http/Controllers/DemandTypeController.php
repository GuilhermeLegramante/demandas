<?php

namespace App\Http\Controllers;

class DemandTypeController extends Controller
{
    public function table()
    {
        return view('parent.demand-type-table');
    }

    public function form($id = null)
    {
        return view('parent.demand-type-form', ['id' => $id]);
    }
}
