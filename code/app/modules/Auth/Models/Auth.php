<?php

namespace App\Auth\Models;

use Core\Container;

class Auth {

    private $repository;

    public function __construct() {

        /** @var App\Auth\Repository\AuthRepository repository */
        $this->repository = Container::getContainer()->get('auth.repository.auth_repository');
    }

}
