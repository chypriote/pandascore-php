<?php

namespace PandaScoreAPI\Objects;

/**
 * Used in:
 *   series.
 *
 *     @see https://developers.pandascore.co/doc/#operation/get_series
 *     @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug
 */
class SeriesDto extends ApiObject
{
	/** @var int $id */
	public $id;

	/** @var string $name */
	public $name;

	/** @var string $full_name */
	public $full_name;

	/** @var string $slug */
	public $slug;

	/** @var string $description */
	public $description;

	/** @var int $year */
	public $year;

	/** @var string $season */
	public $season;

	/** @var string $winner_type */
	public $winner_type;

	/** @var string $winner_id */
	public $winner_id;

	/** @var int $prizepool */
	public $prizepool;

	/** @var string $begin_at */
	public $begin_at;

	/** @var string $end_at */
	public $end_at;

	/** @var string $modified_at */
	public $modified_at;

	/** @var VideogameDto $videogame */
	public $videogame;

	/** @var TournamentDto[] $tournaments */
	public $tournaments;

	/** @var LeagueDto $league */
	public $league;

	/** @var int $league_id */
	public $league_id;
}
