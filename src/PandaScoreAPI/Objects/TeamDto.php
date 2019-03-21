<?php

namespace PandaScoreAPI\Objects;

class TeamDto extends OpponentDto
{
	/** @var int $id */
	public $id;

	/** @var string $name */
	public $name;

	/** @var string $slug */
	public $slug;

	/** @var string $image_url */
	public $image_url;

	/** @var string $acronym */
	public $acronym;
}
