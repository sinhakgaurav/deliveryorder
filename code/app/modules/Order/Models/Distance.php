<?php

namespace App\Order\Models;

use Core\Container;
use Core\Model;

class Distance {

    private $repository;

    public function __construct() {

        /** @var App\Order\Repository\OrderRepository repository */
        $this->repository = Container::getContainer()->get('order.repository.distance_repository');
    }

    /**
     * creating new entry for distance
     * @param array $data
     * 
     * @return boolean
     */
    public function CreateDistance($data) {
        $response = $this->repository->create($data);

        if ($response->insert_id) {
            return true;
        }

        return false;
    }

    /*
     * Calls repository to get data by params
     * @param array $data to get the distancebyparam
     * 
     * @ returns array
     */
    public function getByParam($data) {
        return $this->repository->getByParam($data);
    }

    /**
     * Validating inputs
     * @param array $dataToValidate
     * 
     * @return bool
     */
    public function validateLatLong($dataToValidate) {
        if($dataToValidate['start_latitude'] <= -90 && $dataToValidate['start_latitude'] >= 90) {
            return false;
        }

        if($dataToValidate['end_latitude'] <= -90 && $dataToValidate['end_latitude'] >= 90) {
            return false;
        }

        if($dataToValidate['start_longitude'] <= -180 && $dataToValidate['start_longitude'] >= 180) {
            return false;
        }

        if($dataToValidate['end_longitude'] <= -180 && $dataToValidate['end_longitude'] >= 180) {
            return false;
        }

        if($dataToValidate['start_latitude'] == $dataToValidate['end_latitude'] ||
            $dataToValidate['start_longitude'] == $dataToValidate['end_longitude'] ||
            $dataToValidate['start_latitude'] == $dataToValidate['start_longitude'] ||
            $dataToValidate['end_latitude'] == $dataToValidate['end_longitude']
        )
        {
            return false;
        }

        if($dataToValidate['start_latitude'] == "" ||
            $dataToValidate['start_longitude'] == "" ||
            $dataToValidate['start_latitude'] == "" ||
            $dataToValidate['end_latitude'] == ""
        )
        {
            return false;
        }

        if((trim($dataToValidate['start_latitude'],'0') != (float)$dataToValidate['start_latitude']) && 
            (trim($dataToValidate['start_longitude'],'0') != (float)$dataToValidate['start_longitude'])
        )
        {
            return false;
        }

        if((trim($dataToValidate['end_latitude'],'0') != (float)$dataToValidate['end_latitude']) && 
            (trim($dataToValidate['end_longitude'],'0') != (float)$dataToValidate['end_longitude'])
        )
        {
            return false;
        }

        return true;
    }
}
