<?php

namespace App\Models;

use CodeIgniter\Model;

class RestaurantModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'user_id',
        'commercial_name',
        'rnc',
        'phone',
        'address',
        'province',
        'active'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    
    protected $validationRules = [
        'user_id' => 'required|numeric',
        'commercial_name' => 'required|max_length[100]',
        'rnc' => 'required|exact_length[9]|is_unique[restaurants.rnc]',
        'phone' => 'required|max_length[15]',
        'address' => 'required|max_length[100]',
        'province' => 'required|max_length[100]',
    ];
    protected $validationMessages = [
        'user_id' => [
            'required' => 'El ID de usuario es requerido',
            'numeric' => 'El ID de usuario debe ser numérico'
        ],
        'commercial_name' => [
            'required' => 'El nombre comercial es requerido',
            'min_length' => 'El nombre comercial debe tener al menos 5 caracteres',
            'max_length' => 'El nombre comercial no debe exceder 100 caracteres'
        ],
        'rnc' => [
            'required' => 'El RNC es requerido',
            'exact_length' => 'El RNC debe tener exactamente 9 caracteres',
            'is_unique' => 'Este RNC ya está registrado'
        ],
        'phone' => [
            'required' => 'El teléfono es requerido',
            'max_length' => 'El teléfono no debe exceder 15 caracteres'
        ],
        'address' => [
            'required' => 'La dirección es requerida',
            'max_length' => 'La dirección no debe exceder 100 caracteres'
        ],
        'province' => [
            'required' => 'La provincia es requerida',
            'max_length' => 'La provincia no debe exceder 100 caracteres'
        ],

    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    
    /**
     * Get restaurants by user ID
     */
    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function getAllRestaurants()
    {
        return $this->select('restaurants.*, users.username')
                    ->join('users', 'users.id = restaurants.user_id', 'inner')
                    ->findAll();
    }

    
    /**
     * Get active restaurants
     */
    public function getActiveRestaurants()
    {
        return $this->where('active', 1)->findAll();
    }
}


