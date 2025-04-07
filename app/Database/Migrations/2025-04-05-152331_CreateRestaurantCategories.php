<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRestaurantCategories extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true],
            'restaurant_id'    => ['type' => 'INT', 'unsigned' => true, 'null' => false],
            'name'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'description'      => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'active'           => ['type' => 'BOOLEAN', 'default' => true],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id', true); // Primary key
        $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addUniqueKey(['restaurant_id', 'name']);

        $this->forge->createTable('restaurant_categories');
    }

    public function down()
    {
        $this->forge->dropTable('restaurant_categories');
    }
}
