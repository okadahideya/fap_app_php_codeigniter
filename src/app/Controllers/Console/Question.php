<?php

declare(strict_types=1);

namespace App\Controllers\Console;

use App\Controllers\BaseController;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// model
use App\Models\QuestionModel;
use App\Models\AnswerModel;

class Question extends BaseController
{
    private $question;
    private $answer;
    private $viewPath;

    /**
     * コンストラクタ
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // モデルロード
        $this->question = new QuestionModel();
        $this->answer   = new AnswerModel();

        // ビューパスを取得
        $this->viewPath = $this->module . '/' . $this->controller . '/' . $this->method . '.php';
    }

     /**
     * 質問投稿一覧画面
     */
    public function index()
    {
        // 検索確認
        $search = $this->request->getPost();
        
        // 初期化　検索データ
        $search['title'] = !empty($search['title']) ? $search['title'] : '';
        $search['role']  = !empty($search['role'])  ? $search['role']  : '';
        $search['text']  = !empty($search['text'])  ? $search['text']  : '';
        
        // 検索結果 取得
        $searchResult = $this->question->getList($search);
        
        $questionView = [
            'search'    => $search,
            'questions' => $searchResult
        ];
        
        echo view('Console/question/index', $questionView);
    }

    /**
    * 質問新規作成画面/編集画面
    */
    public function new(int $id = NULL)
    {
        // question_idチェック
        if(empty($id)){
            // 新規作成画面
            echo view('Console/question/new', [
                'question' => [
                    'id'    => '',
                    'title' => '',
                    'text'  => ''
                ],
                'errorMessage' => []
            ]);
        } else {
            // 編集画面
            $questionInfo = $this->question->get($id);
            echo view('Console/question/new', [
                'question' => [
                    'id'    => $questionInfo['id'],
                    'title' => $questionInfo['title'],
                    'text'  => $questionInfo['text']
                ],
                'errorMessage' => []
            ]);
        }
    }

     /**
     * 質問投稿 新規投稿/編集
     */
    public function create()
    {
        // データ取得
        $data = $this->request->getPost();

        if(!empty($data)){
            // IDチェック
            if(empty($data['id'])) {
                // 入力チェック
                $checkResult = $this->checkInput($data, 'questionCreate');
                if(empty($checkResult) === true) {
                    $questionData = [
                        'user_id'   => $_SESSION['session']['id'],
                        'title'     => $data['title'],
                        'text'      => $data['text'],
                        'create_at' => date('Y-m-d H:i:s') 
                    ];
                    
                    // データ保存
                    $this->question->create('question', $questionData);

                    $this->session->setFlashdata('createSucces', '質問を投稿しました');

                    return redirect()->to('Console/question/index');
                } else {
                    // 入力チェックエラー
                    $questionView = [
                        'question'     => $data,
                        'errorMessage' => $checkResult
                    ];

                    echo view('Console/question/new', $questionView);
                }
            } else {
                // 入力チェック
                $checkResult = $this->checkInput($data, 'questionCreate');
                if(empty($checkResult) === true) {
                    // 編集データ格納 
                    $params = [
                        'title'     => $data['title'],
                        'text'      => $data['text'],
                        'update_at' => date('Y-m-d H:i:s')
                    ];

                    // クエリ検索ID
                    $target = [
                        'id'        => $data['id']
                    ];
                    
                    // クエリ実行
                    $this->question->edit('question', $params, $target);


                    $this->session->setFlashdata('createSucces', '編集が完了しました');

                    return redirect()->to('Console/question/index');
                } else {
                    // 入力チェックエラー
                    $questionView = [
                        'question'     => $data,
                        'errorMessage' => $checkResult
                    ];

                    echo view('Console/question/new', $questionView);
                }
            }
        } else {
            return redirect()->to('/Console/login/index');
        }
    }

     /**
     * 質問投稿詳細 
     * 
     * @param  int   $id 質問ID
     */
    public function show(int $id)
    {
        // 質問詳細取得
        $questionInfo = $this->question->get($id);

        // 回答情報取得
        $answerInfo   = $this->answer->getList($id);
        
        $questionView = [
            'questions' => $questionInfo,
            'answers'   => $answerInfo
        ];
        
        echo view('Console/question/show', $questionView);
    }

     /**
     * 質問投稿削除 
     * 
     * @param  int   $id 質問ID
     */
    public function delete(int $id)
    {
        $questionInfo = $this->question->get($id);

        if($questionInfo['user_id'] === $_SESSION['session']['id']){

            $traget = [
                'id' => $id
            ];
            
            $this->question->del('question', $traget);
            
            $this->session->setFlashdata('createSucces', '削除しました');
            
            // ユーザー一覧遷移
            return redirect()->to('Console/question/index');
        } else {
            return redirect()->to('/Console/login/index');
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
