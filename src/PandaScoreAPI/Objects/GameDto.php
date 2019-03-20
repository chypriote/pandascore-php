<?php

namespace PandaScoreAPI\Objects;

class GameDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var \DateTime $begin_at */
	public $begin_at;

	/** @var bool $finished */
	public $finished;

	/** @var int $length */
	public $length;

	/** @var array $match */ //FullGameMatchDto
	public $match;

	/** @var int $match_id */
	public $match_id;

	/** @var PlayerDto[] $players */
	public $players;

	/** @var int $position */
	public $position;

	/** @var TeamDto[] $teams */
	public $teams;

	/** @var OpponentDto $winner */
	public $winner;

	/** @var string $winner_type */
	public $winner_type;
}
