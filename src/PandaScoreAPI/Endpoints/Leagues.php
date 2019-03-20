<?php

namespace PandaScoreAPI\Endpoints;

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
	 *     @see https://developers.pandascore.co/doc/#tag/Leagues
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

	/**
	 *   Get single league object for a given league ID.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\LeagueDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
	 */
	public function getLeague(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\LeagueDto($result, $this->client);
		});
	}

	/**
	 *   List matches of the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches
	 */
	public function getLeagueMatches(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/matches")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches')
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
	 *   List past matches of the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_past
	 */
	public function getLeaguePastMatches(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/matches/past")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/past')
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
	 *   List upcoming matches for the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_upcoming
	 */
	public function getLeagueUpcomingMatches(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/matches/upcoming")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/upcoming')
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
	 *   List running matches of the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_running
	 */
	public function getLeagueRunningMatches(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/matches/running")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/running')
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
	 *   List series for the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\LeagueDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_series
	 */
	public function getLeagueSeries(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/series")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/series')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   List tournaments for the given league.
	 *
	 * @param int $league_id
	 *
	 * @return Objects\LeagueDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_tournaments
	 */
	public function getLeagueTournaments(int $league_id)
	{
		$resultPromise = $this->client->setEndpoint("/leagues/{$league_id}/tournaments")
			->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/tournaments')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\TournamentDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
