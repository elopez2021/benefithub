<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table            = 'employees';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'first_name',
        'last_name',
        'id_number',
        'subsidy_left_today',
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
        'first_name' => [
            'label' => 'Nombre',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
                'max_length' => 'El {field} no debe exceder los 100 caracteres'
            ]
        ],
        'last_name' => [
            'label' => 'Apellido',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
                'max_length' => 'El {field} no debe exceder los 100 caracteres'
            ]
        ],
        'id_number' => [
            'label' => 'Cédula',
            'rules' => 'required|max_length[20]|is_unique[employees.id_number,id,{id}]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
                'max_length' => 'La {field} no debe exceder los 20 caracteres',
                'is_unique' => 'Esta {field} ya está registrada'
            ]
        ],
        'user_id' => [
            'label' => 'Usuario',
            'rules' => 'permit_empty|is_not_unique[users.id]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio',
                'is_not_unique' => 'El {field} seleccionado no existe'
            ]
        ],
        'active' => [
            'label' => 'Activo',
            'rules' => 'permit_empty|in_list[0,1]',
            'errors' => [
                'in_list' => 'El estado activo debe ser 0 o 1'
            ]
        ],
        'subsidy_left_today' => [
            'label' => 'Subsidio',
            'rules' => 'permit_empty|decimal',
            'errors' => [
                'decimal' => 'El {field} debe ser un número decimal'
            ]
        ]
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
