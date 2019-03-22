<?php

namespace PandaScoreAPI\Definitions;

use PandaScoreAPI\PandaScoreAPI;

/**
 *   Class RateLimitStorage.
 */
class RateLimitStorage
{
	/** @var array $limits */
	protected $limits = [];

	protected static function parseLimitHeaders($header)
	{
		$limits = [];
		foreach (explode(',', $header) as $limitInterval) {
			$limitInterval = explode(':', $limitInterval);
			$limit = (int) $limitInterval[0];
			$interval = (int) $limitInterval[1];

			$limits[$interval] = $limit;
		}

		return $limits;
	}

	/**
	 *   Initializes limits for providede API key.
	 *
	 * @param string $api_key
	 * @param array  $limits
	 */
	public function initApp(string $api_key, array $limits)
	{
		$output = [];
		foreach ($limits as $interval => $limit) {
			$output[$interval] = [
				'used' => 0,
				'limit' => $limit,
				'expires' => time() + $interval,
			];
		}
		$this->limits[$api_key]['app'] = $output;
	}

	/**
	 *   Initializes limits for providede API key.
	 *
	 * @param string $api_key
	 * @param string $endpoint
	 * @param array  $limits
	 */
	public function initMethod(string $api_key, string $endpoint, array $limits)
	{
		$output = [];
		foreach ($limits as $interval => $limit) {
			$output[$interval] = [
				'used' => 0,
				'limit' => $limit,
				'expires' => time() + $interval,
			];
		}
		$this->limits[$api_key]['method'][$endpoint] = $output;
	}

	/**
	 *   Returns interval limits for provided API key.
	 *
	 * @param string $api_key
	 *
	 * @return mixed
	 */
	public function getAppLimits(string $api_key)
	{
		return @$this->limits[$api_key]['app'];
	}

	/**
	 *   Returns interval limits for provided API key.
	 *
	 * @param string $api_key
	 * @param string $endpoint
	 *
	 * @return mixed
	 */
	public function getMethodLimits(string $api_key, string $endpoint)
	{
		return @$this->limits[$api_key]['method'][$endpoint];
	}

	/**
	 *   Sets new value for used API calls for provided API key.
	 *
	 * @param string $api_key
	 * @param int    $timeInterval
	 * @param int    $value
	 */
	public function setAppUsed(string $api_key, int $timeInterval, int $value)
	{
		$this->limits[$api_key]['app'][$timeInterval]['used'] = $value;
		if (1 == $value) {
			$this->limits[$api_key]['app'][$timeInterval]['expires'] = time() + $timeInterval;
		}
	}

	/**
	 *   Sets new value for used API calls for provided API key.
	 *
	 * @param string $api_key
	 * @param string $endpoint
	 * @param int    $timeInterval
	 * @param int    $value
	 */
	public function setMethodUsed(string $api_key, string $endpoint, int $timeInterval, int $value)
	{
		$this->limits[$api_key]['method'][$endpoint][$timeInterval]['used'] = $value;
		if (1 == $value) {
			$this->limits[$api_key]['method'][$endpoint][$timeInterval]['expires'] = time() + $timeInterval;
		}
	}

	/**
	 *   Determines whether or not API call can be made.
	 *
	 * @param string $api_key
	 * @param string $resource
	 * @param string $endpoint
	 *
	 * @return bool
	 */
	public function canCall(string $api_key, string $resource, string $endpoint): bool
	{
		$appLimits = $this->getAppLimits($api_key);
		if (is_array($appLimits)) {
			foreach ($appLimits as $timeInterval => $limits) {
				//  Check all saved intervals
				if ($limits['used'] >= $limits['limit'] && $limits['expires'] > time()) {
					return false;
				}
			}
		}

		$methodLimits = $this->getMethodLimits($api_key, $endpoint);
		if (is_array($methodLimits)) {
			foreach ($methodLimits as $timeInterval => $limits) {
				//  Check all saved intervals for this endpoint
				if ($limits['used'] >= $limits['limit'] && $limits['expires'] > time()) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 *   Registers that new API call has been made.
	 *
	 * @param string $api_key
	 * @param string $app_header
	 */
	public function registerAppLimits(string $api_key, string $app_header)
	{
		$limits = self::parseLimitHeaders($app_header);
		$this->initApp($api_key, $limits);
	}

	/**
	 *   Registers that new API call has been made.
	 *
	 * @param string $api_key
	 * @param string $endpoint
	 * @param string $method_header
	 */
	public function registerMethodLimits(string $api_key, string $endpoint, string $method_header)
	{
		$limits = self::parseLimitHeaders($method_header);
		$this->initMethod($api_key, $endpoint, $limits);
	}

	/**
	 *   Registers that new API call has been made.
	 *
	 * @param string $api_key
	 * @param string $endpoint
	 * @param string $app_header
	 * @param string $method_header
	 */
	public function registerCall(string $api_key, string $endpoint, string $app_header = null, string $method_header = null)
	{
		if ($app_header) {
			$limits = self::parseLimitHeaders($app_header);
			foreach ($limits as $interval => $used) {
				$this->setAppUsed($api_key, $interval, $used);
			}
		}

		if ($method_header) {
			$limits = self::parseLimitHeaders($method_header);
			foreach ($limits as $interval => $used) {
				$this->setMethodUsed($api_key, $endpoint, $interval, $used);
			}
		}
	}
}
