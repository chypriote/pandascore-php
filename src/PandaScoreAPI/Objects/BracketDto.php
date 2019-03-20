<?php

namespace PandaScoreAPI\Objects;

class BracketDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var \DateTime $beginAt */
	public $beginAt;

	/** @var bool $draw */
	public $draw;

	/** @var GameDto[] $games */
	public $games;

	/** @var string $matchType */
	public $matchType;

	/** @var array $live */
	public $live;

	/** @var string $name */
	public $name;

	/** @var int $numberOfGames */
	public $numberOfGames;

	/** @var OpponentDto[] $opponents */
	public $opponents;

	/** @var MatchDto[] $previousMatches */
	public $previousMatches;

	/** @var string $slug */
	public $slug;

	const STATUS_NOT_STARTED = 'not_started';
	const STATUS_RUNNING = 'running';
	const STATUS_FINISHED = 'finished';

	/** @var string $status */
	public $status;

	/** @var int $tournamentId */
	public $tournamentId;

	/** @var int $winnerId */
	public $winnerId;

	/** @var \DateTime $modifiedAt */
	public $modifiedAt;
}
