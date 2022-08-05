<?php

namespace App\Libraries;

use App\Controllers\BaseController;

class Login extends BaseController
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        //
    }


    /**
     * ログインチェック
     *
     * @param  string  $module モジュール名
     * @return void
     */
    public function check($module = '')
    {
        // セッション情報を取得
        $session = $this->session->userdata($module);
        // セッション情報がない場合でログインコントローラ以外であればログイン画面へ遷移
        switch ($module) {
            case 'console':
                // 現在のURIを取得
                $currentUri = $this->module . '/' . $this->controller . '/*';

                switch ($currentUri) {

                    default:
                        $roles = [];
                        break;
                }
                if ((empty($session['account_id']) && $currentUri != $this->module . '/login/*') || (!empty($session['role']) && !empty($roles) && !in_array($session['role'], $roles))) {
                    redirect($this->module . '/login/index');
                }
                break;
            default:
                break;
        }
    }
}