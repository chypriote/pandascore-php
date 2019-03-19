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
 *   Class StaticInventoryDataStatsDto
 * This object contains stats for inventory (e.g., runes and items).
 */
class StaticInventoryDataStatsDto extends ApiObject
{
    /** @var float $PercentCritDamageMod */
    public $PercentCritDamageMod;

    /** @var float $PercentSpellBlockMod */
    public $PercentSpellBlockMod;

    /** @var float $PercentHPRegenMod */
    public $PercentHPRegenMod;

    /** @var float $PercentMovementSpeedMod */
    public $PercentMovementSpeedMod;

    /** @var float $FlatSpellBlockMod */
    public $FlatSpellBlockMod;

    /** @var float $FlatCritDamageMod */
    public $FlatCritDamageMod;

    /** @var float $FlatEnergyPoolMod */
    public $FlatEnergyPoolMod;

    /** @var float $PercentLifeStealMod */
    public $PercentLifeStealMod;

    /** @var float $FlatMPPoolMod */
    public $FlatMPPoolMod;

    /** @var float $FlatMovementSpeedMod */
    public $FlatMovementSpeedMod;

    /** @var float $PercentAttackSpeedMod */
    public $PercentAttackSpeedMod;

    /** @var float $FlatBlockMod */
    public $FlatBlockMod;

    /** @var float $PercentBlockMod */
    public $PercentBlockMod;

    /** @var float $FlatEnergyRegenMod */
    public $FlatEnergyRegenMod;

    /** @var float $PercentSpellVampMod */
    public $PercentSpellVampMod;

    /** @var float $FlatMPRegenMod */
    public $FlatMPRegenMod;

    /** @var float $PercentDodgeMod */
    public $PercentDodgeMod;

    /** @var float $FlatAttackSpeedMod */
    public $FlatAttackSpeedMod;

    /** @var float $FlatArmorMod */
    public $FlatArmorMod;

    /** @var float $FlatHPRegenMod */
    public $FlatHPRegenMod;

    /** @var float $PercentMagicDamageMod */
    public $PercentMagicDamageMod;

    /** @var float $PercentMPPoolMod */
    public $PercentMPPoolMod;

    /** @var float $FlatMagicDamageMod */
    public $FlatMagicDamageMod;

    /** @var float $PercentMPRegenMod */
    public $PercentMPRegenMod;

    /** @var float $PercentPhysicalDamageMod */
    public $PercentPhysicalDamageMod;

    /** @var float $FlatPhysicalDamageMod */
    public $FlatPhysicalDamageMod;

    /** @var float $PercentHPPoolMod */
    public $PercentHPPoolMod;

    /** @var float $PercentArmorMod */
    public $PercentArmorMod;

    /** @var float $PercentCritChanceMod */
    public $PercentCritChanceMod;

    /** @var float $PercentEXPBonus */
    public $PercentEXPBonus;

    /** @var float $FlatHPPoolMod */
    public $FlatHPPoolMod;

    /** @var float $FlatCritChanceMod */
    public $FlatCritChanceMod;

    /** @var float $FlatEXPBonus */
    public $FlatEXPBonus;
}
