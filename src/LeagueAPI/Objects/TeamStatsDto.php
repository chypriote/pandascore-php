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
 *   Class TeamStatsDto.
 *
 * Used in:
 *   match (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchIdsByTournamentCode
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchByTournamentCode
 */
class TeamStatsDto extends ApiObject
{
    /**
     *   Flag indicating whether or not the team scored the first Dragon kill.
     *
     * @var bool
     */
    public $firstDragon;

    /**
     *   Flag indicating whether or not the team destroyed the first inhibitor.
     *
     * @var bool
     */
    public $firstInhibitor;

    /**
     *   If match queueId has a draft, contains banned champion data, otherwise
     * empty.
     *
     * @var TeamBansDto[]
     */
    public $bans;

    /**
     *   Number of times the team killed Baron.
     *
     * @var int
     */
    public $baronKills;

    /**
     *   Flag indicating whether or not the team scored the first Rift Herald kill.
     *
     * @var bool
     */
    public $firstRiftHerald;

    /**
     *   Flag indicating whether or not the team scored the first Baron kill.
     *
     * @var bool
     */
    public $firstBaron;

    /**
     *   Number of times the team killed Rift Herald.
     *
     * @var int
     */
    public $riftHeraldKills;

    /**
     *   Flag indicating whether or not the team scored the first blood.
     *
     * @var bool
     */
    public $firstBlood;

    /**
     *   100 for blue side. 200 for red side.
     *
     * @var int
     */
    public $teamId;

    /**
     *   Flag indicating whether or not the team destroyed the first tower.
     *
     * @var bool
     */
    public $firstTower;

    /**
     *   Number of times the team killed Vilemaw.
     *
     * @var int
     */
    public $vilemawKills;

    /**
     *   Number of inhibitors the team destroyed.
     *
     * @var int
     */
    public $inhibitorKills;

    /**
     *   Number of towers the team destroyed.
     *
     * @var int
     */
    public $towerKills;

    /**
     *   For Dominion matches, specifies the points the team had at game end.
     *
     * @var int
     */
    public $dominionVictoryScore;

    /**
     *   String indicating whether or not the team won. There are only two values
     * visibile in public match history. (Legal values: Fail, Win).
     *
     * @var string
     */
    public $win;

    /**
     *   Number of times the team killed Dragon.
     *
     * @var int
     */
    public $dragonKills;
}
