<?php

namespace PandaScoreAPI\Objects;

/**
 *   Class LeagueDto
 * represents a league.
 *
 * Used in:
 *   league
 *
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
 */
class LeagueDto extends ApiObject
{
    /** @var int $id */
    public $id;

    public $name;

    /** @var string $url */
    public $url;

    /** @var string $slug */
    public $slug;

    /** @var bool $liveSupported */
    public $liveSupported;

    /** @var string $imageUrl */
    public $imageUrl;

    /** @var SeriesDto[] $series */
    public $series;

    /** @var VideogameDto $videogame */
    public $videogame;

    /** @var \DateTime $modifiedAt */
    public $modifiedAt;
}
