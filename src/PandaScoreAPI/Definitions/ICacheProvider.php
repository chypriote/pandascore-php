<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Interface ICacheProvider.
 */
interface ICacheProvider
{
    /**
     *   Loads data stored in cache memory.
     *
     * @param string $name
     */
    public function load(string $name);

    /**
     *   Saves data to cache memory.
     *
     * @param string $name
     * @param        $data
     * @param int    $length
     *
     * @return bool
     */
    public function save(string $name, $data, int $length): bool;

    /**
     *   Checks whether or not is saved in cache.
     *
     * @param string $name
     *
     * @return bool
     */
    public function isSaved(string $name): bool;
}
