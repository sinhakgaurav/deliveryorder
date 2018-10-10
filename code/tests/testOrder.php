<?php

require_once __DIr__ . '/../app/bootstrap.php';

class testOrder extends PHPUnit_Framework_TestCase {

    protected $client;

    protected function setUp() {
        $theHeaders = ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'token' => '2d0bb8a3325c2dec12db33379afcad9c'];

        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://delivery_nginx',
            "headers" => $theHeaders
        ]);

    }

    public function testGet_ValidInput_OrderObject() {

        $response = $this->client->get('/orders', [
            'query' => [
                'page' => 0,
                'limit' => 10
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data AS $order) {
            $this->assertArrayHasKey('id', $order);
            $this->assertArrayHasKey('status', $order);
            $this->assertArrayHasKey('distance', $order);
        }
    }

    public function testPost_NewOrder_OrderObject() {
        $response = $this->client->post('/order', [
            'json' => [
                "origin" => [
                    "28.704060",
                    "77.102493"
                ],
                "destination" => [
                    "28.535517",
                    "77.391029"
                ]
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody()->getContents(), true);

        //$this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('distance', $data);
    }

    public function testPut_NewOrder_OrderObject() {
        $response = $this->client->put('/order/1', [
            'json' => [
                "origin" => "taken"
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if(200 == $data['code']) {
            $this->assertArrayHasKey('status', $data);
        }else {
            //$this->assertArrayHasKey('message', $data);
            $this->assertArrayHasKey('code', $data);
        }
    }
}
