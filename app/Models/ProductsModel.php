<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'restaurant_id',
        'name',
        'description',
        'price',
        'active',
        'created_at',	
        'updated_at',
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
        'restaurant_id' => 'required|integer|is_not_unique[restaurants.id]',
        'name'          => 'required|string|min_length[3]|max_length[100]',
        'description'   => 'permit_empty|string|max_length[500]',
        'price'         => 'required|decimal|greater_than_equal_to[50]|less_than_equal_to[10000]',
        'active'        => 'permit_empty|in_list[0,1]',
    ];
    
    protected $validationMessages = [
        'restaurant_id' => [
            'required' => 'El restaurante es obligatorio.',
            'integer' => 'El restaurante debe ser un número entero.',
            'is_not_unique' => 'El restaurante seleccionado no existe.',
        ],
        'name' => [
            'required' => 'El nombre del producto es obligatorio.',
            'string' => 'El nombre debe ser un texto válido.',
            'min_length' => 'El nombre debe tener al menos 3 caracteres.',
            'max_length' => 'El nombre no debe exceder los 100 caracteres.',
        ],
        'description' => [
            'string' => 'La descripción debe ser un texto válido.',
            'max_length' => 'La descripción no debe superar los 500 caracteres.',
        ],
        'price' => [
            'required' => 'El precio es obligatorio.',
            'decimal' => 'El precio debe tener un formato decimal válido.',
            'greater_than_equal_to' => 'El precio debe ser al menos 50.',
            'less_than_equal_to' => 'El precio no debe superar 10,000.',
        ],
        'active' => [
            'in_list' => 'El estado activo debe ser 0 (inactivo) o 1 (activo).',
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
}
