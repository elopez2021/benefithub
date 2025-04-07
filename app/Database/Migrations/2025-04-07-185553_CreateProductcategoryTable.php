<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductcategoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id'  => ['type' => 'INT', 'null' => false],
            'category_id' => ['type' => 'INT', 'null' => false],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addForeignKey('product_id', 'products', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'restaurant_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('product_category');
    }

    public function down()
    {
        $this->forge->dropTable('product_category');
    }
}
