<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is logged in
        if (!session()->has('role_id')) {
            return redirect()->to(base_url('login'))->with('error', 'Debes iniciar sesión para acceder.');
        }

        // Get the user's role from the session
        $role_id = session()->get('role_id');
        $route = uri_string(); // Get the current route without base_url()

        // Check access based on role
        if (strpos($route, 'admin') === 0 && $role_id != 1) {
            return redirect()->to(base_url('login'))->with('error', 'Acceso no permitido.');
        }
        
        if (strpos($route, 'employee') === 0 && $role_id != 2) {
            return redirect()->to(base_url('login'))->with('error', 'Acceso no permitido.');
        }
        
        if (strpos($route, 'business') === 0 && $role_id != 3) {
            return redirect()->to(base_url('login'))->with('error', 'Acceso no permitido.');
        }
        
        if (strpos($route, 'restaurant') === 0 && $role_id != 4) {
            return redirect()->to(base_url('login'))->with('error', 'Acceso no permitido.');
        }
        
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Not needed for this filter
    }
}


?>