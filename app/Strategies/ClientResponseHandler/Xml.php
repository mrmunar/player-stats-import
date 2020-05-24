<?php

namespace App\Strategies\ClientResponseHandler;

use Illuminate\Http\Client\Response;

class Xml implements JsonOutputInterface
{
    public function __construct(Response $reponse, string $rootKey)
    {
        $this->response = $reponse;
        $this->key = $rootKey;
    }

    public function returnJson()
    {
        $convertedXmlToJson = simplexml_load_string($this->response->body());

        if (!$this->key) {
            return json_encode($convertedXmlToJson);
        }

        $output = $convertedXmlToJson->{$this->key};

        if (!$output) {
            throw new \Exception('Invalid xml key');
        }

        // Cleanup empty objects and replace with null
        return str_replace(':{}', ':null', json_encode($output));
    }
}
