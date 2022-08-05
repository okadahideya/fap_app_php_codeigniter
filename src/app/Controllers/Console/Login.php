<?php 

declare(strict_types=1);

namespace App\Controllers\Console;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\AccountModel;

class Login extends BaseController
{
    private $account;

    /**
     * コンストラクタ
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
 
        // モデルロード
        $this->account = new AccountModel();
    }

    /**
     * ログイン画面
     */
    public function index()
    {
        // 初期値
        $data = [
            'email'    => NULL,
            'password' => NULL
        ];

        // データを配列に格納
        $accountView = [
            'data'               => $data,
            'errorMessage'       => [],
            'errMessageFlash'    => ''
        ];

        echo view('Console/login/index.php', $accountView);
    }

    /**
     * ログイン認証
     */
    public function auth()
    {
        // post取得
        $data = $this->request->getPost();
        
        // ログインせずauthに遷移した場合
        if (!empty($data)) {

            // 入力チェック
            $checkResult = $this->checkInput($data, 'loginCheck');
            if (empty($checkResult) === true) {

                // ユーザー情報取得
                $accountInfo = $this->account->getAuth($data['email']);

                // メールアドレス取得確認
                if (!empty($accountInfo['email'])){

                    // メールアドレス/パスワード確認
                    if ($data['email'] == $accountInfo['email'] && password_verify($data['password'], $accountInfo['password'])) {
                        // ログイン成功
                        // ユーザー一覧取得
                        $accountList = $this->account->getAccountList();
                        
                        // セッション情報
                        $this->session->set('session',[
                            'id'   => $accountInfo['id'],
                            'name' => $accountInfo['name'],
                            'role' => $accountInfo['role']
                        ]);
                        
                        if ($_SESSION['session']['role'] === ROLE_ADMIN) {
                            // 管理者の遷移
                            return redirect()->to('Console/account/index');
                        } else {
                            // ユーザーの遷移
                            return redirect()->to('Console/question/index');
                        }
                    } else {
                        //ログイン失敗
                        // エラー文表示
                        $accountView = [
                            'data'               => $data,
                            'errorMessage'       => $checkResult,
                            'errMessageFlash'    => ''
                        ];
                        $this->session->setFlashdata('errMessageFlash', 'メールアドレスもしくはパスワードが間違っております');
                        echo view('Console/login/index.php', $accountView);
                    }
                } else {
                    //ログイン失敗
                    // エラー文表示
                    $accountView = [
                        'data'               => $data,
                        'errorMessage'       => $checkResult,
                        'errMessageFlash'    => ''
                    ];
                    $this->session->setFlashdata('errMessageFlash', 'メールアドレスもしくはパスワードが間違っております');
                    echo view('Console/login/index.php', $accountView);
                }
            } else {
                //ログイン失敗
                // エラー文表示
                $accountView = [
                    'data'               => $data,
                    'errorMessage'       => $checkResult,
                    'errMessageFlash'    => ''
                ];

                echo view('Console/login/index.php', $accountView);
            }
        } else {
            return redirect()->to('Console/login/index');
        }
    }

    /**
     * ログアウト処理
     *
     * @param  void
     * @return void
     */
    public function logout()
    {
        // セッション情報を削除
        unset($_SESSION['console']);
        // ログイン画面へリダイレクト
        return redirect()->to('Console/login/index');
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

?>