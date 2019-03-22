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
	 * ==================================================================n=t=
	 *     League Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Leagues
	 * ==================================================================n=t=
	 **/
	const RESOURCE_LOL_LEAGUE = 'lol-league';

	/**
	 *   List leagues.
	 *
	 * @param array    $filters
	 * @param int|null $page
	 * @param int|null $per_page
	 * @param array    $sorts
	 *
	 * @return Objects\LeagueDto[]
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues
	 */
	public function listLeagues(array $filters = [], int $page = null, int $per_page = null, array $sorts = [])
	{
		$this->client->setEndpoint('/leagues')
			->setResource(self::RESOURCE_LOL_LEAGUE, '/leagues/%s')
			->addQuery('page', $page)
			->addQuery('sort', join(',', $sorts))
			->addQuery('per_page', $per_page);

		foreach ($filters as $key => $filter) {
			$this->client->addQuery('filter['.$key.']', $filter);
		}

		return $this->client->resolveOrEnqueuePromise($this->client->makeCall(), function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\LeagueDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
