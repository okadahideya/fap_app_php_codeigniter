<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected  $session     = null;
    protected  $module      = null;
    protected  $controller  = null;
    protected  $method      = null;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     * 
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param LoggerInterface   $logger
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $router           = service('router');
        $controllers      = explode('\\', strtolower(trim(str_replace(__NAMESPACE__, '', $router->controllerName()), '\\')));
        $this->module     = !empty($controllers[1]) ? $controllers[0] : '';
        $this->controller = !empty($controllers[1]) ? $controllers[1] : $controllers[0];
        $this->method     = $router->methodName();

        // セッションサービスをロード
        $this->session = \Config\Services::session();

        // サインイン判定
        $this->isSignIn();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * サインイン判定
     * 
     * @param   void
     * @return  void
     */
    private function isSignIn()
    {
        // 認証後ページか判定
        if (!in_array($this->module . '/' . $this->controller . '/' . $this->method, UNAUTH_CONSOLE_LIST)) {
            // ログイン情報の保持を確認
            try {
                $result = isset($_SESSION['session']);
                if (!$result) {
                    throw new \Exception('session is expired.');
                }
            } catch (\Exception $e) {
                log_message('error', $e->getMessage());
                // ログイン画面へ遷移
                redirect()->to('/' . $this->module . '/login')->send();
                exit;
            }
        }
    }
}
