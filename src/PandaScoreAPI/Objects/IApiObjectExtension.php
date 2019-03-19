<?php

namespace PandaScoreAPI\Objects;

use PandaScoreAPI\PandaScoreAPI;

/**
 *   Interface IApiObjectExtension.
 */
interface IApiObjectExtension
{
    /**
     *   IApiObjectExtension constructor. Initializes the object extension.
     *
     * @param IApiObject    $apiObject The extended object (eg. LeagueDto, etc.)
     * @param PandaScoreAPI $api       The library instance
     */
    public function __construct(IApiObject &$apiObject, PandaScoreAPI &$api);
}
