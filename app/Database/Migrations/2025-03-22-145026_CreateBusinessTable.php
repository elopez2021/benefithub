<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBusinessTable extends Migration
{
    public function up()
    {
        // Creating the businesses table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'legal_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'rnc' => [
                'type'       => 'VARCHAR',
                'constraint' => '9',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'daily_subsidy' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'province' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'address' => [
                'type'       => 'TEXT',
            ],
            'status' => [
                'type'       => 'TINYINT',
                'constraint' => 1,  // Values can be 0 or 1
                'default'    => 1,  // Default is active (1)
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        // Setting the primary key
        $this->forge->addPrimaryKey('id');

        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        // Create the table
        $this->forge->createTable('businesses');
    }

    public function down()
    {
        // Drop the table if the migration is rolled back
        $this->forge->dropTable('businesses');
    }
}
