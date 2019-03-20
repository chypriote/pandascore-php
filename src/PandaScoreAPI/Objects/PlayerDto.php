<?php

namespace PandaScoreAPI\Objects;

class PlayerDto extends OpponentDto
{
    /** @var int $id */
    public $id;

    /** @var VideogameDto $currentGame */
    public $currentGame;

    /** @var string $firstName */
    public $firstName;

    /** @var string $hometown */
    public $hometown;

    /** @var string $imageUrl */
    public $imageUrl;

    /** @var string $lastName */
    public $lastName;

    /** @var string $name */
    public $name;

    /** @var string $role */
    public $role;

    /** @var string $slug */
    public $slug;
}
