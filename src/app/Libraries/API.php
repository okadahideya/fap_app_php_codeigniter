<?php

namespace App\Libraries;

class API
{
    const GET_METHOD              = 'GET';
    const POST_METHOD             = 'POST';
    const PUT_METHOD              = 'PUT';
    const DELETE_METHOD           = 'DELETE';

    private $ch;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // CURLインスタンスを生成
        $this->ch = curl_init();
    }

    /**
     * デストラクタ
     */
    public function __destruct()
    {
        // CURLインスタンスを閉じる
        curl_close($this->ch);
    }

    /**
     * CURL実行
     *
     * @param  string  $url     URLリソース
     * @param  string  $method  メソッド
     * @param  array   $params  送信パラメータ
     * @param  string  $mode    モード（form：x-www-form-urlencoded形式、json：JSON形式）
     * @param  array   $headers ヘッダ属性の配列
     * @return array   レスポンス情報
     */
    public function execute(string $url, string $method = self::GET_METHOD, array $params = [], string $mode = 'form', array $headers = []): array
    {
        $method = strtoupper($method);

        $httpHeader = [];
        switch (strtolower($mode)) {
            case 'json':
                $httpHeader[] = 'Content-Type: application/json';
                break;
            case 'form':
            default:
                $httpHeader[] = 'Content-Type: application/x-www-form-urlencoded';
                break;
        }
        if (!empty($headers)) {
            $httpHeader = array_merge($httpHeader,$headers);
        }

        // CURLオプション
        if (ENVIRONMENT === 'development' || ENVIRONMENT === 'testing') {
            $options = [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_CUSTOMREQUEST  => $method,
                CURLOPT_HTTPHEADER     => $httpHeader
            ];
        } else {
            $options = [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_CUSTOMREQUEST  => $method,
                CURLOPT_HTTPHEADER     => $httpHeader
            ];
        }

        // メソッド毎にパラメータを付与
        switch ($method) {
            case self::GET_METHOD:
                if (!empty($params)) {
                    $options[CURLOPT_URL] .= '?'. http_build_query($params);
                }
                break;
            case self::POST_METHOD:
            case self::PUT_METHOD:
                switch ($mode) {
                    case 'json':
                        $options[CURLOPT_POSTFIELDS] = json_encode($params);
                        break;
                    case 'form':
                    default:
                        $options[CURLOPT_POSTFIELDS] = http_build_query($params);
                        break;
                }
                break;
            default:
                break;
        }
        // オプションを設定
        curl_setopt_array($this->ch, $options);

        try {
            // CURL実行
            $response = curl_exec($this->ch);
            if ($response === false) {
                log_message('error', __FILE__ . '(' . __LINE__ . '): ' . curl_error($this->ch));
            }

            // HTTPステータスコードを取得
            $httpCode = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        } catch (\Exception $e) {
            log_message('error', __FILE__ . '(' . __LINE__ . '): ' . $e->getCode() . ' : ' . $e->getMessage());
        }

        return ['http_code' => $httpCode, 'response' => $response];
    }
}
