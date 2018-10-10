<?php

namespace App\Auth\Controllers;

use Core\Container;
use Core\Controller;

/**
 * The default index controller, called when no controller/method has been passed
 * to the application.
 */
class Index extends Controller {

    private $authService;

    public function __construct() {
        /** @var \App\Order\Services\OrderService service */
        $this->authService = Container::getContainer()->get('auth.service.auth_service');
    }

    /**
     * For verifying the token
     */
    public function verify() {
        $clientToken = $this->getHeader()['Token'];

        if($this->matchValue(getenv('TOKEN'), $clientToken) || getenv('BYPASS_TOKEN')) { //TOKEN could also be fetched from some other library such as database.
            return true;
        }

        $this->pushResponse([
            'code' => '403',
            'message' => 'You are trying to access a unauthorized resource',
        ]);
    }
}
