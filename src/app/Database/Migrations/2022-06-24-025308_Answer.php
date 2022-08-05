<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Answer extends Migration
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
            'question_id' => [
                'type'           => 'INT'
            ],
            'text' => [
                'type'           => 'text'
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
            $this->forge->createTable('answer');
}

    public function down()
    {
        $this->forge->dropTable('answer');
    }
}
