<?php

namespace Core;

class Controller {

    protected $requestData;

    public function __construct() {
        $this->setData();
        $this->setGet();
    }

    /**
     * to get token from header
     */
    protected function getHeader() {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }

        return $headers;
    }

    /*
     * allocate data array
     * @returns the data array
     */

    protected function setData() {
        $json = file_get_contents('php://input');
        $this->requestData = json_decode($json);

        return $this->requestData;
    }

    protected function filterData($data) {
        foreach ($_ENV['not_required'] AS $unsetValue) {
            unset($data->$unsetValue);
        }

        return $data;
    }

    /**
     * to validate rest request
     *
     * @return bool
     */
    protected function validateRequest() {
        if ($_SERVER['CONTENT_TYPE'] == 'application/xml' || $_SERVER['CONTENT_TYPE'] == 'application/json') {
            return true;
        }

        return false;
    }

    /**
     * to validate allowed request method and get back the request method name
     *
     * @return string
     */
    protected function requestType() {
        if (in_array($_SERVER['REQUEST_METHOD'], $_ENV['allowedRequest'])) {
            return $_SERVER['REQUEST_METHOD'];
        }

        return false;
    }

    /*
     * allocate get array
     * @returns the get array
     */

    protected function setGet() {
        if (!empty($_GET)) {
            $this->requestData = $_GET;
        }

        return $this->requestData;
    }

    protected function toInt($data) {
        return intval($data);
    }

    /*
     * function to convert array to string data
     * @sets a session array for the for error message 
     */

    protected function getArrayToString($data) {
        if (!empty($data)) {
            return implode(',', $data);
        }
    }

    /**
     * Generate response for the Request
     */
    protected function pushResponse($responseData) {
        if (is_array($responseData) && !empty($responseData)) {
            echo json_encode($responseData);
            die();
        }
    }

    /**
     * to match token
     */
    protected function matchValue($token, $clientToken) {
        if ($token === $clientToken) {
            return true;
        }

        return false;
    }

    /**
     * gets the distance from api
     */
    protected function getDistance($originMetric, $destinationMetrics) {

        $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=" . $originMetric . "&destinations=" . $destinationMetrics . "&key=" . getenv('API_KEY_GOOGLE'));
        $data = json_decode($api);

        if ($data->rows[0]->elements[0]->status == 'NOT_FOUND' || !$data)
            return false;

        return ((int) $data->rows[0]->elements[0]->distance->value / 1000) . ' Km';
    }

}
