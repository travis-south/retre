<?php

namespace TravisSouth\Retre\Adapters\Gitlab;

use GuzzleHttp\Client;
use Seld\JsonLint\JsonParser;
use Psr\Http\Message\ResponseInterface;

abstract class Gitlab
{

    const API_PATH_PREFIX = 'api/v4/';
    
    public function __construct(string $endpoint, string $token)
    {
        if (!$endpoint) {
            throw new \BadMethodCallException('endpoint cannot be empty!');
        }
        
        $this->baseUri = rtrim($endpoint, '/') . '/' . self::API_PATH_PREFIX;
        $this->client = new Client([
            'base_uri' => $this->baseUri,
            'verify' => false,
            'headers' => [
                'PRIVATE-TOKEN' => $token,
            ],
        ]);
    }

    protected function getResponse(ResponseInterface $response)
    {
        $parser = new JsonParser();

        return $parser->parse($response->getBody());
    }
}
