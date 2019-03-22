<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Players extends APIEndpoint
{
	/**
	 * ==================================================================n=t=
	 *     Players Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-Players
	 * ==================================================================n=t=
	 **/
	const RESOURCE_LOL_PLAYER = 'lol-player';

	/**
	 *   List players.
	 *
	 * @return Objects\PlayerDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_players
	 */
	public function listPlayers()
	{
		$resultPromise = $this->client->setEndpoint('/players')
			->setResource(self::RESOURCE_LOL_PLAYER, '/players/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\PlayerDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *  List players for the League of Legends videogame for the given serie.
	 *
	 * @param int $serie_id
	 *
	 * @return Objects\PlayerDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_series_serieIdOrSlug_players
	 */
	public function getSeriePlayers(int $serie_id)
	{
		$resultPromise = $this->client->setEndpoint("/series/{$serie_id}/players")
			->setResource(self::RESOURCE_LOL_PLAYER, '/series/%s/players')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\PlayerDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}

	/**
	 *  List players for the League of Legends videogame for the given tournament.
	 *
	 * @param int $tournament_id
	 *
	 * @return Objects\PlayerDto[]
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_lol_tournaments_tournamentIdOrSlug_players
	 */
	public function getTournamentPlayers(int $tournament_id)
	{
		$resultPromise = $this->client->setEndpoint("/tournaments/{$tournament_id}/players")
			->setResource(self::RESOURCE_LOL_PLAYER, '/tournaments/%s/players')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\PlayerDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
