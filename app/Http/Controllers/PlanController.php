<?php

namespace App\Http\Controllers;

class PlanController extends Controller
{
    public function table()
    {
        return view('parent.plan-table');
    }

    public function form($id = null)
    {
        return view('parent.plan-form', ['id' => $id]);
    }
}
