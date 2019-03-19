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

namespace PandaScoreAPI\LeagueAPI\Objects;

/**
 *   Class MatchPositionDto.
 *
 * Used in:
 *   match (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchTimeline
 */
class MatchPositionDto extends ApiObject
{
    /** @var int $y */
    public $y;

    /** @var int $x */
    public $x;
}
