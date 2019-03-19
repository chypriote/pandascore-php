<?php

namespace PandaScoreAPI\Definitions;

use PandaScoreAPI\Exceptions\SettingsException;

/**
 *   Class FileCacheProvider.
 */
class FileCacheProvider implements ICacheProvider
{
    /** @var string */
    protected $cacheDir;

    /**
     *   FileCacheProvider constructor.
     *
     * @param string $cacheDir
     *
     * @throws SettingsException
     */
    public function __construct(string $cacheDir)
    {
        if (!is_dir($cacheDir) && !@mkdir($cacheDir, 0777, true) || !@is_writable($cacheDir)) {
            throw new SettingsException("Provided cache directory path '$cacheDir' is invalid/failed to be created.");
        }
        $this->cacheDir = realpath($cacheDir);
    }

    /**
     *   Loads data stored in file.
     *
     * @param string $name
     * @param bool   $returnStorage
     *
     * @return mixed
     *
     * @throws SettingsException
     */
    public function load(string $name, bool $returnStorage = false)
    {
        $path = $this->cacheDir.DIRECTORY_SEPARATOR.$name;
        $res = @fopen($path, 'r');

        if (false == $res) {
            return false;
        }

        /** @var FileCacheStorage $storage */
        $storage = @unserialize(fread($res, filesize($path)));

        fclose($res);
        if ($returnStorage) {
            return $storage;
        }

        return $storage->data;
    }

    /**
     *   Saves data to file.
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
        if ($length <= 0) {
            throw new SettingsException('Expiration time has to be greater than 0.');
        }
        $path = $this->cacheDir.DIRECTORY_SEPARATOR.$name;
        $res = @fopen($path, 'w+');

        if (false == $res) {
            throw new SettingsException("Saving - Cache file ($path) failed to be opened/created.");
        }
        $storage = new FileCacheStorage($data, $length);
        $written = fwrite($res, serialize($storage));
        fclose($res);

        return boolval($written);
    }

    /**
     *   Checks whether or not is $name saved.
     *
     * @param string $name
     *
     * @return bool
     *
     * @throws SettingsException
     */
    public function isSaved(string $name): bool
    {
        if (false == realpath($this->cacheDir.DIRECTORY_SEPARATOR.$name)) {
            return false;
        }

        /** @var FileCacheStorage $storage */
        $storage = $this->load($name, true);

        return $storage->expires_at > time();
    }
}
