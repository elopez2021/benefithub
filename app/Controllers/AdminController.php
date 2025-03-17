<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index()
    {
        // Access the authenticated user
        //$user = $this->request->user;
        /*
        if ($user['role_id'] !== 1) {
            // Redirect non-admin users to an unauthorized page or login page
            return redirect()->to('unauthorized');
        }
            */
        return view('dashboard/admin/index');
    }
}
