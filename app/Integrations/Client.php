<?php

namespace App\Integrations;

use Illuminate\Http\Client\Response;
use App\Strategies\ClientResponseHandler\ClientResponseHandler as ResponseHandler;


abstract class Client
{
    protected $clientDefaultHeaders = [
        'User-Agent' => 'Laravel/7.0',
    ];

    protected $url;

    protected function responseHandler(Response $response, string $rootKey = '')
    {
        return (new ResponseHandler($response, $rootKey))->returnJson();
    }
}
