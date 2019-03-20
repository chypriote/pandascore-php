<?php

namespace PandaScoreAPI\Objects;

class StandingDto extends ApiObject
{
	/** @var MatchDto $last_match */
	public $last_match;

	/** @var int $rank */
	public $rank;

	/** @var TeamDto $team */
	public $team;
}
