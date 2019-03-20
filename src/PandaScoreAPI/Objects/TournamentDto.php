<?php

namespace PandaScoreAPI\Objects;

class TournamentDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var \DateTime $beginAt */
	public $beginAt;

	/** @var \DateTime $endAt */
	public $endAt;

	/** @var array $expectedRoster */
	public $expectedRoster;

	/** @var LeagueDto $league */
	public $league;

	/** @var int $leagueId */
	public $leagueId;

	/** @var MatchDto[] $matches */
	public $matches;

	/** @var string $name */
	public $name;

	/** @var SeriesDto $serie */
	public $serie;

	/** @var int $serieId */
	public $serieId;

	/** @var string $slug */
	public $slug;

	/** @var TeamDto[] $teams */
	public $teams;

	/** @var VideogameDto $videoGame */
	public $videoGame;

	/** @var string $winnerType */
	public $winnerType;

	/** @var int $winnerId */
	public $winnerId;

	/** @var \DateTime $modifiedAt */
	public $modifiedAt;
}
