<?php

namespace ApiWrapper;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ClientA
{
    private $client;

    public function __construct(array $arguments = [])
    {
        if (0 === count($arguments)) {
            $arguments = [
                'base_uri' => 'http://94.254.0.188:4000',
                'timeout'  => 2.0
            ];
        }
        $this->client = new Client($arguments);
    }

    public function __call($name, array $arguments)
    {
        if (3 === count($arguments)) {
            $id = $arguments[0];
            $params = ['limit='.$arguments[1], 'offset='.$arguments[2]];
        }else{
            $params = ['limit='.$arguments[0], 'offset='.$arguments[1]];
        }
        try {
            $uri = explode('_', $name);
            if (2 === count($uri)) {
                $uri = $uri[0].'/'.$id.'/'.$uri[1];
            }else{
                $uri = $name;
            }
            $response = $this->client->get('/'.$uri.'?'.implode('&',$params));
            $body = json_decode($response->getBody(),true);
            if ($body['status'] !== 'OK') {
                return $body['message'];
            }else{
                return $body['data'];
            }
        } catch (GuzzleException $e) {
            throw new Exception('Something with `' . $name . '` went wrong because ' . $e->getMessage());
        }
    }
}