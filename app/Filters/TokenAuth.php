<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class TokenAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Get the token from the Authorization header
        $token = $request->getHeaderLine('Authorization');

        // Remove "Bearer " from the token
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        // Validate the token
        if (empty($token)) {
            return service('response')->setJSON([
                'success' => false,
                'message' => 'Token is missing',
            ])->setStatusCode(401);
        }

        // Verify the token (example: check in the database)
        $model = new UserModel();
        $user = $model->where('token', $token)->first();

        if (!$user) {
            return service('response')->setJSON([
                'success' => false,
                'message' => 'Invalid or expired token',
            ])->setStatusCode(401);
        }

        // Attach the user to the request for use in controllers
        $request->user = $user;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the response
    }
}

?>