<?php

namespace App\Auth\Services;

use Core\Container;

class AuthService {

    private $model;

    public function __construct() {
        /** @var App\Auth\Models\Auth model */
        $this->model = Container::getContainer()->get('auth.model.auth');
    }
}
