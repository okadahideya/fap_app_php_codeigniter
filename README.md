# 目次
 - 概要
 - 機能
 - 使用技術
 - 追加課題

## 概要
FAQアプリの開発 
 - 管理者側で利用者アカウント作成
 - 一問一答
 - カテゴリ検索

## 機能
 - ユーザー(管理者)
  - 利用者作成
  - 利用者編集
  - 利用者削除
  - ユーザー一覧
 - ログイン
 - FAQ
  - 質問作成
  - 質問編集
  - 質問削除
  - 回答作成
  - 回答編集
  - 回答削除
  - 質問一覧表示

## 使用技術
 - ユーザー
  - passwordは、暗号化などで保存
 - ログイン
  - セッション認証
  - cookie

# ローカル環境(Docker)
## コマンド集

マイグレーション実行
docker-compose exec faq_app_web sh -c "php spark migrate"

ロールバック実行
docker-compose exec faq_app_web sh -c "php spark migrate:rollback"

テーブル作成
docker-compose exec faq_app_web sh -c "php spark migrate:create テーブル名"

シーダー作成
docker-compose exec faq_app_web sh -c "php spark make:seeder シーダー名"

シーダー実行
docker-compose exec faq_app_web sh -c "php spark db:seed シーダー名"

コントローラー作成
docker-compose exec faq_app_web sh -c "php spark make:controller コントローラクラス名"

モデル作成
docker-compose exec faq_app_web sh -c "php spark make:model モデル名"
