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
 *   Class MatchDto.
 *
 * Used in:
 *   match (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchIdsByTournamentCode
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchByTournamentCode
 */
class MatchDto extends ApiObject
{
    /**
     *   Please refer to the Game Constants documentation.
     *
     * @var int
     */
    public $seasonId;

    /**
     *   Please refer to the Game Constants documentation.
     *
     * @var int
     */
    public $queueId;

    /** @var int $gameId */
    public $gameId;

    /**
     *   Participant identity information.
     *
     * @var ParticipantIdentityDto[]
     */
    public $participantIdentities;

    /**
     *   The major.minor version typically indicates the patch the match was played
     * on.
     *
     * @var string
     */
    public $gameVersion;

    /**
     *   Platform where the match was played.
     *
     * @var string
     */
    public $platformId;

    /**
     *   Please refer to the Game Constants documentation.
     *
     * @var string
     */
    public $gameMode;

    /**
     *   Please refer to the Game Constants documentation.
     *
     * @var int
     */
    public $mapId;

    /**
     *   Please refer to the Game Constants documentation.
     *
     * @var string
     */
    public $gameType;

    /**
     *   Team information.
     *
     * @var TeamStatsDto[]
     */
    public $teams;

    /**
     *   Participant information.
     *
     * @var ParticipantDto[]
     */
    public $participants;

    /**
     *   Match duration in seconds.
     *
     * @var int
     */
    public $gameDuration;

    /**
     *   Designates the timestamp when champion select ended and the loading screen
     * appeared, NOT when the game timer was at 0:00.
     *
     * @var int
     */
    public $gameCreation;
}
