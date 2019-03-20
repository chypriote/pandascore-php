<?php

namespace PandaScoreAPI\Endpoints;

use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Players extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     Players Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/Players
	 * ==================================================================d=d=
	 **/
	const RESOURCE_PLAYER = 'player';

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
	 * @see https://developers.pandascore.co/doc/#operation/get_players
	 */
	public function listPlayers()
	{
		$resultPromise = $this->client->setEndpoint('/players')
			->setResource(self::RESOURCE_PLAYER, '/players/%s')
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
	 *   Get a single player by ID or by slug.
	 *
	 * @param int $player_id
	 *
	 * @return Objects\PlayerDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_players_playerIdOrSlug
	 */
	public function getPlayer(int $player_id)
	{
		$resultPromise = $this->client->setEndpoint("/players/{$player_id}")
			->setResource(self::RESOURCE_PLAYER, '/players/%s')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\PlayerDto($result, $this->client);
		});
	}
}
