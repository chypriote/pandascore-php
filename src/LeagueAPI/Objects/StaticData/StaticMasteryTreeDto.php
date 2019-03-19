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
 *   Class StaticMasteryTreeDto
 * This object contains mastery tree data.
 */
class StaticMasteryTreeDto extends ApiObject
{
    /** @var StaticMasteryTreeListDto[] $Resolve */
    public $Resolve;

    /** @var StaticMasteryTreeListDto[] $Defense */
    public $Defense;

    /** @var StaticMasteryTreeListDto[] $Utility */
    public $Utility;

    /** @var StaticMasteryTreeListDto[] $Offense */
    public $Offense;

    /** @var StaticMasteryTreeListDto[] $Ferocity */
    public $Ferocity;

    /** @var StaticMasteryTreeListDto[] $Cunning */
    public $Cunning;
}
