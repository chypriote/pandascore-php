<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Class RateLimitControl.
 */
class RateLimitControl implements IRateLimitControl
{
    /** @var RateLimitStorage $storage */
    protected $storage;

    /**
     *   RateLimitControl constructor.
     */
    public function __construct()
    {
        $this->storage = new RateLimitStorage();

        //  Set limits
        //$this->storage->init();
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
        return $this->storage->canCall($api_key, $resource, $endpoint);
    }

    /**
     *   Registers that new API call has been made.
     *
     * @param string $api_key
     * @param string $endpoint
     * @param string $app_limit_header
     * @param string $method_limit_header
     */
    public function registerLimits(string $api_key, string $endpoint, string $app_limit_header = null, string $method_limit_header = null)
    {
        if ($app_limit_header) {
            $this->storage->registerAppLimits($api_key, $app_limit_header);
        }

        if ($method_limit_header) {
            $this->storage->registerMethodLimits($api_key, $endpoint, $method_limit_header);
        }
    }

    /**
     *   Registers that new API call has been made.
     *
     * @param string $api_key
     * @param string $endpoint
     * @param string $app_count_header
     * @param string $method_count_header
     */
    public function registerCall(string $api_key, string $endpoint, string $app_count_header = null, string $method_count_header = null)
    {
        $this->storage->registerCall($api_key, $endpoint, $app_count_header, $method_count_header);
    }
}
