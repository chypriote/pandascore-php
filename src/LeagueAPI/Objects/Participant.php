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
 *   Class Participant.
 *
 * Used in:
 *   spectator (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#spectator-v4/GET_getFeaturedGames
 *
 * @linkable getStaticChampion($championId)
 */
class Participant extends ApiObjectLinkable
{
    /**
     *   The ID of the profile icon used by this participant.
     *
     * @var int
     */
    public $profileIconId;

    /**
     *   The ID of the champion played by this participant.
     *
     * @var int
     */
    public $championId;

    /**
     *   The summoner name of this participant.
     *
     * @var string
     */
    public $summonerName;

    /**
     *   Flag indicating whether or not this participant is a bot.
     *
     * @var bool
     */
    public $bot;

    /**
     *   The ID of the second summoner spell used by this participant.
     *
     * @var int
     */
    public $spell2Id;

    /**
     *   The team ID of this participant, indicating the participant's team.
     *
     * @var int
     */
    public $teamId;

    /**
     *   The ID of the first summoner spell used by this participant.
     *
     * @var int
     */
    public $spell1Id;
}
