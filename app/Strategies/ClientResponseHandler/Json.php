<?php

namespace App\Strategies\ClientResponseHandler;

use Illuminate\Support\Arr;
use Illuminate\Http\Client\Response;

class Json implements JsonOutputInterface
{
    public function __construct(Response $reponse, string $rootKey = '')
    {
        $this->response = $reponse;
        $this->key = $rootKey;
    }

    public function returnJson()
    {
        $jsonResponse = $this->response->json();

        if (!$this->key) {
            return json_encode($jsonResponse);
        }

        $output = is_array($jsonResponse)
            ? Arr::get($jsonResponse, $this->key, null)
            : $jsonResponse->{$this->key};

        if (!$output) {
            throw new \Exception('Invalid json key');
        }

        return json_encode($output);
    }
}
