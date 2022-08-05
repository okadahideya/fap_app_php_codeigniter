<?php

namespace App\Validation;

class CustomRules
{
    /**
     * パスワードポリシーチェック
     *
     * @param  string $password パスワード
     * @return bool
     */
    public function passwordPolicy(string $password): bool
    {
        // 英大文字 英小文字 記号 数字 8文字以上
        if (!preg_match('/\A(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[#%$&@\-,])[a-zA-Z\d#%$&@\-,]{8,}\z/', $password)) {
            return false;
        }
        return true;
    }
}
