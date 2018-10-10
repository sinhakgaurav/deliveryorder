<?php

namespace App\Order\Services;

use Core\Container;

class OrderService {

    private $model;

    public function __construct() {
        /** @var App\Order\Models\Order model */
        $this->model = Container::getContainer()->get('order.model.order');
    }

    /*
     * function to call model
     * @data to identify the order
     * @ return order table data
     */

    public function update($data,$id) {
        return $this->model->update($data,$id);
    }

    /*
     * function to call model
     * @data to identify the order
     * @ return order table data
     */

    public function getById($data) {
        return $this->model->getById($data);
    }

    /*
     * function to call model
     *
     * @ return order table data
     */

    public function getAll($start, $count) {
        return $this->model->getAll($start, $count);
    }

    /*
     * function to call model
     * @data to create the order
     * @ returns true/ false on creation of row
     */

    public function create($data) {
        return $this->model->createOrder($data);
    }

}
