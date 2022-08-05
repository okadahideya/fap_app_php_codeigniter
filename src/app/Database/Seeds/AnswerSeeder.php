<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AnswerSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'user_id'       => 3,
                'question_id'   => 1,
                'text'          => '回答テスト111111',
                'role'          => 2,
                'create_at'     => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 2,
                'user_id'       => 3,
                'question_id'   => 2,
                'text'          => '回答テスト2222222',
                'role'          => 2,
                'create_at'     => date('Y-m-d H:i:s')
            ],
            [
                'id'            => 3,
                'user_id'       => 1,
                'question_id'   => 2,
                'text'          => '回答テスト3333333',
                'role'          => 1,
                'create_at'     => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('answer')->insertBatch($data);
    }
}
