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
 *   Class SummonerDto
 * represents a summoner.
 *
 * Used in:
 *   summoner (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#summoner-v4/GET_getByAccountId
 *     @see https://developer.riotgames.com/api-methods/#summoner-v4/GET_getBySummonerName
 *     @see https://developer.riotgames.com/api-methods/#summoner-v4/GET_getByPUUID
 *     @see https://developer.riotgames.com/api-methods/#summoner-v4/GET_getBySummonerId
 */
class SummonerDto extends ApiObject
{
    /**
     *   ID of the summoner icon associated with the summoner.
     *
     * @var int
     */
    public $profileIconId;

    /**
     *   Summoner name.
     *
     * @var string
     */
    public $name;

    /**
     *   Encrypted PUUID. Exact length of 78 characters.
     *
     * @var string
     */
    public $puuid;

    /**
     *   Summoner level associated with the summoner.
     *
     * @var int
     */
    public $summonerLevel;

    /**
     *   Date summoner was last modified specified as epoch milliseconds. The
     * following events will update this timestamp: profile icon change, playing the
     * tutorial or advanced tutorial, finishing a game, summoner name change.
     *
     * @var int
     */
    public $revisionDate;

    /**
     *   Encrypted summoner ID. Max length 63 characters.
     *
     * @var string
     */
    public $id;

    /**
     *   Encrypted account ID. Max length 56 characters.
     *
     * @var string
     */
    public $accountId;
}
