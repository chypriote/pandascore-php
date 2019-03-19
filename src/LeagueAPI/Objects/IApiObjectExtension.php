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

use PandaScoreAPI\LeagueAPI\PandaScoreAPI;

/**
 *   Interface IApiObjectExtension.
 */
interface IApiObjectExtension
{
    /**
     *   IApiObjectExtension constructor. Initializes the object extension.
     *
     * @param IApiObject    $apiObject The extended object (eg. SummonerDto, etc.)
     * @param PandaScoreAPI $api       The library instance
     */
    public function __construct(IApiObject &$apiObject, PandaScoreAPI &$api);
}
