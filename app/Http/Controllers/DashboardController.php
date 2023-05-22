<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Myapps',
            'desc' => 'Aplikasi e-planning untuk kalangan sendiri',
        ]);
    }

    public function maintenance(Request $request)
    {
        return $request->all();
    }
}
