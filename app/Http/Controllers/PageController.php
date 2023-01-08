<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return view('main');
    }

    public function about()
    {
        return view('about');
    }

    public function service()
    {
        return view('service');
    }

    public function projects()
    {
        return view('projects');
    }

















    public function welcome()
    {
        return view('welcome', [
            "name" => "John",
            "records" => [1, 2, 3]
        
        ]);
    }
}
