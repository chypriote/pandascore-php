<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Tournaments extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     Tournaments Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Tournaments
	 * ==================================================================d=d=
	 **/
	const RESOURCE_LOL_TOURNAMENT = 'lol-tournament';

	/**
	 *   List tournaments.
	 *
	 * @return Objects\TournamentDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments
	 */
	public function listTournaments()
	{
		$resultPromise = $this->client->setEndpoint('/tournaments')
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\TournamentDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   List past tournaments.
	 *
	 * @return Objects\TournamentDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_past
	 */
	public function getPastTournaments()
	{
		$resultPromise = $this->client->setEndpoint('/tournaments/past')
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/past')
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
	 *   List upcoming tournaments.
	 *
	 * @return Objects\TournamentDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_upcoming
	 */
	public function getUpcomingTournaments()
	{
		$resultPromise = $this->client->setEndpoint('/tournaments/upcoming')
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/upcoming')
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
	 *   List running tournaments.
	 *
	 * @return Objects\TournamentDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_running
	 */
	public function getRunningTournaments()
	{
		$resultPromise = $this->client->setEndpoint('/tournaments/running')
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/running')
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
