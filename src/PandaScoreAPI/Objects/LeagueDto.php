<?php

namespace PandaScoreAPI\Objects;

/**
 * Used in:
 *   league.
 *
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues
 *     @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
 */
class LeagueDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var string $name */
	public $name;

	/** @var string $url */
	public $url;

	/** @var string $slug */
	public $slug;

	/** @var bool $live_supported */
	public $live_supported;

	/** @var string $image_url */
	public $image_url;

	/** @var SeriesDto[] $series */
	public $series;

	/** @var VideogameDto $videogame */
	public $videogame;

	/** @var string $modified_at */
	public $modified_at;
}
