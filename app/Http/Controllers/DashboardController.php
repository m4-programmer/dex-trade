<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function index()
    {
        return view('theme2.user.dashboard');
    }
}
