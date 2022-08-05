<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\BaseModel;

class QuestionModel extends BaseModel
{
    /**
    * コンストラクタ
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * 質問詳細 取得
    * 
    * @param  int   $id 質問ID
    * @return array 質問投稿詳細 取得
    */
    public function get(int $id): array
    {
        // question id取得
        $data['id'] = $id;

        $sql  = "SELECT "
            .     "`user`    .`id` AS `user_id`,"
            .     "`user`    .`name`, "
            .     "`question`.`id`, "
            .     "`question`.`title`, "
            .     "`question`.`text`, "
            .     "`question`.`create_at` "
            . "FROM "
            .     "`question` "
            . "INNER JOIN "
            .     "`user` "
            . "ON "
            .     "`question`.`user_id` = `user`.`id` "
            . "WHERE "
            .     "`question`.`id` = :id: "
            . "; ";

        $query = $this->db->query($sql, $data);
        return $query->getRowArray();
    }

    /**
     * 検索機能
     * 
     * @param  $search 検索データ取得
     * @return array 検索結果取得
     */
    public function getList($search):array
    {
        $data        = [];
        $where       = [];

        // ベストアンサーチェック
        if (!empty($search['role']) && $search['role'] === 'ベストアンサー') {
            $search['role'] = (int)ROLE_ADMIN;
        }
        if (!empty($search['role']) && $search['role'] === (int)ROLE_ADMIN) {
            $data['role'] = $search['role'];
            $where[]      = "`answer`.`role` = :role: ";
        }

        // 回答チェック
        if (!empty($search['text']) && $search['text'] === '回答') {
            $having[] =  "`is_answer` = 1 ";
        }

        // タイトルチェック
        if (!empty($search['title'])) {
            $data['title'] = '%' . $search['title'] . '%';
            $where[] = "`question`.`title` LIKE :title: ";
        }

        $sql = "SELECT"
            .     "`user`    .`name`, "
            .     "`question`.`id`, "
            .     "`question`.`title`, "
            .     "CASE WHEN min(`answer`.`role`) = 1 AND count(`answer`.`text`) > 0 THEN 1 ELSE 0 END as `is_best_answer` ,"
            .     "CASE WHEN count(`answer`.`id`) > 0 THEN 1 ELSE 0 END as `is_answer`, "
            .     "`question`.`create_at` "
            . "FROM "
            .     "`question` "
            . "JOIN "
            .     "`user` "
            . "ON "
            .     "`question`.`user_id` = `user`.`id` "
            . "LEFT JOIN "
            .     "`answer` "
            . "ON "
            .     "`question`.`id` = `answer`.`question_id` "
            . (!empty($where) ? "WHERE" . implode("AND", $where) : '')
            . "GROUP BY"
            .     "`question`.`id` "
            . (!empty($having) ?  "HAVING" . implode($having) : '')
            . "ORDER BY "
            .     "`question`.`create_at` DESC "
            . ";";

        $query = $this->db->query($sql, $data);
        return $query->getResultArray();
    }
}
