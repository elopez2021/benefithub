<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BusinessController extends BaseController
{
    public function index()
    {
        return view('dashboard/business/index');
    }
}
