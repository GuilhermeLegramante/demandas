<?php

namespace App\Http\Controllers;

class DepartmentController extends Controller
{
    public function table()
    {
        return view('parent.department-table');
    }

    public function form($id = null)
    {
        return view('parent.department-form', ['id' => $id]);
    }
}
