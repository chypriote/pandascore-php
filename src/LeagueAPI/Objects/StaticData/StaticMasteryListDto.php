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

use PandaScoreAPI\LeagueAPI\Objects\ApiObjectIterable;

/**
 *   Class StaticMasteryListDto
 * This object contains mastery list data.
 *
 * @iterable $data
 */
class StaticMasteryListDto extends ApiObjectIterable
{
    /** @var StaticMasteryDto[] $data */
    public $data;

    /** @var string $version */
    public $version;

    /** @var StaticMasteryTreeDto $tree */
    public $tree;

    /** @var string $type */
    public $type;
}
