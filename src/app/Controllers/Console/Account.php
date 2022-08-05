<?php
 
declare(strict_types=1);
 
namespace App\Controllers\Console;
  
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Controllers\BaseController;

// model
use App\Models\AccountModel;

class Account extends BaseController
{
    private $account;
    private $viewPath;

    /**
     * コンストラクタ
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // モデルロード
        $this->account = new AccountModel();

        // ビューパスを取得
        $this->viewPath = $this->module . '/' . $this->controller . '/' . $this->method . '.php';
    }

    /**
     * ユーザー一覧画面
     */
    public function index()
    {
        // ログインかつ管理者確認
        if($_SESSION['session']['role'] === ROLE_ADMIN) {
            // ユーザー一覧取得
            $accountList = $this->account->getAccountList();
            
            // データを配列に格納
            $accountView = [
                'accounts'     => $accountList,
                'errorMessage' => []
            ];

            echo view('Console/account/index', $accountView);
        } else {
            // ログインかつ管理者でなければ戻る
            return redirect()->to('Console/login/index');
        }
    }

    /**
     * ユーザー新規作成画面/編集画面
     *
     * @param  int   $id ユーザーID
     */
    public function new($id = NULL)
    {
        if($_SESSION['session']['role'] === ROLE_ADMIN) {
            if ($id === NULL) {
                // 新規作成画面
                echo view('Console/account/new', [
                    'data' => [
                        'id'       => NULL,
                        'name'     => NULL,
                        'email'    => NULL,
                        'password' => NULL,
                        'role'     => NULL
                    ],
                    'errorMessage' => []
                    ]);
            } else {
                // 編集画面
                $info = $this->account->getAccount((int)$id);
                
                $data['id']          = $info['id'];
                $data['name']        = $info['name'];
                $data['email']       = $info['email'];
                $data['password']    = $info['password'];
                $data['role']        = $info['role'];
                
                echo view('Console/account/new', [
                    'data' => $data,
                    'errorMessage' => []
                ]);
            }
        } else {
            // ログインかつ管理者でなければ戻る
            return redirect()->to('Console/login/index');
        }
    }

    /**
     * ユーザー登録/編集
     */
    public function create()
    {        
        // ログインかつ管理者確認
        if($_SESSION['session']['role'] === ROLE_ADMIN) {
            // post取得
            $data = $this->request->getPost();

            // ユーザーID 空か確認
            if (empty($data['id'])) {
                // ユーザーID 空の場合
                // 空のID削除
                unset($data['id']);
                
                // チェックボックス確認
                if (array_key_exists('role', $data) === false ) {
                    $data['role'] = '';
                    // $errorCount ++;
                } else if ($data['role'][0] === '管理者') {
                    $data['role'] = 1;
                } else {
                    $data['role'] = 2;
                };
                
                // 入力チェック
                $checkResult = $this->checkInput($data, 'account');
                if (empty($checkResult) === true) {
                    // 新規登録 入力チェック通過
                    // 暗号化
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // 登録時間追加
                    $data['create_at'] = date('Y-m-d H:i:s');
                    
                    // データ保存            
                    $this->account->createAccount($data);

                    $this->session->setFlashdata('createSucces', '作成が完了しました');
                    
                    // ユーザー一覧遷移
                    return redirect()->to('Console/account/index');
                } else {
                    $data['id'] = '';

                    // 新規登録　入力チェックエラー
                    $accountView = [
                        'data'         => $data,
                        'errorMessage' => $checkResult
                    ];

                    // エラー文表示
                    echo view('Console/account/new.php', $accountView);
                };
            } else {
                // ユーザーIDがある場合
                // 編集登録

                // 権限確認
                if ($data['role'][0] === '管理者') {
                    $data['role'] = 1;
                } else {
                    $data['role'] = 2;
                };

                // パスワード入力確認
                if ($data['password'] === '') {
                    // パスワード変更無しの場合
                    // 入力チェック
                    $checkResult = $this->checkInput($data, 'editAccount');
                    if (empty($checkResult) === true) {
                        // 入力チェック通過
                        // 編集データ格納 
                        $params = [
                            'name'      => $data['name'],
                            'email'     => $data['email'],
                            'role'      => $data['role'],
                            'update_at' => date('Y-m-d H:i:s')
                        ];
                        
                        // クエリ検索ID
                        $target = [
                            'id'        => $data['id']
                        ];
                        
                        // クエリ実行
                        $this->account->edit('user', $params, $target);

                        $this->session->setFlashdata('createSucces', '編集が完了しました');
                        
                        // ユーザー一覧遷移
                        return redirect()->to('Console/account/index');
                    } else {
                        // エラー表示
                        // 編集登録 入力チェックエラー
                        $accountView = [
                            'data'         => $data,
                            'errorMessage' => $checkResult
                        ];
                        
                        // エラー文表示
                        echo view('Console/account/new.php', $accountView);
                    }
                } else {
                    // 入力チェック
                    // パスワード変更有りの場合
                    $checkResult = $this->checkInput($data, 'editPassword');
                    if (empty($checkResult)) {
                        // 編集データ格納
                        $params = [
                            'name'      => $data['name'],
                            'email'     => $data['email'],
                            'password'  => password_hash($data['password'], PASSWORD_DEFAULT),
                            'role'      => $data['role'],
                            'update_at' => date('Y-m-d H:i:s')
                        ];
                        
                        // クエリ検索ID
                        $target = [
                            'id'       => $data['id']
                        ];
                        
                        // クエリ実行
                        $this->account->edit('user', $params, $target);
                        
                        // ユーザー一覧遷移
                        return redirect()->to('Console/account/index');
                    } else {
                        // エラー表示
                        // 編集登録 入力チェックエラー
                        $accountView = [
                            'data'         => $data,
                            'errorMessage' => $checkResult
                        ];
                        
                        // エラー文表示
                        echo view('Console/account/new.php', $accountView);
                    }
                }
            }
        } else {
            // ログインかつ管理者でなければ戻る
            return redirect()->to('Console/login/index');
        }
    }

     /**
     * ユーザー削除
     *
     * @param int $id ユーザーID
     */
    public function delete(int $id) 
    {
        // ログインかつ管理者確認
        if($_SESSION['session']['role'] === ROLE_ADMIN) {
            // ユーザーID 配列格納
            $traget = [
                'id' => $id
            ];
            
            // クエリ実行
            $this->account->del('user', $traget);

            $this->session->setFlashdata('createSucces', '削除しました');
            
            // ユーザー一覧遷移
            return redirect()->to('Console/account/index');
        } else {
            // ログインかつ管理者でなければ戻る
            return redirect()->to('Console/login/index');

        }
    }

    /**
    * 入力チェック処理
    *
    * @param  array  $data  入力配列
    * @param  string $mode  モード
    * @return mixed  結果
    */
    private function checkInput(array $data, string $mode): mixed
    {
        // バリデートサービスを取得
        $validation = \Config\Services::validation();
 
        // バリデートルールをグループから選択
        $validation->run($data, $mode);
        return $validation->getErrors();
    }

}