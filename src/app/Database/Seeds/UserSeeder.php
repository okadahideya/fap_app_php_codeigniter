<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'        => 1,
                'name'      => 'テスト',
                'email'     => 'test@gmail.com',
                'password'  => password_hash('Test@0000', PASSWORD_DEFAULT),
                'role'      => 1,
                'create_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'        => 2,
                'name'      => '田中 太郎',
                'email'     => 'tanaka@gmail.com',
                'password'  => password_hash('Tanaka@0000', PASSWORD_DEFAULT),
                'role'      => 2,
                'create_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'        => 3,
                'name'      => '鈴木 太郎',
                'email'     => 'suzuki@gmail.com',
                'password'  => password_hash('Suzuki@0000', PASSWORD_DEFAULT),
                'role'      => 2,
                'create_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
