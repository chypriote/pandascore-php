<?php

namespace PandaScoreAPI\Endpoints;

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
	 *     @see https://developers.pandascore.co/doc/#tag/Matches
	 * ==================================================================d=d=
	 **/
	const RESOURCE_MATCH = 'match';

	/**
	 *   List currently running live matches, available from pandascore with live websocket data.
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lives
	 */
	public function listLives()
	{
		//@TODO
	}

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

	/**
	 *   Get a single match by ID or by slug.
	 *
	 * @param int $match_id
	 *
	 * @return Objects\MatchDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches_matchIdOrSlug
	 */
	public function getMatch(int $match_id)
	{
		$resultPromise = $this->client->setEndpoint("/matches/{$match_id}")
			->setResource(self::RESOURCE_MATCH, '/matches/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\MatchDto($result, $this->client);
		});
	}

	/**
	 *  List opponents (player or teams) for the given match.
	 *
	 * @param int $match_id
	 *
	 * @return Objects\TeamDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_matches_matchIdOrSlug_opponents
	 */
	public function getMatchOpponents(int $match_id)
	{
		$resultPromise = $this->client->setEndpoint("/matches/{$match_id}/teams")
			->setResource(self::RESOURCE_MATCH, '/matches/%s/teams')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\TeamDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
