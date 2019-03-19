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
 *   Class TournamentCodeDto.
 *
 * Used in:
 *   tournament (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#tournament-v4/GET_getTournamentCode
 */
class TournamentCodeDto extends ApiObject
{
    /**
     *   The game map for the tournament code game.
     *
     * @var string
     */
    public $map;

    /**
     *   The tournament code.
     *
     * @var string
     */
    public $code;

    /**
     *   The spectator mode for the tournament code game.
     *
     * @var string
     */
    public $spectators;

    /**
     *   The tournament code's region. (Legal values: BR, EUNE, EUW, JP, LAN, LAS,
     * NA, OCE, PBE, RU, TR).
     *
     * @var string
     */
    public $region;

    /**
     *   The provider's ID.
     *
     * @var int
     */
    public $providerId;

    /**
     *   The team size for the tournament code game.
     *
     * @var int
     */
    public $teamSize;

    /**
     *   The summonerIds of the participants (Encrypted).
     *
     * @var string[]
     */
    public $participants;

    /**
     *   The pick mode for tournament code game.
     *
     * @var string
     */
    public $pickType;

    /**
     *   The tournament's ID.
     *
     * @var int
     */
    public $tournamentId;

    /**
     *   The lobby name for the tournament code game.
     *
     * @var string
     */
    public $lobbyName;

    /**
     *   The password for the tournament code game.
     *
     * @var string
     */
    public $password;

    /**
     *   The tournament code's ID.
     *
     * @var int
     */
    public $id;

    /**
     *   The metadata for tournament code.
     *
     * @var string
     */
    public $metaData;
}
