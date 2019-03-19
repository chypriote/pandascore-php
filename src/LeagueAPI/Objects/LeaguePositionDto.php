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
 *   Class LeaguePositionDto.
 *
 * Used in:
 *   league (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#league-v4/GET_getAllLeaguePositionsForSummoner
 *     @see https://developer.riotgames.com/api-methods/#league-v4/GET_getPositionalLeagueEntries
 */
class LeaguePositionDto extends ApiObject
{
    /** @var string $queueType */
    public $queueType;

    /** @var string $summonerName */
    public $summonerName;

    /** @var bool $hotStreak */
    public $hotStreak;

    /** @var MiniSeriesDto $miniSeries */
    public $miniSeries;

    /** @var int $wins */
    public $wins;

    /** @var bool $veteran */
    public $veteran;

    /** @var int $losses */
    public $losses;

    /** @var string $rank */
    public $rank;

    /** @var string $leagueId */
    public $leagueId;

    /** @var bool $inactive */
    public $inactive;

    /** @var bool $freshBlood */
    public $freshBlood;

    /** @var string $leagueName */
    public $leagueName;

    /**
     *   (Legal values: APEX, TOP, JUNGLE, MIDDLE, BOTTOM, UTILITY, NONE).
     *
     * @var string
     */
    public $position;

    /** @var string $tier */
    public $tier;

    /**
     *   Player's summonerId (Encrypted).
     *
     * @var string
     */
    public $summonerId;

    /** @var int $leaguePoints */
    public $leaguePoints;
}
