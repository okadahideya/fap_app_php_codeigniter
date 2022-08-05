<?php

declare(strict_types=1);

namespace App\Models;
 
use App\Models\BaseModel;
 
class AccountModel extends BaseModel
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * ユーザー情報取得
     *
     * @param  string   $id    ユーザーID
     * @return array           詳細情報
     */
    public function getAccount(int $id): ?array
    {
        $data['id'] = $id;  // ユーザーID

        $sql  = "SELECT "
        .     "`*`"
        . "FROM "
        .     "`user` "
        . "WHERE "
        .     "`id` = :id: "
        . "; ";
 
        $query = $this->db->query($sql, $data);
        return $query->getRowArray();
    }

    /**
     * ユーザー新規登録
     *
     * @param $data ユーザー登録情報
     */
    public function createAccount($data)
    { 
        // データ格納
        $results = [
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'role'      => $data['role'],
            'create_at' => $data['create_at']
        ];

        // 登録処理
        $this->create('user', $results);
    }
 
    /**
     * 一覧取得
     *
     * @return array       ユーザー一覧
     */
    public function getAccountList(): array
    {
        $query = $this->db->query('select id, name, email, role from user');
        return $query->getResultArray();
    }

    /**
     * 認証アドレス取得
     * @param  string $email アドレス取得
     * @return array  ユーザー本人情報
     */
    public function getAuth(string $email): ?array
    {
        $auth['email'] = $email;
    
        $sql = "SELECT"
            .       "`id` ,"
            .       "`name` ,"
            .       "`email` ,"
            .       "`password` ,"
            .       "`role`"
            .  "FROM" 
            .       "`user`"
            .  "WHERE"
            .       "`email` = :email:"
            .  ";";

        $query = $this->db->query($sql, $auth);
        return $query->getRowArray();
    }

}