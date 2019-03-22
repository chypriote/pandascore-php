<?php

namespace PandaScoreAPI\Objects;

use PandaScoreAPI\PandaScoreAPI;

/**
 *   Interface IApiObject.
 */
interface IApiObject
{
	/**
	 *   IApiObject constructor. Initializes the object.
	 *
	 * @param array         $data
	 * @param PandaScoreAPI $api
	 */
	public function __construct(array $data, PandaScoreAPI $api);

	/**
	 *   Gets all the original data fetched from PandaScoreAPI.
	 *
	 * @return array
	 */
	public function getData(): array;
}
