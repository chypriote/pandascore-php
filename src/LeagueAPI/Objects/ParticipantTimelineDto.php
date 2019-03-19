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
 *   Class ParticipantTimelineDto.
 *
 * Used in:
 *   match (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchIdsByTournamentCode
 *     @see https://developer.riotgames.com/api-methods/#match-v4/GET_getMatchByTournamentCode
 */
class ParticipantTimelineDto extends ApiObject
{
    /**
     *   Participant's calculated lane. MID and BOT are legacy values. (Legal
     * values: MID, MIDDLE, TOP, JUNGLE, BOT, BOTTOM).
     *
     * @var string
     */
    public $lane;

    /** @var int $participantId */
    public $participantId;

    /**
     *   Creep score difference versus the calculated lane opponent(s) for a
     * specified period.
     *
     * @var float[]
     */
    public $csDiffPerMinDeltas;

    /**
     *   Gold for a specified period.
     *
     * @var float[]
     */
    public $goldPerMinDeltas;

    /**
     *   Experience difference versus the calculated lane opponent(s) for a
     * specified period.
     *
     * @var float[]
     */
    public $xpDiffPerMinDeltas;

    /**
     *   Creeps for a specified period.
     *
     * @var float[]
     */
    public $creepsPerMinDeltas;

    /**
     *   Experience change for a specified period.
     *
     * @var float[]
     */
    public $xpPerMinDeltas;

    /**
     *   Participant's calculated role. (Legal values: DUO, NONE, SOLO, DUO_CARRY,
     * DUO_SUPPORT).
     *
     * @var string
     */
    public $role;

    /**
     *   Damage taken difference versus the calculated lane opponent(s) for a
     * specified period.
     *
     * @var float[]
     */
    public $damageTakenDiffPerMinDeltas;

    /**
     *   Damage taken for a specified period.
     *
     * @var float[]
     */
    public $damageTakenPerMinDeltas;
}
