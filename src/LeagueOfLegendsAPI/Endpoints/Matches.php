<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Matches extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     Matches Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Matches
	 * ==================================================================d=d=
	 **/
	const RESOURCE_MATCH = 'match';

	/**
	 *   List matches.
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches
	 */
	public function listMatches()
	{
		$resultPromise = $this->client->setEndpoint('/matches')
			->setResource(self::RESOURCE_MATCH, '/matches/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\MatchDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   List past matches.
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches_past
	 */
	public function getPastMatches()
	{
		$resultPromise = $this->client->setEndpoint('/matches/past')
			->setResource(self::RESOURCE_MATCH, '/matches/%s/past')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\MatchDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   List upcoming matches.
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches_upcoming
	 */
	public function getUpcomingMatches()
	{
		$resultPromise = $this->client->setEndpoint('/matches/upcoming')
			->setResource(self::RESOURCE_MATCH, '/matches/%s/upcoming')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\MatchDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   List running matches.
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches_running
	 */
	public function getRunningMatches()
	{
		$resultPromise = $this->client->setEndpoint('/matches/running')
			->setResource(self::RESOURCE_MATCH, '/matches/%s/running')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\MatchDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
