<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class PremiereleagueClient extends Client
{
    public function __construct()
    {
        $this->url = config('integration.premierleague.player_stats.url');
    }

    public function fetchPlayerStats()
    {
        $response = Http::withHeaders($this->clientDefaultHeaders)->get($this->url);

        return $this->responseHandler($response, 'elements');
    }
}
