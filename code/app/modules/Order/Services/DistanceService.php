<?php

namespace App\Order\Services;

use Core\Container;

class DistanceService {

    private $model;

    public function __construct() {
        /** @var App\Order\Models\Distance model */
        $this->model = Container::getContainer()->get('order.model.distance');
    }

    /*
     * to Create new record
     * @param array $data to create the distance
     * 
     * @returns boolean on creation of row
     */
    public function create($data) {
        return $this->model->createDistance($data);
    }

    /*
     * callng model to get record
     * @param array $data to get the distancebyparam
     * 
     * @returns boolean on creation of row
     */
    public function getByParam($data) {
        return $this->model->getByParam($data);
    }

    /**
     * to validate the input
     * @param type $dataToValidate
     * 
     * @return boolean
     */
    public function validateLatLong($dataToValidate) {
        return $this->model->validateLatLong($dataToValidate);
    }
}
