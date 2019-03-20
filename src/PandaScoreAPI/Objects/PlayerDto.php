<?php

namespace PandaScoreAPI\Objects;

class PlayerDto extends OpponentDto
{
	/** @var int $id */
	public $id;

	/** @var VideogameDto $current_game */
	public $current_game;

	/** @var string $first_name */
	public $first_name;

	/** @var string $hometown */
	public $hometown;

	/** @var string $image_url */
	public $image_url;

	/** @var string $last_name */
	public $last_name;

	/** @var string $name */
	public $name;

	/** @var string $role */
	public $role;

	/** @var string $slug */
	public $slug;
}
