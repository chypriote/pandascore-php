<?php

namespace PandaScoreAPI\Definitions;

use PandaScoreAPI\Exceptions\SettingsException;

/**
 *   Class MemcachedCacheProvider.
 */
class MemcachedCacheProvider implements ICacheProvider
{
    const MEMCACHED_ID = 'CacheProvider';

    /** @var \Memcached */
    protected $memcached;

    /**
     *   MemcachedCacheProvider constructor.
     *
     * @param array $servers
     *
     * @throws SettingsException
     */
    public function __construct(array $servers = [])
    {
        if (!class_exists('Memcached')) {
            throw new SettingsException('Class Memcached not found, is your Memcached ');
        }
        $this->memcached = $m = new \Memcached(self::MEMCACHED_ID);

        $m->setOption(\Memcached::OPT_CONNECT_TIMEOUT, 10);
        $m->setOption(\Memcached::OPT_DISTRIBUTION, \Memcached::DISTRIBUTION_CONSISTENT);
        $m->setOption(\Memcached::OPT_SERVER_FAILURE_LIMIT, 2);
        $m->setOption(\Memcached::OPT_REMOVE_FAILED_SERVERS, true);
        $m->setOption(\Memcached::OPT_RETRY_TIMEOUT, 1);

        if (empty($servers)) {
            $servers = [
                ['127.0.0.1', 11211],
            ];
        }

        if (!$m->addServers($servers)) {
            throw new SettingsException('Memcached servers failed to be added.');
        }
        $fails = 0;
        $statuses = $m->getStats();
        foreach ($servers as $s) {
            if (!isset($statuses[$s[0].':'.$s[1]]) || $statuses[$s[0].':'.$s[1]]['pid'] <= 0) {
                $fails++;
            }
        }

        if ($fails == count($servers)) {
            throw new SettingsException('Could not connect to any of specified Memcached servers.');
        } elseif ($fails > 0); // TODO: Warning to be issued?
    }

    /**
     *   Loads data stored in cache memory.
     *
     * @param string $name
     *
     * @return mixed
     *
     * @throws SettingsException
     */
    public function load(string $name)
    {
        return $this->memcached->get($name);
    }

    /**
     *   Saves data to cache memory.
     *
     * @param string $name
     * @param        $data
     * @param int    $length
     *
     * @return bool
     *
     * @throws SettingsException
     */
    public function save(string $name, $data, int $length): bool
    {
        return $this->memcached->set($name, $data, $length);
    }

    /**
     *   Checks whether or not is saved in cache.
     *
     * @param string $name
     *
     * @return bool
     */
    public function isSaved(string $name): bool
    {
        return false !== $this->load($name) || \Memcached::RES_NOTFOUND !== $this->memcached->getResultCode();
    }
}
