<?php

namespace PandaScoreAPI\Endpoints;

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
	 *     @see https://developers.pandascore.co/doc/#tag/Series
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
		$resultPromise = $this->setEndpoint('/series')
			->setResource(self::RESOURCE_SERIE, '/series/%s')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this);
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
		$resultPromise = $this->setEndpoint('/series/past')
			->setResource(self::RESOURCE_SERIE, '/series/%s/past')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this);
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
		$resultPromise = $this->setEndpoint('/series/running')
			->setResource(self::RESOURCE_SERIE, '/series/%s/running')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this);
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
		$resultPromise = $this->setEndpoint('/series/upcoming')
			->setResource(self::RESOURCE_SERIE, '/series/%s/upcoming')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $leagueListDtoData) {
				$r[] = new Objects\SeriesDto($leagueListDtoData, $this);
			}
			return $r;
		});
	}

	/**
	 *   Get a single serie by ID or by slug.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug
	 */
	public function getSeries(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}")
			->setResource(self::RESOURCE_SERIE, '/series/%s')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			return new Objects\LeagueDto($result, $this);
		});
	}

	/**
	 *   List matches of the given serie.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug_matches
	 */
	public function getSeriesMatches(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}/matches")
			->setResource(self::RESOURCE_SERIE, '/series/%s/matches')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $matchListDto) {
				$r[] = new Objects\MatchDto($matchListDto, $this);
			}
			return $r;
		});
	}

	/**
	 *   List past matches of the given serie.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug_matches_past
	 */
	public function getSeriesPastMatches(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}/matches/past")
			->setResource(self::RESOURCE_SERIE, '/series/%s/matches/past')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $matchListDto) {
				$r[] = new Objects\MatchDto($matchListDto, $this);
			}
			return $r;
		});
	}

	/**
	 *   List upcoming matches of the given serie.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug_matches_upcoming
	 */
	public function getSeriesUpcomingMatches(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}/matches/upcoming")
			->setResource(self::RESOURCE_SERIE, '/series/%s/matches/upcoming')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $matchListDto) {
				$r[] = new Objects\MatchDto($matchListDto, $this);
			}
			return $r;
		});
	}

	/**
	 *   List running matches of the given serie.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug_matches_running
	 */
	public function getSeriesRunningMatches(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}/matches/running")
			->setResource(self::RESOURCE_SERIE, '/series/%s/matches/running')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $matchListDto) {
				$r[] = new Objects\MatchDto($matchListDto, $this);
			}
			return $r;
		});
	}

	/**
	 *   List tournaments of the given serie.
	 *
	 * @param int $serie_id
	 * @return Objects\SeriesDto
	 *
	 * @throws GeneralException
	 * @throws RequestException
	 * @throws ServerException
	 * @throws ServerLimitException
	 *
	 * @see https://developers.pandascore.co/doc/#operation/get_series_serieIdOrSlug_tournaments
	 */
	public function getSeriesTournaments(int $serie_id)
	{
		$resultPromise = $this->setEndpoint("/series/{$serie_id}/tournaments")
			->setResource(self::RESOURCE_SERIE, '/series/%s/tournaments')
			->makeCall();

		return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
			$r = [];
			foreach ($result as $matchListDto) {
				$r[] = new Objects\TournamentDto($matchListDto, $this);
			}
			return $r;
		});
	}
}
