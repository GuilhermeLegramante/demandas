<?php

namespace App\Http\Controllers;

class ClientController extends Controller
{
    public function table()
    {
        return view('parent.client-table');
    }

    public function form($id = null)
    {
        return view('parent.client-form', ['id' => $id]);
    }
}
