<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductCategoryModel extends Model
{
    protected $table            = 'product_category';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'product_id',
        'category_id',
        'created_at',
        'updated_at'
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
        'product_id' => 'required|is_natural_no_zero|integer',
        'category_id' => 'required|is_natural_no_zero|integer',
    ];

    protected $validationMessages = [
        'product_id' => [
            'required' => 'El producto es obligatorio.',
            'is_natural_no_zero' => 'El ID del producto debe ser un número válido.',
        ],
        'category_id' => [
            'required' => 'La categoría es obligatoria.',
            'is_natural_no_zero' => 'El ID de la categoría debe ser un número válido.',
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
