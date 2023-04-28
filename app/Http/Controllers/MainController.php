<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    public function dashboard()
    {
        return view('parent.dashboard');
    }

    public function calendar()
    {
        return view('parent.calendar');
    }
}
