<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    // const TABLE_NAME = 'user';

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'name' => [
                'type'           => 'VARCHAR',
                'constraint'     => 128
            ],
            'email' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            'role' => [
                'type'           => 'TINYINT',
                'constraint'     => 3,
                'unsigned'       => true
            ],
            'create_at' => [
                'type'           => 'DATETIME'
            ],
            'update_at' => [
                'type'           => 'DATETIME',
                'null'           => true
            ]
        ]);

        // primary keyを設定
        $this->forge->addKey('id', true);
        // テーブル作成
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
