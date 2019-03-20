<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI;

use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Leagues;
use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Matches;
use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Players;
use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Series;
use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Teams;
use PandaScoreAPI\LeagueOfLegendsAPI\Endpoints\Tournaments;
use PandaScoreAPI\PandaScoreAPI;

class LeagueOfLegendsAPI extends PandaScoreAPI
{
	public function __construct(array $settings)
	{
		$this->settings[self::SET_API_BASEURL] = 'api.pandascore.co/lol';
		parent::__construct($settings);

		$this->leagues = new Leagues($this);
		$this->series = new Series($this);
		$this->tournaments = new Tournaments($this);
		$this->matches = new Matches($this);
		$this->players = new Players($this);
		$this->teams = new Teams($this);
	}
}
