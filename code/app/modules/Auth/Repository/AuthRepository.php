<?php

namespace App\Auth\Repository;

use Core\Repository;

class AuthRepository extends Repository {

    private $dbManager;

    public function __construct() {
        $this->dbManager = $this->getDb();
    }
}
