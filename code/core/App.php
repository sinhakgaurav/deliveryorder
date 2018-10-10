<?php

namespace Core;

class App {

    /**
     * Stores the controller from the split URL
     *
     * @var string
     */
    protected $controller = 'index';

    /**
     * Stores the method from the split URL
     * @var string
     */
    protected $method = 'process';

    /**
     * Stores the parameters from the split URL
     * @var array
     */
    protected $params = [];

    /**
     * working as a router for the application
     */
    public function __construct() {
        $this->authenticate();

        // Get broken up URL
        $url = $this->parseUrl();

        if(!isset($url[0])){ 
            echo json_encode([
                'code' => 400,
                'message' => "You were trying to access something we don't recognize",
            ]);
            die;
        }

        $moduleName = (!empty($url[0])) ? $url[0] : 'order';
        $controllerName = (!empty($url[1])) ? $url[1] :'index';
        $actionName = (!empty($url[2])) ? $url[2] : 'process';

        if(!empty($url[1]) && !is_numeric($url[1])){
            $controllerName = 'index';
        }

        if(!empty($url[1]) && is_numeric($url[1])){
            $controllerName = 'index';
            $_GET['id'] = $url[1];
        }

        if($url[0] == 'orders'){
            $moduleName = 'order';
            $actionName = 'getAll';
        }

        $completePath = 'app/modules/' . ucfirst($moduleName) . '/Controllers/' . ucfirst($controllerName) . '.php';

        if (file_exists($completePath)) {
            $this->controller = 'App\\' . $moduleName . '\\Controllers\\' . $controllerName;
        }

        require_once $completePath;

        $this->controller = new $this->controller();
        if (isset($actionName)) {
            if (method_exists($this->controller, $actionName)) {
                $this->method = $actionName;
            }
        }

        unset($url[2]);
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse the URL for the current request. 
     */
    private function parseUrl() {

        if (isset($_GET['url'])) {
            $urlArray = explode('/', filter_var(rtrim(strtolower($_GET['url']), '/'), FILTER_SANITIZE_URL));
            
            array_shift($urlArray);
            
            return $urlArray;
        }
    }

    /**
     * Authenticate the request
     */
    private function authenticate() {
        $completePath = 'app/modules/Auth/Controllers/Index.php';

        if (file_exists($completePath)) {
            $controller = 'App\\Auth\\Controllers\\Index';
        }

        require_once $completePath;

        $controller = new $controller();

        if ($controller->verify()) {
            return true;
        }
    }
}
