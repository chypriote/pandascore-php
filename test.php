<?php

use PandaScoreAPI\PandaScoreAPI;

require __DIR__.'/vendor/autoload.php';

$api = new PandaScoreAPI([
	'SET_TOKEN' => '',
	'SET_VERIFY_SSL' => false,
	'USE_LEAGUE_OF_LEGENDS' => true,
]);

$data = json_encode($api->matches->getMatch(54074), JSON_PRETTY_PRINT);
fprintf(STDOUT, $data);

