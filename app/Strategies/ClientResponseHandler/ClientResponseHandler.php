<?php

namespace App\Strategies\ClientResponseHandler;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;

class ClientResponseHandler implements JsonOutputInterface
{
    private $format;

    public function __construct(Response $response, string $rootKey)
    {
        switch ($contentType = $response->header('Content-Type')) {
            case Str::contains($contentType, 'application/json'):
                $this->format = new Json($response, $rootKey);
                break;
            case Str::contains($contentType, 'application/xml'):
                $this->format = new Xml($response, $rootKey);
                break;
            default:
                throw new \InvalidArgumentException($contentType . ' is not supported');
        }
    }

    public function returnJson()
    {
        return $this->format->returnJson();
    }
}
