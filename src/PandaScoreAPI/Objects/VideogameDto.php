<?php

namespace PandaScoreAPI\Objects;

/**
 *   Class VideogameDto
 * represents a videogame.
 *
 * Used in:
 *   league
 *
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
 */
class VideogameDto extends ApiObject
{
    /**
     *   ID of the videogame.
     *
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string currentVersion
     */
    public $currentVersion;
}
