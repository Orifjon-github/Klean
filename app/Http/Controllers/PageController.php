<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('main');
    }

    public function welcome()
    {
        return view('welcome', [
            "name" => "John",
            "records" => [1, 2, 3]
        
        ]);
    }
}
