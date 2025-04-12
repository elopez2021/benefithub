<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table            = 'order_items';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
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
        'order_id'   => 'required|integer|is_not_unique[orders.id]',
        'product_id' => 'required|integer|is_not_unique[products.id]',
        'quantity'   => 'required|integer|greater_than[0]',
        'price'      => 'required|decimal|greater_than[0]',
        'subtotal'   => 'required|decimal|greater_than_equal_to[0]',
    ];
    
    protected $validationMessages = [
        'order_id' => [
            'required'      => 'El campo de orden es obligatorio.',
            'integer'       => 'El ID de la orden debe ser un número entero.',
            'is_not_unique' => 'La orden especificada no existe.',
        ],
        'product_id' => [
            'required'      => 'El campo de producto es obligatorio.',
            'integer'       => 'El ID del producto debe ser un número entero.',
            'is_not_unique' => 'El producto especificado no existe.',
        ],
        'quantity' => [
            'required'      => 'La cantidad es obligatoria.',
            'integer'       => 'La cantidad debe ser un número entero.',
            'greater_than'  => 'La cantidad debe ser mayor que cero.',
        ],
        'price' => [
            'required'      => 'El precio es obligatorio.',
            'decimal'       => 'El precio debe ser un número decimal válido.',
            'greater_than'  => 'El precio debe ser mayor que cero.',
        ],
        'subtotal' => [
            'required'                => 'El subtotal es obligatorio.',
            'decimal'                 => 'El subtotal debe ser un número decimal válido.',
            'greater_than_equal_to'  => 'El subtotal no puede ser negativo.',
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

    public function getItemsByOrder($orderId)
    {
        return $this->where('order_id', $orderId)
                   ->join('products', 'products.id = order_items.product_id')
                   ->findAll();
    }
}
