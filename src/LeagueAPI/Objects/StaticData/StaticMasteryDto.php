<?php

/**
 * Copyright (C) 2016-2018  Daniel Dolejška.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace PandaScoreAPI\LeagueAPI\Objects\StaticData;

use PandaScoreAPI\LeagueAPI\Objects\ApiObject;

/**
 *   Class StaticMasteryDto
 * This object contains mastery data.
 */
class StaticMasteryDto extends ApiObject
{
    /** @var string $prereq */
    public $prereq;

    /**
     *   (Legal values: Cunning, Ferocity, Resolve, Defense, Offense, Utility).
     *
     * @var string
     */
    public $masteryTree;

    /** @var string $name */
    public $name;

    /** @var int $ranks */
    public $ranks;

    /** @var StaticImageDto $image */
    public $image;

    /** @var int $id */
    public $id;

    /** @var string[] $description */
    public $description;
}
