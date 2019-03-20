<?php

namespace PandaScoreAPI\LeagueOfLegendsAPI\Endpoints;

use PandaScoreAPI\Endpoints\APIEndpoint;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Objects;

class Series extends APIEndpoint
{
	/**
	 * ==================================================================d=d=
	 *     Series Endpoint Methods.
	 *
	 *     @see https://developers.pandascore.co/doc/#tag/LoL-series
	 * ==================================================================d=d=
	 **/
	const RESOURCE_SERIE = 'serie';

	/**
	 *   List series.
	 *
	 * @return Objects\SeriesDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series
	 */
	public function listSeries()
	{
		$resultPromise = $this->client->setEndpoint('/series')
			->setResource(self::RESOURCE_SERIE, '/series/%s')
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
	 *   List past series.
	 *
	 * @return Objects\SeriesDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_past
	 */
	public function getPastSeries()
	{
		$resultPromise = $this->client->setEndpoint('/series/past')
			->setResource(self::RESOURCE_SERIE, '/series/%s/past')
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
	 *   List running series.
	 *
	 * @return Objects\SeriesDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_running
	 */
	public function listRunningSeries()
	{
		$resultPromise = $this->client->setEndpoint('/series/running')
			->setResource(self::RESOURCE_SERIE, '/series/%s/running')
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
	 *   List upcoming series.
	 *
	 * @return Objects\SeriesDto
	 *
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 * @throws GeneralException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_upcoming
	 */
	public function listUpcomingSeries()
	{
		$resultPromise = $this->client->setEndpoint('/series/upcoming')
			->setResource(self::RESOURCE_SERIE, '/series/%s/upcoming')
			->makeCall();

		return $this->client->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this->client);
			}

			return $r;
		});
	}
}
