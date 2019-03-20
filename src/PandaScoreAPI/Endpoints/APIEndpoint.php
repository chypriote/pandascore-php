<?php

namespace PandaScoreAPI\Endpoints;

use PandaScoreAPI\PandaScoreAPI;

class APIEndpoint
{
    protected $client;

    public function __construct(PandaScoreAPI $client)
    {
        $this->client = $client;
    }
}
