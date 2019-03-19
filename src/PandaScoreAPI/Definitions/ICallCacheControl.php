<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Interface ICallCacheControl.
 */
interface ICallCacheControl
{
    /**
     *   Checks whether or not is $hash call cached.
     *
     * @param string $hash
     *
     * @return bool
     */
    public function isCallCached(string $hash): bool;

    /**
     *   Loads cached data for given call.
     *
     * @param string $hash
     *
     * @return mixed
     */
    public function loadCallData(string $hash);

    /**
     *   Saves given data for call.
     *
     * @param string $hash
     * @param        $data
     * @param int    $length
     *
     * @return bool
     */
    public function saveCallData(string $hash, $data, int $length): bool;
}
