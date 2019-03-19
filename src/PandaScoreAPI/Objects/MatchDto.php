<?php

namespace PandaScoreAPI\Objects;

class MatchDto extends ApiObject
{
    /** @var int $id */
    public $id;

	/** @var \DateTime $beginAt */
	public $beginAt;

	/** @var bool $draw */
	public $draw;

	/** @var GameDto[] $games */
	public $games;

	/** @var LeagueDto $league */
	public $league;

	/** @var int $leagueId */
	public $leagueId;

	/** @var bool $live */
	public $live;

	/** @var string $matchType */
	public $matchType;

	/** @var \DateTime $modifiedAt */
	public $modifiedAt;

    /** @var string $name */
    public $name;

	/** @var int $numberOfGames */
	public $numberOfGames;

	/** @var OpponentDto[] $opponnents */
	public $opponnents;

	/** @var MatchResultDto[] $results */
	public $results;

	/** @var SeriesDto $serie */
	public $serie;

	/** @var int $serieId */
	public $serieId;

	/** @var string $slug */
	public $slug;

	const STATUS_NOT_STARTED = "not_started";
	const STATUS_RUNNING = "running";
	const STATUS_FINISHED = "finished";

	/** @var string $status */
	public $status;

	/** @var VideogameDto $videoGame */
	public $videoGame;

	/** @var VideogameVersionDto $videoGameVersion */
	public $videoGameVersion;

	/** @var OpponentDto $winner */
	public $winner;

	/** @var int $winnerId */
	public $winnerId;
}
