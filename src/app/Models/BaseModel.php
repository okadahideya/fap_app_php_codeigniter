<?php

namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model
{
    //protected $db;
    //protected $DBGroup = ENVIRONMENT;


    /**
     * トランザクション開始
     */
    public function beginTransaction()
    {
        return $this->db->transBegin();
    }


    /**
     * コミット実行
     */
    public function commit()
    {
        return $this->db->transCommit();
    }


    /**
     * ロールバック実行
     */
    public function rollback()
    {
        return $this->db->transRollback();
    }


    /**
     * 登録処理
     *
     * @param  string  $table
     * @param  array   $params
     * @return boolean false：失敗、true：成功
     */
    public function create(string $table, array $params): bool
    {
        $result = $this->db->table($table)->insert($params);
        return !empty($result) ? true : false;
    }

    /**
     * 登録処理(エスケープオプションあり)
     *
     * @param  string  $table
     * @param  array   $params
     * @param  array   $options
     * @return boolean false：失敗、true：成功
     */
    public function createWithOptions(string $table, array $params, array $options): bool
    {
        $builder = $this->db->table($table);

        foreach ($params as $column => $value) {
            $builder->set($column, $value, !(isset($options[$column]) && $options[$column] === false));
        }

        $result = $builder->insert();
        return !empty($result) ? true : false;
    }

    /**
     * 一括登録処理
     *
     * @param  string  $table
     * @param  array   $params
     * @param  int     $batchSize   一度に一括登録する数
     * @return boolean false：失敗、true：成功
     */
    public function createBatch(string $table, array $params, ?int $batchSize): bool
    {
        $result = $this->db->table($table)->insertBatch($params, null, $batchSize);
        return !empty($result) ? true : false;
    }


    /**
     * 更新処理
     *
     * @param  string  $table
     * @param  array   $params
     * @param  array   $target
     * @return boolean false：失敗、true：成功
     */
    public function edit(string $table, array $params, ?array $target): bool
    {
        $result = $this->db->table($table)->update($params, $target);
        return !empty($result) ? true : false;
    }

    /**
     * 更新処理(エスケープオプションあり)
     *
     * @param  string  $table
     * @param  array   $params
     * @param  array   $target
     * @param  array   $options
     * @return boolean false：失敗、true：成功
     */
    public function editWithOptions(string $table, array $params, ?array $target, array $options): bool
    {
        $builder = $this->db->table($table);

        foreach ($params as $column => $value) {
            $builder->set($column, $value, !(isset($options[$column]) && $options[$column] === false));
        }
        $builder->where($target);

        $result = $builder->update();
        return !empty($result) ? true : false;
    }


    /**
     * 削除処理
     *
     * @param  string  $table
     * @param  array   $target
     * @return boolean false：失敗、true：成功
     */
    public function del(string $table, ?array $target): bool
    {
        $data  = [];
        $where = '';
        foreach ($target as $key => $val) {
            $where .= !empty($where) ? "AND " : "WHERE ";
            $where .= "`" . $key . "` = :" . $key . ": ";
            $data[$key] = $val;
        }

        $sql = "DELETE FROM "
             . $table . " "
             . $where;

        $this->db->query($sql,$data);
        $result = $this->db->affectedRows();
        return !empty($result) ? true : false;
    }


    /**
     * テーブル削除、再作成処理
     *
     * @param  string  $table
     * @return boolean false：失敗、true：成功
     */
    public function truncate(string $table): bool
    {
        $result = $this->db->table($table)->truncate();
        return !empty($result) ? true : false;
    }


    /**
     * インサートID取得
     *
     * @return int  インサートID
     */
    public function insertId()
    {
        return $this->db->insertID();
    }

}