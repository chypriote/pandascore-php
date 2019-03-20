<?php

namespace PandaScoreAPI;

use PandaScoreAPI\Endpoints\Leagues;
use PandaScoreAPI\Endpoints\Matches;
use PandaScoreAPI\Endpoints\Players;
use PandaScoreAPI\Endpoints\Series;
use PandaScoreAPI\Endpoints\Teams;
use PandaScoreAPI\Endpoints\Tournaments;
use PandaScoreAPI\LeagueOfLegendsAPI\LeagueOfLegendsAPI;

/**
 *   Class PandaScoreAPI.
 */
class PandaScoreAPI extends APIClient
{
	/**
	 *   Available resource list.
	 *
	 * @var array
	 */
	protected $resources = [
		Leagues::RESOURCE_LEAGUE,
		Series::RESOURCE_SERIE,
		Tournaments::RESOURCE_TOURNAMENT,
		Matches::RESOURCE_MATCH,
	];

	/** @var Leagues $leagues */
	public $leagues;

	/** @var Series $series */
	public $series;

	/** @var Tournaments $tournaments */
	public $tournaments;

	/** @var Matches $matches */
	public $matches;

	/** @var Teams $teams */
	public $teams;

	/** @var Players $players */
	public $players;

	/** @var LeagueOfLegendsAPI $lol */
	public $lol;

	public function __construct(array $settings)
	{
		parent::__construct($settings);
		$this->leagues = new Leagues($this);
		$this->series = new Series($this);
		$this->tournaments = new Tournaments($this);
		$this->matches = new Matches($this);
		$this->teams = new Teams($this);
		$this->players = new Players($this);

		if (PandaScoreAPI::class === get_class($this) && $this->getSetting(self::USE_LEAGUE_OF_LEGENDS)) {
			$this->lol = new LeagueOfLegendsAPI($settings);
		}
	}
}
