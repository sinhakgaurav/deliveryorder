<?php

namespace App\Order\Models;

use Core\Container;

class Order {

    private $repository;

    public function __construct() {

        /** @var App\Order\Repository\OrderRepository repository */
        $this->repository = Container::getContainer()->get('order.repository.order_repository');
    }

    /**
     * calling repository for updating order
     * @param arrau $data
     * @param array $conditions
     * 
     * @return boolean
     */
    public function update($data, $conditions) {
        $response = $this->repository->update($data, $conditions);

        if ($response->affected_rows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Getting order by id
     * @param int $data
     * 
     * @return array
     */
    public function getById($data) {
        return $this->repository->getById($data);
    }

    /**
     * returns all the orders
     * @param int $start
     * @param int $count
     * 
     * @return array
     */
    public function getAll($start, $count) {
        $returnData = array();

        $orders = $this->repository->getAll($start, $count);

        while($order = $orders->fetch_assoc()){
            $returnData[] = $order;
        }

        return $returnData;
    }

    /**
     * calls repository for creating a new order
     * @param array $data
     * 
     * @return int
     */
    public function createOrder($data) {
        $response = $this->repository->createOrder($data);

        return $response->insert_id;
    }
}
