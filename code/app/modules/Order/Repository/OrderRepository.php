<?php

namespace App\Order\Repository;

use Core\Repository;

class OrderRepository extends Repository {

    private $dbManager;

    public function __construct() {
        $this->dbManager = $this->getDb();
    }

    /**
     * to get record by id
     * @param int $data
     * 
     * @return array
     */
    public function getById($data) {
        $orderQuery = $this->getQuery($data);

        return $orderQuery->fetch_assoc();
    }

    private function getQuery($data) {
        return $this->dbManager->read_query('SELECT status FROM orders where id="' . $data . '"');
    }

    /**
     * to get record for pagination
     * @param int $start
     * @param int $count
     * 
     * @return array
     */
    public function getAll($start, $count) {
        $orderQuery = $this->getAllQuery($start, $count);

        return $orderQuery;
    }

    private function getAllQuery($start, $count) {
        return $this->dbManager->read_query('SELECT id, status, distance FROM orders limit '. $start . "," . $count);
    }

    /**
     * to get last inserted record
     * 
     * @return array
     */
    public function getLast() {
        $orderQuery = $this->getLastQuery();

        return $orderQuery->fetch_assoc();
    }

    private function getLastQuery() {
        return $this->dbManager->read_query('SELECT max(id) AS id, status, distance FROM orders');
    }

    /**
    * to create new order
    * @param array $data
     * 
    * @return object mysqli
    */
    public function createOrder($data) {
        return $this->createOrderQuery($data);
    }

    private function createOrderQuery($data) {
        $query = 'INSERT INTO orders SET';
        foreach ($data AS $key => $value){
            $query .= " $key ='". $value . "',";
        }
        $query = rtrim($query, ",");

        return $this->dbManager->write_query($query);
    }

    /**
     * to update the record
     * @param array $data
     * @param array $conditions
     * 
     * @return object mysqli
     */
    public function update($data, $conditions) {
        return $this->updateQuery($data, $conditions);
    }

    private function updateQuery($data, $conditions) {
        $query = 'UPDATE orders SET';
        foreach ($data AS $key => $value) {
            $query .= " $key ='". $value . "',";
        }
        $query = rtrim($query, ",");
        $query .= ' WHERE id > 0';

        foreach ($conditions AS $conditionKey => $conditionValue) {
            $query .= " AND $conditionKey ";

            if(is_array($conditionValue)) {
                if ($conditionValue[1] == 'EQUALS') {
                    $query .= "= $conditionValue[0]";
                } else {
                    $query .= "!= $conditionValue[0]";
                }
            } else {
                $query .= "= $conditionValue";
            }
        }

        return $this->dbManager->write_query($query);
    }
}
