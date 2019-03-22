<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Class CallCacheControl.
 */
class CallCacheControl implements ICallCacheControl
{
	/** @var array $storage */
	protected $storage;

	/**
	 *   CallCacheControl constructor.
	 */
	public function __construct()
	{
		$this->storage = new CallCacheStorage();
	}

	/**
	 *   Checks whether or not is $hash call cached.
	 *
	 * @param string $hash
	 *
	 * @return bool
	 */
	public function isCallCached(string $hash): bool
	{
		return $this->storage->isCached($hash);
	}

	/**
	 *   Loads cached data for given call.
	 *
	 * @param string $hash
	 *
	 * @return mixed
	 */
	public function loadCallData(string $hash)
	{
		return $this->storage->load($hash);
	}

	/**
	 *   Saves given data for call.
	 *
	 * @param string $hash
	 * @param        $data
	 * @param int    $lenght
	 *
	 * @return bool
	 */
	public function saveCallData(string $hash, $data, int $lenght): bool
	{
		$this->storage->save($hash, $data, $lenght);

		return true;
	}
}
