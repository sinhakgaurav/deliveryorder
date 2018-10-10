<?php

namespace App\Order\Controllers;

use Core\Container;
use Core\Controller;

/**
 * The default index controller, called when no controller/method has been passed
 * to the application.
 */
class Index extends Controller {

    private $orderService;
    private $distanceService;

    public function __construct() {
        /** @var \App\Order\Services\OrderService service */
        $this->orderService = Container::getContainer()->get('order.service.order_service');

        $this->distanceService = Container::getContainer()->get('order.service.distance_service');
    }

    /**
     * A common interface to pass control
     */
    public function process() {
        if(!$this->validateRequest() || !$this->requestType()) {
            $this->pushResponse([
                'code' => 405,//method not allowed code
                'message' => 'unexpected request type',
            ]);
        }

        $actionRequired = $this->getAction();

        switch ($actionRequired){
            case "create" :
                $responseData = $this->create();
                break;
            case 'update' :
                $responseData = $this->update();
                break;
        }

        $this->pushResponse($responseData);
    }

    /**
     * to identify the action
     * 
     * @return string
     */
    private function getAction() {
        if($this->requestType()=='POST' && !isset($_GET['id'],$_GET['page'],$_GET['limit'])){
            return "create";
        }
        if($this->requestType()=='PUT' && isset($_GET['id']) && !isset($_GET['page'],$_GET['limit'])) {
            return "update";
        }
    }

    /**
     * To update record or to return the error
     * 
     * @return array
     */
    private function update() {
        $dataToFetch = $this->setGet();
        $dataToFetch = $this->filterData($dataToFetch);

        if(!isset($dataToFetch['id'])) {
            return [
                'code' => 422,
                'message' => 'Invalid reference. Cannot find data',
            ];
        }

        $data = $this->orderService->getById($this->toInt($dataToFetch['id']));

        if ($data['status'] == $_ENV['orderStatusArray']['taken']) {
            return [
                'code' => 409,
                'message' => 'Order already taken',
            ];
        }

        $requestData = $this->setData();

        if(!in_array($requestData->status, array_keys($_ENV['orderStatusArray']))) {
            return [
                'code' => 422,
                'message' => 'Entered data is not valid',
            ];
        }

        $dataToChange = array();

        foreach($requestData AS $dataKey => $dataValue) {
            if($dataKey == 'status') {
                $dataValue = $_ENV['orderStatusArray'][$dataValue];
            }
            $dataToChange[$dataKey] = $dataValue;
        }

        $updateConditions = [
            'id' => $this->toInt($dataToFetch['id']),
            'status' => [$_ENV['orderStatusArray']['taken'], 'NOT EQUALS'],
        ];
        if($this->orderService->update($dataToChange, $updateConditions)) {
            return [
                'code' => 200,
                'status' => 'SUCCESS',
            ];
        } else {
            return [
                'code' => 409,
                'message' => 'Order already taken.',
            ];
        }
    }

    /**
     * To create the order.
     *
     * @return array
     */
    private function create() {
        $requestData = $this->setData();
        $requestData = $this->filterData($requestData);

        if(!$requestData || empty($requestData)) {
            return [
                'code' => 500,
                'message' => 'Cannot process the data',
            ];
        }

        $dataToRecordDistanceTable=[];
        $dataToRecordDistanceTable['start_latitude'] = $requestData->origin[0];
        $dataToRecordDistanceTable['start_longitude'] = $requestData->origin[1];
        $dataToRecordDistanceTable['end_latitude'] = $requestData->destination[0];
        $dataToRecordDistanceTable['end_longitude'] = $requestData->destination[1];

        $existingDistance = $this->distanceService->getByParam($dataToRecordDistanceTable);

        if(!$this->distanceService->validateLatLong($dataToRecordDistanceTable)) {
            return [
                'code' => 422,
                'message' => 'Entered data is not valid',
            ];
        }

        if(!isset($existingDistance['distance'])) {
            $origin = $dataToRecordDistanceTable['start_latitude'] .",". $dataToRecordDistanceTable['start_longitude'];
            $destination = $dataToRecordDistanceTable['end_latitude'] .",". $dataToRecordDistanceTable['end_longitude'];
            $distance = $this->getDistance($origin, $destination);
            if(!$distance) {
                return [
                    'code' => 444, 
                    'message' => 'No response detected',
                ];
            }

            $dataToRecordDistanceTable['distance'] = $distance;

            if(!$this->distanceService->create($dataToRecordDistanceTable)) {
                return [
                    'code' => 500,
                    'message' => 'Something went wrong',
                ];
            }
        }

        $distance = !isset($existingDistance['distance'])?$distance:$existingDistance['distance'];
        $dataToRecordDistanceTable['distance'] = !isset($existingDistance['distance'])?$distance:$existingDistance['distance'];

        $dataToRecordOrderTable = [
            'status' => $_ENV['orderStatusArray']['unassigned'],
            'distance' => $distance,
        ];

        $insertId = $this->orderService->create($dataToRecordOrderTable);

        $callResponse = [
            'id' => $insertId,
            'distance' => $distance,
            'status' => array_search($_ENV['orderStatusArray']['unassigned'], $_ENV['orderStatusArray']),
            'code' => 200,
            'message' => 'Order created successfully',
        ];

        return $callResponse;
    }

    /**
     * To find all orders
     * 
     * @return array
     */
    public function getAll() {
        if(!$this->validateRequest() || !$this->requestType()) {
            $this->pushResponse([
                'code' => 500,
                'message' => 'unexpected request type',
            ]);
        }
        $requestData = $this->setGet();

        if(!isset($requestData['page'], $requestData['limit'])){
            $page = 0;
            $limit = 10;
        } else {
            $page = $requestData['page'];
            $limit = $requestData['limit'];
        }

        $startFrom = $page * $limit;

        $callResponse = $this->orderService->getAll($startFrom, $limit);

        $this->pushResponse($callResponse);
    }
}
