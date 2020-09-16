<?php

namespace App\Core\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiService
{
    /**
     * @var Client
     */
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $url
     * @param array $options
     * @return array
     * @throws GuzzleException
     */
    public function get($url, array $options = []): array
    {
        $response = $this->client->get($url, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
