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
 *   Class ParticipantDto.
 *
 * Used in:
 *   match (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchIdsByTournamentCode
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchByTournamentCode
 *
 * @linkable getStaticChampion($championId)
 */
class ParticipantDto extends ApiObjectLinkable
{
    /**
     *   Participant statistics.
     *
     * @var ParticipantStatsDto
     */
    public $stats;

    /** @var int $participantId */
    public $participantId;

    /**
     *   List of legacy Rune information. Not included for matches played with
     * Runes Reforged.
     *
     * @var RuneDto[]
     */
    public $runes;

    /**
     *   Participant timeline data.
     *
     * @var ParticipantTimelineDto
     */
    public $timeline;

    /**
     *   100 for blue side. 200 for red side.
     *
     * @var int
     */
    public $teamId;

    /**
     *   Second Summoner Spell id.
     *
     * @var int
     */
    public $spell2Id;

    /**
     *   List of legacy Mastery information. Not included for matches played with
     * Runes Reforged.
     *
     * @var MasteryDto[]
     */
    public $masteries;

    /**
     *   Highest ranked tier achieved for the previous season in a specific subset
     * of queueIds, if any, otherwise null. Used to display border in game loading
     * screen. Please refer to the Ranked Info documentation. (Legal values: CHALLENGER,
     * MASTER, DIAMOND, PLATINUM, GOLD, SILVER, BRONZE, UNRANKED).
     *
     * @var string
     */
    public $highestAchievedSeasonTier;

    /**
     *   First Summoner Spell id.
     *
     * @var int
     */
    public $spell1Id;

    /** @var int $championId */
    public $championId;
}
