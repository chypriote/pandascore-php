<?php

namespace PandaScoreAPI\Endpoints;

use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Teams extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     Teams Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/Teams
	 * ==================================================================d=d=
	 **/
	const RESOURCE_TEAM = 'team';

	/**
	 *   List teams.
	 *
	 * @return Objects\TeamDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams
	 */
	public function listTeams()
	{
		$resultPromise = $this->client->setEndpoint('/teams')
			->setResource(self::RESOURCE_TEAM, '/teams/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\TeamDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *   Get a single team by ID or by slug.
	 *
	 * @param int $team_id
	 *
	 * @return Objects\TeamDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams_teamIdOrSlug
	 */
	public function getMatch(int $team_id)
	{
		$resultPromise = $this->client->setEndpoint("/teams/{$team_id}")
			->setResource(self::RESOURCE_TEAM, '/teams/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\TeamDto($result, $this->client);
		});
	}

	/**
	 *  List leagues in which the given team was part of.
	 *
	 * @param int $team_id
	 *
	 * @return Objects\LeagueDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams_teamIdOrSlug_leagues
	 */
	public function getTeamLeagues(int $team_id)
	{
		$resultPromise = $this->client->setEndpoint("/teams/{$team_id}/leagues")
			->setResource(self::RESOURCE_TEAM, '/teams/%s/leagues')
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
	 *  List matches in which the given team was part of.
	 *
	 * @param int $team_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams_teamIdOrSlug_matches
	 */
	public function getTeamMatches(int $team_id)
	{
		$resultPromise = $this->client->setEndpoint("/teams/{$team_id}/matches")
			->setResource(self::RESOURCE_TEAM, '/teams/%s/matches')
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
	 *  List series in which the given team was part of.
	 *
	 * @param int $team_id
	 *
	 * @return Objects\SeriesDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams_teamIdOrSlug_series
	 */
	public function getTeamSeries(int $team_id)
	{
		$resultPromise = $this->client->setEndpoint("/teams/{$team_id}/series")
			->setResource(self::RESOURCE_TEAM, '/teams/%s/series')
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
	 *  List tournaments in which the given team was part of.
	 *
	 * @param int $team_id
	 *
	 * @return Objects\TournamentDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_teams_teamIdOrSlug_tournaments
	 */
	public function getTeamTournaments(int $team_id)
	{
		$resultPromise = $this->client->setEndpoint("/teams/{$team_id}/tournaments")
			->setResource(self::RESOURCE_TEAM, '/teams/%s/tournaments')
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
