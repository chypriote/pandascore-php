<?php

namespace PandaScoreAPI\Objects;

class TournamentDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var \DateTime $begin_at */
	public $begin_at;

	/** @var \DateTime $end_at */
	public $end_at;

	/** @var array $expected_roster */
	public $expected_roster;

	/** @var LeagueDto $league */
	public $league;

	/** @var int $league_id */
	public $league_id;

	/** @var MatchDto[] $matches */
	public $matches;

	/** @var string $name */
	public $name;

	/** @var SeriesDto $serie */
	public $serie;

	/** @var int $serie_id */
	public $serie_id;

	/** @var string $slug */
	public $slug;

	/** @var TeamDto[] $teams */
	public $teams;

	/** @var VideogameDto $videogame */
	public $videogame;

	/** @var string $winner_type */
	public $winner_type;

	/** @var string $winner_id */
	public $winner_id;

	/** @var \DateTime $modified_at */
	public $modified_at;
}
