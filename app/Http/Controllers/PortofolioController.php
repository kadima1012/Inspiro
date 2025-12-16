<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('dashboard.portofolio');
    }
}
