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
 *   Class ChampionMasteryDto
 * This object contains single Champion Mastery information for player and champion combination.
 *
 * Used in:
 *   champion-mastery (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#champion-mastery-v4/GET_getAllChampionMasteries
 *     @see https://developer.riotgames.com/api-methods/#champion-mastery-v4/GET_getChampionMastery
 *
 * @linkable getStaticChampion($championId)
 */
class ChampionMasteryDto extends ApiObjectLinkable
{
    /**
     *   Is chest granted for this champion or not in current season.
     *
     * @var bool
     */
    public $chestGranted;

    /**
     *   Champion level for specified player and champion combination.
     *
     * @var int
     */
    public $championLevel;

    /**
     *   Total number of champion points for this player and champion combination -
     * they are used to determine championLevel.
     *
     * @var int
     */
    public $championPoints;

    /**
     *   Champion ID for this entry.
     *
     * @var int
     */
    public $championId;

    /**
     *   Number of points needed to achieve next level. Zero if player reached
     * maximum champion level for this champion.
     *
     * @var int
     */
    public $championPointsUntilNextLevel;

    /**
     *   Last time this champion was played by this player - in Unix milliseconds
     * time format.
     *
     * @var int
     */
    public $lastPlayTime;

    /**
     *   The token earned for this champion to levelup.
     *
     * @var int
     */
    public $tokensEarned;

    /**
     *   Number of points earned since current level has been achieved.
     *
     * @var int
     */
    public $championPointsSinceLastLevel;

    /**
     *   Summoner ID for this entry. (Encrypted).
     *
     * @var string
     */
    public $summonerId;
}
