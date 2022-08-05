<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id'        => 1,
                'user_id'   => 2,
                'title'     => 'マイグレーションにつきまして、php spark migrateを行っておりますが、エラー出ており、テーブルの作成ができません',
                'text'      => '作成手順として、srcフォルダ内にsparkファイルを確認したので、srcフォルダでコマンドを使用しました',
                'create_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'        => 2,
                'user_id'   => 2,
                'title'     => 'コントローラーからビューに動的データを付与することができません。',
                'text'      => '認識の確認なのですが、下記記述のようにコントローラーでviewメソッドを使用すれば、$accountListの変数はビューで使用できるようになりますでしょうか？',
                'create_at' => date('Y-m-d H:i:s')
            ],
            [
                'id'        => 3,
                'user_id'   => 3,
                'title'     => 'MVCを使用して、ユーザー一覧情報を表示したいのですが、ContorollerのAccont.phpで、エラーが発生します。データベース接続をインスタンス化した際に発生します。どういった記述を行えばよろしいでしょうか？',
                'text'      => '作成手順として、srcフォルダ内にsparkファイルを確認したので、srcフォルダでコマンドを使用しました',
                'create_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('question')->insertBatch($data);
    }
}
