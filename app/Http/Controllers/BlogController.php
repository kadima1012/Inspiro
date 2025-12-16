<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('home.blog');
    }
}
