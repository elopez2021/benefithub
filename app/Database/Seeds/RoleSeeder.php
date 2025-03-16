<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'admin'],
            ['name' => 'employee'],
            ['name' => 'business'],	
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
