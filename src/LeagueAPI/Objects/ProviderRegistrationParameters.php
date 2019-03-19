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
 *   Class ProviderRegistrationParameters.
 *
 * Used in:
 *   tournament-stub (v4)
 *
 *     @see https://developer.riotgames.com/api-methods/#tournament-stub-v4/POST_registerProviderData
 *   tournament (v4)
 *     @see https://developer.riotgames.com/api-methods/#tournament-v4/POST_registerProviderData
 */
class ProviderRegistrationParameters extends ApiObject
{
    /**
     *   The provider's callback URL to which tournament game results in this
     * region should be posted. The URL must be well-formed, use the http or https
     * protocol, and use the default port for the protocol (http URLs must use port 80,
     * https URLs must use port 443).
     *
     * @var string
     */
    public $url;

    /**
     *   The region in which the provider will be running tournaments. (Legal
     * values: BR, EUNE, EUW, JP, LAN, LAS, NA, OCE, PBE, RU, TR).
     *
     * @var string
     */
    public $region;
}
