<?php

namespace PandaScoreAPI\Objects;

class StandingDto extends ApiObject
{
	/** @var MatchDto $lastMatch */
	public $lastMatch;

	/** @var int $rank */
	public $rank;

	/** @var TeamDto $team */
	public $team;
}
