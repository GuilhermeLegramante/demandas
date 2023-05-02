<?php

namespace App\Http\Controllers;

class StatusController extends Controller
{
    public function table()
    {
        return view('parent.status-table');
    }

    public function form($id = null)
    {
        return view('parent.status-form', ['id' => $id]);
    }
}
