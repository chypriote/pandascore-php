<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
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
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Teams
	 * ==================================================================d=d=
	 **/
	const RESOURCE_LOL_TEAM = 'lol-team';

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
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_teams
	 */
	public function listTeams()
	{
		$resultPromise = $this->client->setEndpoint('/teams')
			->setResource(self::RESOURCE_LOL_TEAM, '/teams/%s')
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
	 *  List teams for the League of Legends videogame for the given serie.
	 *
	 * @param int $serie_id
	 *
	 * @return Objects\TeamDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_series_serieIdOrSlug_teams
	 */
	public function getSerieTeams(int $serie_id)
	{
		$resultPromise = $this->client->setEndpoint("/series/{$serie_id}/teams")
			->setResource(self::RESOURCE_LOL_TEAM, '/series/%s/teams')
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
	 *  List teams for the League of Legends videogame for the given tournament.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\TeamDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_tournaments_tournamentIdOrSlug_teams
	 */
	public function getTournamentTeams(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/teams")
			->setResource(self::RESOURCE_LOL_TEAM, '/tournaments/%s/teams')
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
