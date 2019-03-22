<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Class CallCacheStorage.
 */
class CallCacheStorage
{
	/** @var array $cache */
	protected $cache = [];

	/**
	 *   CallCacheStorage constructor.
	 */
	public function __construct()
	{
	}

	/**
	 *   Checks whether or not is $hash call cached.
	 *
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function isCached(string $hash): bool
	{
		if (false == isset($this->cache[$hash])) {
			return false;
		}

		if ($this->cache[$hash]['expires'] < time()) {
			unset($this->cache[$hash]);

			return false;
		}

		return true;
	}

	/**
	 *   Loads cached data for given call.
	 *
	 * @param string $hash
	 *
	 * @return mixed
	 */
	public function load(string $hash)
	{
		return $this->isCached($hash)
			? $this->cache[$hash]['data']
			: false;
	}

	/**
	 *   Saves given data for call.
	 *
	 * @param string $hash
	 * @param        $data
	 * @param int    $length
	 */
	public function save(string $hash, $data, int $length)
	{
		$this->cache[$hash] = [
			'expires' => time() + $length,
			'data' => $data,
		];
	}
}
