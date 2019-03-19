<?php

use PandaScoreAPI\PandaScoreAPI;

require __DIR__.'/vendor/autoload.php';

$api = new PandaScoreAPI([
	"SET_TOKEN" => "",
	"SET_VERIFY_SSL" => false,
]);


$data = json_encode($api->leagues->getLeague(4213), JSON_PRETTY_PRINT);
fprintf(STDOUT, $data);
