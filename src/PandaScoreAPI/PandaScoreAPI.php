<?php

namespace PandaScoreAPI;

use PandaScoreAPI\Endpoints\Leagues;
use PandaScoreAPI\Endpoints\Series;
use PandaScoreAPI\Endpoints\Tournaments;

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
    ];

    /** @var Leagues $leagues */
	public $leagues;

	/** @var Series $series */
	public $series;

	/** @var Tournaments $tournaments */
	public $tournaments;

	public function __construct(array $settings)
	{
		parent::__construct($settings);
		$this->leagues = new Leagues($this);
		$this->series = new Series($this);
		$this->tournaments = new Tournaments($this);
	}
}
