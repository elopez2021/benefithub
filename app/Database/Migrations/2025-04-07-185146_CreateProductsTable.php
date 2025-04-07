<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'auto_increment' => true],
            'restaurant_id' => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 100],
            'description'   => ['type' => 'TEXT', 'null' => true],
            'price'         => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'active'        => ['type' => 'BOOLEAN', 'default' => true],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
