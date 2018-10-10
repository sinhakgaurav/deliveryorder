<?php

namespace Core;

class Repository {

    public function getDb() {
        /** @var \Core\DbManager dbManager */
        return DbManager::getInstance();
    }

}
