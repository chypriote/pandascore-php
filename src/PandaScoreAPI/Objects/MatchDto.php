<?php

namespace PandaScoreAPI\Objects;

class MatchDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var string $begin_at */
	public $begin_at;

	/** @var bool $draw */
	public $draw;

	/** @var GameDto[] $games */
	public $games;

	/** @var LeagueDto $league */
	public $league;

	/** @var int $league_id */
	public $league_id;

	/** @var bool $live */
	public $live;

	/** @var string $match_type */
	public $match_type;

	/** @var string $name */
	public $name;

	/** @var int $number_of_games */
	public $number_of_games;

	/** @var TeamDto[] $opponnents */
	public $opponnents;

	/** @var MatchResultDto[] $results */
	public $results;

	/** @var SeriesDto $serie */
	public $serie;

	/** @var int $serie_id */
	public $serie_id;

	/** @var string $slug */
	public $slug;

	const STATUS_NOT_STARTED = 'not_started';
	const STATUS_RUNNING = 'running';
	const STATUS_FINISHED = 'finished';

	/** @var string $status */
	public $status;

	/** @var VideogameDto $videogame */
	public $videogame;

	/** @var VideogameVersionDto $videogame_version */
	public $videogame_version;

	/** @var TeamDto $winner */
	public $winner;

	/** @var int $winner_id */
	public $winner_id;

	/** @var string $modified_at */
	public $modified_at;
}
