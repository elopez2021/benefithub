<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function about()
    {
        return view('about');
    }

}
