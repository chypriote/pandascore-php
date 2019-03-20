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

	/**
	 *   Get a single tournament by ID or by slug.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\TournamentDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_tournamentIdOrSlug
	 */
	public function getTournament(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}")
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\TournamentDto($result, $this->client);
		});
	}

	/**
	 *  Get the brackets of the given tournament.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\BracketDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_tournamentIdOrSlug_brackets
	 */
	public function getTournamentBrackets(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/brackets")
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/brackets')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\BracketDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *  Get the matches of the given tournament.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\MatchDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_tournamentIdOrSlug_matches
	 */
	public function getTournamentMatches(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/matches")
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/matches')
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
	 *  Get the current standings for a given tournament.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\StandingDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_tournamentIdOrSlug_standings
	 */
	public function getTournamentStandings(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/standings")
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/standings')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\StandingDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *  List teams for the given tournament.
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
	 * @see https://developers.pandascore.co/doc/#operation/get_tournaments_tournamentIdOrSlug_teams
	 */
	public function getTournamentTeams(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/teams")
			->setResource(self::RESOURCE_LOL_TOURNAMENT, '/tournaments/%s/teams')
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
