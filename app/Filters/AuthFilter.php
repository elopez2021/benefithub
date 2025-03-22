<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the user's role from the session
        $role_id = session()->get('role_id');

        // Check if the user has access to the page based on role_id
        // You can customize this logic as needed
        $route = current_url();
        
        if ($route == site_url('admin/dashboard') && $role_id != 1) {
            // If user is not an admin, redirect to a "Forbidden" page or login
            return redirect()->to(site_url('login'))->with('error', 'Acceso no permitido.');
        }

        if ($route == site_url('employee/dashboard') && $role_id != 2) {
            // If user is not an employee, redirect to a "Forbidden" page or login
            return redirect()->to(site_url('login'))->with('error', 'Acceso no permitido.');
        }

        if ($route == site_url('business/dashboard') && $role_id != 3) {
            // If user is not a business, redirect to a "Forbidden" page or login
            return redirect()->to(site_url('login'))->with('error', 'Acceso no permitido.');
        }

        // You can extend this logic further to handle more pages and roles as necessary
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // This method is not needed for this purpose
    }
}


?>