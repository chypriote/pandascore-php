<?php

namespace PandaScoreAPI\Objects;

class GameDto extends ApiObject
{
    /** @var int $id */
    public $id;

    /** @var \DateTime $beginAt */
    public $beginAt;

    /** @var bool $finished */
    public $finished;

    /** @var int $length */
    public $length;

    /** @var array $match */ //FullGameMatchDto
    public $match;

    /** @var int $matchId */
    public $matchId;

    /** @var PlayerDto[] $players */
    public $players;

    /** @var int $position */
    public $position;

    /** @var TeamDto[] $teams */
    public $teams;

    /** @var OpponentDto $winner */
    public $winner;

    /** @var string $winnerType */
    public $winnerType;
}
