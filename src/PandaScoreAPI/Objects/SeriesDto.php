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

	/** @var \DateTime $begin_at */
	public $begin_at;

	/** @var \DateTime $end_at */
	public $end_at;

	/** @var int $league_id */
	public $league_id;

	/** @var \DateTime $modified_at */
	public $modified_at;
}
