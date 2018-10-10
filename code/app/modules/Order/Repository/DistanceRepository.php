<?php

namespace App\Order\Repository;

use Core\Repository;

class DistanceRepository extends Repository {

    private $dbManager;

    public function __construct() {
        $this->dbManager = $this->getDb();
    }

    /**
     * calls the query functions to execute the query
     * @param array $data
     * 
     * @return object mysqli
     */
    public function create($data) {
        return $this->createQuery($data);
    }

    private function createQuery($data) {
        $query = 'INSERT INTO distance SET';
        foreach ($data AS $key => $value){
            $query .= " $key ='". $value . "',";
        }
        $query = rtrim($query, ",");

        return $this->dbManager->write_query($query);
    }

    /**
     * gets data by param by calling query function to execute the query
     * @param array $data
     * 
     * @return array
     */
    public function getByParam($data) {
        $orderQuery = $this->getByParamQuery($data);

        return $orderQuery->fetch_assoc();
    }

    private function getByParamQuery($data) {
        $query = 'SELECT distance FROM distance WHERE id IS NOT NULL';
        foreach ($data AS $key => $value){
            $query .= " AND $key ='". $value."'";
        }

        return $this->dbManager->read_query($query);
    }
}
