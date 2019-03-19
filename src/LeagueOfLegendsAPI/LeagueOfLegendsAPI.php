<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI;

use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;
use PandaScoreAPI\PandaScoreAPI;

class LeagueOfLegendsAPI extends PandaScoreAPI
{
    public function __construct(array $settings)
    {
        $this->settings[self::SET_API_BASEURL] = 'api.pandascore.co/lol';
        $this->resources[] = self::RESOURCE_LOL_LEAGUE;
        parent::__construct($settings);
    }

    /**
     * ==================================================================d=d=
     *     LOL Leagues Endpoint Methods.
     *
     *     @see https://developers.pandascore.co/doc/#tag/LoL-leagues
     * ==================================================================d=d=
     **/
    const RESOURCE_LOL_LEAGUE = 'lol-league';

    /**
     *   List League of Legends leagues.
     *
     * @return Objects\LeagueDto
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues
     */
    public function getLeagues()
    {
        $resultPromise = $this->setEndpoint('/leagues')
            ->setResource(self::RESOURCE_LOL_LEAGUE, '/leagues/%s')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            $r = [];
            foreach ($result as $leagueListDtoData) {
                $r[] = new Objects\LeagueDto($leagueListDtoData, $this);
            }
            return $r;
        });
    }
}
