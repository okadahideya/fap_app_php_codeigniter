<?php

declare(strict_types=1);

namespace App\Controllers\Console;

namespace App\Controllers\Console;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// model
use App\Models\QuestionModel;
use App\Models\AnswerModel;


class Answer extends BaseController
{
    private $answer;
    private $question;
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
     * 回答新規作成
     */
    public function new()
    {
        // get クエリパラメータ取得
        $get = $this->request->getGet();

        // 質問詳細取得
        $question = $this->question->get((int)$get['question_id']);
        
        $answerView = [
            'questions'    => $question,
            'answer'       => [
                'id'   => '',
                'text' => ''
            ],
            'errorMessage' => []
            ] ;
            
            echo view('Console/answer/new', $answerView);
    }

     /**
     * 回答編集
     * 
     * @param int $answerId 回答ID
     */
    public function edit(int $answerId)
    {
        // get クエリパラメータ取得
        $get = $this->request->getGet();
    
        // 質問詳細取得
        $question = $this->question->get((int)$get['question_id']);
        
        // 回答情報取得
        $answer = $this->answer->get($answerId);
        
        $answerView = [
            'questions'    => $question,
            'answer'       => $answer,
            'errorMessage' => []
            ] ;
            
            echo view('/Console/answer/new', $answerView);
    }

    /**
     * 回答新規作成 編集
     */
    public function create()
    {
        // 回答データ取得
        $data = $this->request->getPost();

        if(!empty($data)) {
            // 回答IDチェック
            if (empty($data['id'])) {
                // 入力チェック
                $checkResult = $this->checkInput($data, 'answerCreate');
                if(empty($checkResult) === true) {
                    $answerData = [
                        'user_id'     => $_SESSION['session']['id'],
                        'question_id' => $data['question_id'],
                        'text'        => $data['text'],
                        'role'        => $_SESSION['session']['role'],
                        'create_at'   => date('Y-m-d H:i:s')
                    ];

                    // 保存
                    $this->answer->create('answer', $answerData);
                    $this->session->setFlashdata('createSucces', '回答を作成しました');

                    return redirect()->to('Console/question/show/'.$data['question_id']);
                } else {
                    // 質問データ取得
                    $question = $this->question->get((int)$data['question_id']);

                    var_dump($data);

                    // 入力チェックエラー
                    $answerView = [
                        'questions'    => $question,
                        'answer'       => $data,
                        'errorMessage' => $checkResult
                    ];

                    echo view('Console/answer/new', $answerView);
                }
            } else {
                // 入力チェック
                $checkResult = $this->checkInput($data, 'answerCreate');
                if(empty($checkResult) === true) {
                    $params = [
                        'text'        => $data['text'],
                        'update_at'   => date('Y-m-d H:i:s')
                    ];

                    // クエリ検索ID
                    $target = [
                        'id'        => $data['id']
                    ];

                    // 編集保存
                    $this->answer->edit('answer', $params, $target);
                    $this->session->setFlashdata('createSucces', '編集しました');

                    return redirect()->to('Console/question/show/'.$data['question_id']);
                } else {
                    // 質問データ取得
                    $question = $this->question->get((int)$data['question_id']);

                    // 入力チェックエラー
                    $answerView = [
                        'questions'    => $question,
                        'answer'       => [
                            'id'       => $data['id'],
                            'text'     => $data['text']
                        ],
                        'errorMessage' => $checkResult
                    ];

                    echo view('Console/answer/new', $answerView);
                }
            }
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
