<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Class FileCacheStorage.
 */
class FileCacheStorage
{
	/** @var int $created_at */
	public $created_at;

	/** @var int $expires_at */
	public $expires_at;

	/** @var mixed $data */
	public $data;

	public function __construct($data, int $time)
	{
		$this->created_at = time();
		$this->expires_at = time() + $time;
		$this->data = $data;
	}

	public function __sleep()
	{
		return ['created_at', 'expires_at', 'data'];
	}
}
