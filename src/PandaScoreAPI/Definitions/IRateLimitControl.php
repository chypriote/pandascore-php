<?php

namespace PandaScoreAPI\Definitions;

/**
 *   Interface IRateLimitControl.
 */
interface IRateLimitControl
{
    /**
     *   IRateLimitControl constructor.
     */
    public function __construct();

    /**
     *   Determines whether or not API call can be made.
     *
     * @param string $api_key
     * @param string $resource
     * @param string $endpoint
     *
     * @return bool
     */
    public function canCall(string $api_key, string $resource, string $endpoint): bool;

    /**
     *   Registers that new API call has been made.
     *
     * @param string $api_key
     * @param string $endpoint
     * @param string $app_header
     *
     * @return
     */
    public function registerLimits(string $api_key, string $endpoint, string $app_header);

    /**
     *   Registers that new API call has been made.
     *
     * @param string $api_key
     * @param string $endpoint
     * @param string $app_header
     *
     * @return
     */
    public function registerCall(string $api_key, string $endpoint, string $app_header);
}
