<?php

namespace App\Models;

use App\Models\BaseModel;

class AnswerModel extends BaseModel
{
    /**
    * コンストラクタ
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 回答データ1件取得
    * 
    * @param  int  $answerId  回答ID
    * @return array
    */
    public function get(int $answerId):array
    {
        $data['id'] = $answerId;

        $sql  = "SELECT "
        .     "`answer`.`id`, "
        .     "`answer`.`text` "
        . "FROM "
        .     "`answer` "
        . "WHERE "
        .     "`answer`.`id` = :id: "
        . "; ";

        $query = $this->db->query($sql, $data);
        return $query->getRowArray();
    }

    /**
     * 回答データ 複数取得
     * 
     * @param  int  $id 質問ID
     * @return array
     */
    public function getList(int $questionId):array
    {
        $data['id'] = $questionId;

        $sql  = "SELECT "
        .     "`user`    .`name`, "
        .     "`answer`  .`id`, "
        .     "`answer`  .`user_id`, "
        .     "`answer`  .`text`, "
        .     "`answer`  .`role`, "
        .     "`answer`  .`create_at` "
        . "FROM "
        .     "`answer` "
        . "JOIN "
        .     "`question` "
        . "ON "
        .     "`question`.`id` = `answer`.`question_id` "
        . "JOIN "
        .     "`user` "
        . "ON "
        .     "`user`.`id` = `answer`.`user_id` "
        . "WHERE "
        .     "`question`.`id` = :id: "
        . "ORDER BY "
        .     "`answer`.`role`, "
        .     "`answer`.`create_at` DESC "
        . "; ";

        $query = $this->db->query($sql, $data);
        return $query->getResultArray();
    }
}
