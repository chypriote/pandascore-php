<?php

namespace PandaScoreAPI\Objects;

/**
 * Used in:
 *   series.
 *
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
 */
class SeriesDto extends ApiObject
{
    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $fullName */
    public $fullName;

    /** @var string $slug */
    public $slug;

    /** @var string $description */
    public $description;

    /** @var int $year */
    public $year;

    /** @var string $season */
    public $season;

    /** @var string $winnerType */
    public $winnerType;

    /** @var int $winnerId */
    public $winnerId;

    /** @var int $prizepool */
    public $prizepool;

    /** @var \DateTime $beginAt */
    public $beginAt;

    /** @var \DateTime $endAt */
    public $endAt;

    /** @var int $leagueId */
    public $leagueId;

    /** @var \DateTime $modifiedAt */
    public $modifiedAt;
}
