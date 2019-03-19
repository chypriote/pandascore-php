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

namespace PandaScoreAPI\LeagueAPI\Objects\StaticData;

use PandaScoreAPI\LeagueAPI\Objects\ApiObject;

/**
 *   Class StaticRealmDto
 * This object contains realm data.
 */
class StaticRealmDto extends ApiObject
{
    /**
     *   Legacy script mode for IE6 or older.
     *
     * @var string
     */
    public $lg;

    /**
     *   Latest changed version of Dragon Magic.
     *
     * @var string
     */
    public $dd;

    /**
     *   Default language for this realm.
     *
     * @var string
     */
    public $l;

    /**
     *   Latest changed version for each data type listed.
     *
     * @var string[]
     */
    public $n;

    /**
     *   Special behavior number identifying the largest profile icon ID that can
     * be used under 500. Any profile icon that is requested between this number and
     * 500 should be mapped to 0.
     *
     * @var int
     */
    public $profileiconmax;

    /**
     *   Additional API data drawn from other sources that may be related to Data
     * Dragon functionality.
     *
     * @var string
     */
    public $store;

    /**
     *   Current version of this file for this realm.
     *
     * @var string
     */
    public $v;

    /**
     *   The base CDN URL.
     *
     * @var string
     */
    public $cdn;

    /**
     *   Latest changed version of Dragon Magic's CSS file.
     *
     * @var string
     */
    public $css;
}
