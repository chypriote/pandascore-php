<?php

namespace PandaScoreAPI\Objects;

class VideogameDto extends ApiObject
{
    /** @var int $id */
    public $id;

    /** @var string $name */
    public $name;

    /** @var string $slug */
    public $slug;

    /** @var string $currentVersion */
    public $currentVersion;
}
