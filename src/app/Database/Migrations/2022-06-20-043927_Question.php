<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Question extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_id' => [
                'type'           => 'INT'
            ],
            'title' => [
                'type'           => 'VARCHAR',
                'constraint'     => 128
            ],
            'text' => [
                'type'           => 'text'
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
        $this->forge->createTable('question');
    }

    public function down()
    {
        $this->forge->dropTable('question');
    }
}
