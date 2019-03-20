<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Leagues extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     League Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Leagues
	 * ==================================================================d=d=
	 **/
	const RESOURCE_LEAGUE = 'league';

	/**
	 *   List leagues.
	 *
	 * @return Objects\LeagueDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues
	 */
	public function listLeagues()
	{
		$resultPromise = $this->client->setEndpoint('/leagues')
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\LeagueDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
