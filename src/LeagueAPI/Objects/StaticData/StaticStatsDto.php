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
 *   Class StaticStatsDto
 * This object contains champion stats data.
 */
class StaticStatsDto extends ApiObject
{
    /** @var float $armorperlevel */
    public $armorperlevel;

    /** @var float $hpperlevel */
    public $hpperlevel;

    /** @var float $attackdamage */
    public $attackdamage;

    /** @var float $mpperlevel */
    public $mpperlevel;

    /** @var float $attackspeedoffset */
    public $attackspeedoffset;

    /** @var float $armor */
    public $armor;

    /** @var float $hp */
    public $hp;

    /** @var float $hpregenperlevel */
    public $hpregenperlevel;

    /** @var float $spellblock */
    public $spellblock;

    /** @var float $attackrange */
    public $attackrange;

    /** @var float $movespeed */
    public $movespeed;

    /** @var float $attackdamageperlevel */
    public $attackdamageperlevel;

    /** @var float $mpregenperlevel */
    public $mpregenperlevel;

    /** @var float $mp */
    public $mp;

    /** @var float $spellblockperlevel */
    public $spellblockperlevel;

    /** @var float $crit */
    public $crit;

    /** @var float $mpregen */
    public $mpregen;

    /** @var float $attackspeedperlevel */
    public $attackspeedperlevel;

    /** @var float $hpregen */
    public $hpregen;

    /** @var float $critperlevel */
    public $critperlevel;
}
