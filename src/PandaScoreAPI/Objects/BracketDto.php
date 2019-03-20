<?php

namespace PandaScoreAPI\Objects;

class BracketDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var string $begin_at */
	public $begin_at;

	/** @var bool $draw */
	public $draw;

	/** @var GameDto[] $games */
	public $games;

	/** @var string $match_type */
	public $match_type;

	/** @var array $live */
	public $live;

	/** @var string $name */
	public $name;

	/** @var int $number_of_games */
	public $number_of_games;

	/** @var TeamDto[] $opponents */
	public $opponents;

	/** @var MatchDto[] $previous_matches */
	public $previous_matches;

	/** @var string $slug */
	public $slug;

	const STATUS_NOT_STARTED = 'not_started';
	const STATUS_RUNNING = 'running';
	const STATUS_FINISHED = 'finished';

	/** @var string $status */
	public $status;

	/** @var int $tournament_id */
	public $tournament_id;

	/** @var int $winner_id */
	public $winner_id;

	/** @var string $modified_at */
	public $modified_at;
}
