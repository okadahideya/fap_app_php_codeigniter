<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->db->transBegin();

        $this->call('UserSeeder');
        $this->call('QuestionSeeder');
        $this->call('AnswerSeeder');

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
        } else {
            $this->db->transCommit();
        }
    }
}
