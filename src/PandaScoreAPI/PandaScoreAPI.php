<?php

namespace PandaScoreAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception as GuzzleHttpExceptions;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
use PandaScoreAPI\Definitions\AsyncRequest;
use PandaScoreAPI\Definitions\CallCacheControl;
use PandaScoreAPI\Definitions\FileCacheProvider;
use PandaScoreAPI\Definitions\ICacheProvider;
use PandaScoreAPI\Definitions\ICallCacheControl;
use PandaScoreAPI\Definitions\IRateLimitControl;
use PandaScoreAPI\Definitions\MemcachedCacheProvider;
use PandaScoreAPI\Definitions\RateLimitControl;
use PandaScoreAPI\Exceptions\GeneralException;
use PandaScoreAPI\Exceptions\RequestException;
use PandaScoreAPI\Exceptions\ServerException;
use PandaScoreAPI\Exceptions\ServerLimitException;
use PandaScoreAPI\Exceptions\SettingsException;
use PandaScoreAPI\Objects\IApiObjectExtension;
use Psr\Http\Message\ResponseInterface;

/**
 *   Class PandaScoreAPI.
 */
class PandaScoreAPI
{
    /**
     * Constants for cURL requests.
     */
    const
        METHOD_GET = 'GET',
        METHOD_POST = 'POST',
        METHOD_PUT = 'PUT',
        METHOD_DELETE = 'DELETE';

    /**
     * Settings constants.
     */
    const
        SET_VERIFY_SSL = 'SET_VERIFY_SSL',            /* Specifies whether or not to verify SSL (verification often fails on localhost) **/
        SET_TOKEN = 'SET_TOKEN',                   /* API key used by default **/
        SET_KEY_INCLUDE_TYPE = 'SET_KEY_INCLUDE_TYPE',      /* API key request include type (header, query) **/
        SET_CACHE_PROVIDER = 'SET_CACHE_PROVIDER',        /* Specifies CacheProvider class name **/
        SET_CACHE_PROVIDER_PARAMS = 'SET_CACHE_PROVIDER_PARAMS', /* Specifies parameters passed to CacheProvider class when initializing **/
        SET_CACHE_RATELIMIT = 'SET_CACHE_RATELIMIT',       /* Used to set whether or not to saveCallData and check API key's rate limit **/
        SET_CACHE_CALLS = 'SET_CACHE_CALLS',           /* Used to set whether or not to temporary saveCallData API call's results **/
        SET_CACHE_CALLS_LENGTH = 'SET_CACHE_CALLS_LENGTH',    /* Specifies for how long are call results saved **/
        SET_EXTENSIONS = 'SET_EXTENSIONS',            /* Specifies ApiObject's extensions **/
        SET_CALLBACKS_BEFORE = 'SET_CALLBACKS_BEFORE',
        SET_CALLBACKS_AFTER = 'SET_CALLBACKS_AFTER',
        SET_API_BASEURL = 'SET_API_BASEURL';

    const
        //  List of required setting keys
        SETTINGS_REQUIRED = [
            self::SET_TOKEN,
        ],
        //  List of allowed setting keys
        SETTINGS_ALLOWED = [
        self::SET_TOKEN,
        self::SET_VERIFY_SSL,
        self::SET_KEY_INCLUDE_TYPE,
        self::SET_CACHE_PROVIDER,
        self::SET_CACHE_PROVIDER_PARAMS,
        self::SET_CACHE_RATELIMIT,
        self::SET_CACHE_CALLS,
        self::SET_CACHE_CALLS_LENGTH,
        self::SET_EXTENSIONS,
        self::SET_CALLBACKS_BEFORE,
        self::SET_CALLBACKS_AFTER,
        self::SET_API_BASEURL,
    ],
        SETTINGS_INIT_ONLY = [
        self::SET_API_BASEURL,
    ];

    /**
     * Available API key inclusion options.
     */
    const
        KEY_AS_QUERY_PARAM = 'keyInclude:query',
        KEY_AS_HEADER = 'keyInclude:header';

    /**
     * Available cache provider options.
     */
    const
        CACHE_PROVIDER_FILE = FileCacheProvider::class,
        CACHE_PROVIDER_MEMCACHED = MemcachedCacheProvider::class;

    /**
     * Cache constants used to identify cache target.
     */
    const
        CACHE_KEY_RLC = 'rate-limit.cache',
        CACHE_KEY_CCC = 'api-calls.cache';

    /**
     * Available API headers.
     */
    const
        HEADER_AUTHORIZATION = 'Authorization',
        HEADER_APP_RATELIMIT = 'X-Rate-Limit-Remaining';

    /**
     *   Available resource list.
     *
     * @var array
     */
    protected $resources = [
        self::RESOURCE_LEAGUE,
    ];

    /**
     *   Contains current settings.
     *
     * @var array
     */
    protected $settings = [
        self::SET_API_BASEURL => 'api.pandascore.co',
        self::SET_KEY_INCLUDE_TYPE => self::KEY_AS_HEADER,
        self::SET_VERIFY_SSL => true,
    ];

    /** @var ICacheProvider $cache */
    protected $cache;

    /** @var IRateLimitControl $rlc */
    protected $rlc;

    /** @var int $rlc_savetime */
    protected $rlc_savetime = 3600;

    /** @var ICallCacheControl $ccc */
    protected $ccc;

    /** @var int $ccc_savetime */
    protected $ccc_savetime = 60;

    /** @var string $endpoint */
    protected $endpoint;

    /** @var string $resource */
    protected $resource;

    /** @var string $resource_endpoint */
    protected $resource_endpoint;

    /** @var string $used_key */
    protected $used_key = self::SET_TOKEN;

    /** @var string $used_method */
    protected $used_method;

    /** @var Client $guzzle */
    protected $guzzle;

    /** @var AsyncRequest $next_async_request */
    protected $next_async_request;

    /** @var AsyncRequest[] $async_requests */
    protected $async_requests = [];

    /** @var Client[] $async_clients */
    protected $async_clients = [];

    /** @var array $query_data */
    protected $query_data = [];

    /** @var array $post_data */
    protected $post_data = [];

    /** @var array $result_data */
    protected $result_data;

    /** @var string $result_data */
    protected $result_data_raw;

    /** @var array $result_headers */
    protected $result_headers;

    /** @var int $result_code */
    protected $result_code;

    /** @var callable[] $beforeCall */
    protected $beforeCall = [];

    /** @var callable[] $afterCall */
    protected $afterCall = [];

    /**
     *   PandaScoreAPI constructor.
     *
     * @param array $settings
     *
     * @throws SettingsException
     * @throws GeneralException
     */
    public function __construct(array $settings)
    {
        //  Checks if required settings are present
        foreach (self::SETTINGS_REQUIRED as $key) {
            if (false === array_search($key, array_keys($settings), true)) {
                throw new SettingsException("Required settings parameter '$key' is missing!");
            }
        }
        //  Checks SET_KEY_INCLUDE_TYPE value
        if (isset($settings[self::SET_KEY_INCLUDE_TYPE])
            && false == in_array($settings[self::SET_KEY_INCLUDE_TYPE], [self::KEY_AS_HEADER, self::KEY_AS_QUERY_PARAM], true)) {
            throw new SettingsException("Value of settings parameter '".self::SET_KEY_INCLUDE_TYPE."' is not valid.");
        }

        //  Checks SET_EXTENSIONS value
        if (isset($settings[self::SET_EXTENSIONS])) {
            if (!is_array($settings[self::SET_EXTENSIONS])) {
                throw new SettingsException("Value of settings parameter '".self::SET_EXTENSIONS."' is not valid.");
            } else {
                foreach ($settings[self::SET_EXTENSIONS] as $api_object => $extender) {
                    try {
                        $ref = new \ReflectionClass($extender);
                        if (false == $ref->implementsInterface(IApiObjectExtension::class)) {
                            throw new SettingsException("ObjectExtender '$extender' does not implement IApiObjectExtension interface.");
                        }
                        if (false == $ref->isInstantiable()) {
                            throw new SettingsException("ObjectExtender '$extender' is not instantiable.");
                        }
                    } catch (\ReflectionException $ex) {
                        throw new SettingsException("Value of settings parameter '".self::SET_EXTENSIONS."' is not valid.", 0, $ex);
                    }
                }
            }
        }

        //  Assigns allowed settings
        foreach (self::SETTINGS_ALLOWED as $key) {
            if (isset($settings[$key])) {
                $this->settings[$key] = $settings[$key];
            }
        }

        // TODO: Guzzle Client settings?
        $this->guzzle = new Client();

        //  Some caching will be made, let's set up cache provider
        if ($this->getSetting(self::SET_CACHE_CALLS) || $this->getSetting(self::SET_CACHE_RATELIMIT)) {
            $this->_setupCacheProvider();
        }

        //  Call data are going to be cached
        if ($this->getSetting(self::SET_CACHE_CALLS)) {
            $this->_setupCacheCalls();
        }

        //  Set up before calls callbacks
        $this->_setupBeforeCalls();

        //  Set up afterl calls callbacks
        $this->_setupAfterCalls();
    }

    /**
     *   Saves required cache objects.
     *
     * @internal
     */
    protected function saveCache()
    {
        if ($this->getSetting(self::SET_CACHE_RATELIMIT, false)) {
            //  save RateLimitControl
            $this->cache->save(self::CACHE_KEY_RLC, $this->rlc, $this->rlc_savetime);
        }

        if ($this->getSetting(self::SET_CACHE_CALLS, false)) {
            //  save CallCacheControl
            $this->cache->save(self::CACHE_KEY_CCC, $this->ccc, $this->ccc_savetime);
        }
    }

    /**
     *   Loads required cache objects.
     *
     * @internal
     */
    protected function loadCache()
    {
        if ($this->getSetting(self::SET_CACHE_RATELIMIT, false)) {
            //  ratelimit cache enabled, try to load already existing object
            $rlc = $this->cache->load(self::CACHE_KEY_RLC);
            if (false == $rlc) {
                //  nothing loaded, creating new instance
                $rlc = new RateLimitControl();
            }

            $this->rlc = $rlc;
        }

        if ($this->getSetting(self::SET_CACHE_CALLS, false)) {
            //  call cache enabled, try to load already existing object
            $callCache = $this->cache->load(self::CACHE_KEY_CCC);
            if (false == $callCache) {
                //  nothing loaded, creating new instance
                $callCache = new CallCacheControl();
            }

            $this->ccc = $callCache;
        }
    }

    /**
     *   Returns vaue of requested key from settings.
     *
     * @param string     $name
     * @param mixed|null $defaultValue
     *
     * @return mixed
     */
    public function getSetting(string $name, $defaultValue = null)
    {
        return $this->isSettingSet($name)
            ? $this->settings[$name]
            : $defaultValue;
    }

    /**
     *   Sets new value for specified key in settings.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return PandaScoreAPI
     *
     * @throws SettingsException
     */
    public function setSetting(string $name, $value): self
    {
        if (in_array($name, self::SETTINGS_INIT_ONLY)) {
            throw new SettingsException("Settings option '$name' can only be set on initialization of the library.");
        }
        $this->settings[$name] = $value;

        return $this;
    }

    /**
     *   Sets new values for specified set of keys in settings.
     *
     * @param array $values
     *
     * @return PandaScoreAPI
     *
     * @throws SettingsException
     */
    public function setSettings(array $values): self
    {
        foreach ($values as $name => $value) {
            $this->setSetting($name, $value);
        }

        return $this;
    }

    /**
     *   Checks if specified settings key is set.
     *
     * @param string $name
     *
     * @return bool
     */
    public function isSettingSet(string $name): bool
    {
        return isset($this->settings[$name]) && !is_null($this->settings[$name]);
    }

    /**
     *   Sets call target for script.
     *
     * @param string $endpoint
     *
     * @return PandaScoreAPI
     */
    protected function setEndpoint(string $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     *   Sets call resource for target endpoint.
     *
     * @param string $resource
     * @param string $endpoint
     *
     * @return PandaScoreAPI
     */
    protected function setResource(string $resource, string $endpoint): self
    {
        $this->resource = $resource;
        $this->resource_endpoint = $endpoint;

        return $this;
    }

    /**
     *   Returns call resource for last call.
     *
     * @return string
     */
    protected function getResource(): string
    {
        return $this->resource;
    }

    /**
     *   Returns call resource and endpoint for last call.
     *
     * @return string
     */
    protected function getResourceEndpoint(): string
    {
        return $this->resource.$this->resource_endpoint;
    }

    /**
     *   Sets POST/PUT data.
     *
     * @param string $data
     *
     * @return PandaScoreAPI
     */
    protected function setData(string $data): self
    {
        $this->post_data = $data;

        return $this;
    }

    /**
     *   Returns raw getResult data from the last call.
     *
     * @return mixed
     */
    public function getResult()
    {
        return $this->result_data;
    }

    /**
     * ==================================================================d=d=
     *     API Call Methods
     * ==================================================================d=d=.
     **/

    /**
     * @internal
     *
     *   Makes call to PandaScoreAPI
     *
     * @param string $method
     *
     * @return PromiseInterface
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     */
    protected function makeCall(string $method = self::METHOD_GET): PromiseInterface
    {
        $this->used_method = $method;
        $this->used_key = self::SET_TOKEN;

        $requestHeaders = [];
        $requestPromise = null;
        $url = $this->_getCallUrl($requestHeaders);
        $requestHash = md5($url);

        if (!$requestPromise && $this->getSetting(self::SET_CACHE_CALLS) && $this->ccc && $this->ccc->isCallCached($requestHash)) {
            // calls are cached and this request is saved in cache
            $this->processCallResult([], $this->ccc->loadCallData($requestHash), 200);
            $requestPromise = new FulfilledPromise($this->getResult());
        }

        if (!$requestPromise) {
            // calls are not cached or this request is not cached
            // perform call to PandaScore API
            $guzzle = $this->guzzle;
            if ($this->next_async_request) {
                $guzzle = $this->next_async_request->client;
            }

            $this->_beforeCall($url, $requestHash);

            $options[RequestOptions::VERIFY] = $this->getSetting(self::SET_VERIFY_SSL);
            $options[RequestOptions::HEADERS] = $requestHeaders;
            if ($this->post_data) {
                $options[RequestOptions::BODY] = $this->post_data;
            }

            // Create HTTP request
            $requestPromise = $guzzle->requestAsync(
                $method,
                $url,
                $options
            );

            $requestPromise = $requestPromise->then(function (ResponseInterface $response) use ($url, $requestHash) {
                $this->processCallResult($response->getHeaders(), $response->getBody(), $response->getStatusCode());
                $this->_afterCall($url, $requestHash);

                return $this->getResult();
            });
        }

        // If request fails, try to process it and raise exceptions
        $requestPromise = $requestPromise->otherwise(function ($ex) {
            /** @var \Exception $ex */
            if ($ex instanceof GuzzleHttpExceptions\RequestException) {
                $responseHeaders = [];
                $responseBody = null;
                $responseCode = $ex->getCode();

                if ($response = $ex->getResponse()) {
                    $responseHeaders = $response->getHeaders();
                    $responseBody = $response->getBody();
                }

                $this->processCallResult($responseHeaders, $responseBody, $responseCode);
                throw new RequestException("PandaScoreAPI: Request error occured - {$ex->getMessage()}", $ex->getCode(), $ex);
            } elseif ($ex instanceof GuzzleHttpExceptions\ServerException) {
                throw new ServerException("PandaScoreAPI: Server error occured {$ex->getMessage()}", $ex->getCode(), $ex);
            }

            throw new RequestException("PandaScoreAPI: Request could not be sent - {$ex->getMessage()}", $ex->getCode(), $ex);
        });

        if ($this->next_async_request) {
            return $requestPromise;
        }

        $this->query_data = [];
        $this->post_data = null;

        return $requestPromise;
    }

    /**
     * @internal
     *
     * @param array  $response_headers
     * @param string $response_body
     * @param int    $response_code
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     */
    protected function processCallResult(array $response_headers = null, string $response_body = null, int $response_code = 0)
    {
        array_walk($response_headers, function (&$value) {
            if (is_array($value) && 1 == count($value)) {
                $value = $value[0];
            }
        });

        $this->result_code = $response_code;
        $this->result_headers = $response_headers;
        $this->result_data_raw = $response_body;
        $this->result_data = json_decode($response_body, true);

        $message = @$this->result_data['status']['message'] ?: '';
        switch ($response_code) {
            case 503:
                throw new ServerException('PandaScoreAPI: Service is temporarily unavailable.', $response_code);
            case 500:
                throw new ServerException('PandaScoreAPI: Internal server error occured.', $response_code);
            case 429:
                throw new ServerLimitException("PandaScoreAPI: Rate limit for this API key was exceeded. $message", $response_code);
            case 415:
                throw new RequestException("PandaScoreAPI: Unsupported media type. $message", $response_code);
            case 404:
                throw new RequestException("PandaScoreAPI: Not Found. $message", $response_code);
            case 403:
                throw new RequestException("PandaScoreAPI: Forbidden. $message", $response_code);
            case 401:
                throw new RequestException("PandaScoreAPI: Unauthorized. $message", $response_code);
            case 400:
                throw new RequestException("PandaScoreAPI: Request is invalid. $message", $response_code);
            default:
                if ($response_code >= 400) {
                    throw new RequestException("PandaScoreAPI: Unspecified error occured ({$response_code}). $message", $response_code);
                }
        }
    }

    /**
     * @internal
     *
     *   Builds API call URL based on current settings
     *
     * @param array $requestHeaders
     *
     * @return string
     */
    public function _getCallUrl(&$requestHeaders = []): string
    {
        $requestHeaders = [];
        //  API base url
        $url_basePart = $this->getSetting(self::SET_API_BASEURL);

        //  Query parameters
        $url_queryPart = '';
        foreach ($this->query_data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $v) {
                    $url_queryPart .= "&$key=$v";
                }
            } else {
                $url_queryPart .= "&$key=$value";
            }
        }
        $url_queryPart = substr($url_queryPart, 1);

        //  API key
        $url_keyPart = '';
        if (self::KEY_AS_QUERY_PARAM === $this->getSetting(self::SET_KEY_INCLUDE_TYPE)) {
            //  API key is to be included as query parameter
            $url_keyPart = '?api_key='.$this->getSetting($this->used_key);
            if (!empty($url_queryPart)) {
                $url_keyPart .= '&';
            }
        } elseif (self::KEY_AS_HEADER === $this->getSetting(self::SET_KEY_INCLUDE_TYPE)) {
            //  API key is to be included as request header
            $requestHeaders[self::HEADER_AUTHORIZATION] = 'Bearer '.$this->getSetting($this->used_key);
            if (!empty($url_queryPart)) {
                $url_keyPart = '?';
            }
        }

        return 'https://'.$url_basePart.$this->endpoint.$url_keyPart.$url_queryPart;
    }

    /**
     * @internal
     *
     *   Processes 'beforeCall' callbacks
     *
     * @param string $url
     * @param string $requestHash
     *
     * @throws RequestException
     */
    protected function _beforeCall(string $url, string $requestHash)
    {
        foreach ($this->beforeCall as $function) {
            if (false === $function($this, $url, $requestHash)) {
                throw new RequestException('Request terminated by beforeCall function.');
            }
        }
    }

    /**
     * @internal
     *
     *   Processes 'afterCall' callbacks
     *
     * @param string $url
     * @param string $requestHash
     */
    protected function _afterCall(string $url, string $requestHash)
    {
        foreach ($this->afterCall as $function) {
            $function($this, $url, $requestHash);
        }
    }

    public function resolveOrEnqueuePromise(PromiseInterface $promise, callable $resultCallback = null)
    {
        if ($this->next_async_request) {
            $promise = $promise->then(function ($result) use ($resultCallback) {
                return $resultCallback ? $resultCallback($result) : null;
            });
            $this->next_async_request->setPromise($promise);

            return $this->next_async_request = null;
        }

        return $resultCallback ? $resultCallback($promise->wait()) : null;
    }

    /**
     * ==================================================================d=d=
     *     Setup Methods
     * ==================================================================d=d=.
     **/

    /**
     *   Initializes library cache provider.
     *
     * @throws SettingsException
     */
    protected function _setupCacheProvider()
    {
        //  If something should be cached
        if (false == $this->isSettingSet(self::SET_CACHE_PROVIDER)
            || (self::CACHE_PROVIDER_FILE == $this->getSetting(self::SET_CACHE_PROVIDER) && false == $this->isSettingSet(self::SET_CACHE_PROVIDER_PARAMS))) {
            //  Set default cache provider if not already set
            $this->setSettings([
                self::SET_CACHE_PROVIDER => self::CACHE_PROVIDER_FILE,
                self::SET_CACHE_PROVIDER_PARAMS => [
                    __DIR__.DIRECTORY_SEPARATOR.'cache'.DIRECTORY_SEPARATOR,
                ],
            ]);
        }

        try {
            //  Creates reflection of specified cache provider (can be user-made)
            $cacheProvider = new \ReflectionClass($this->getSetting(self::SET_CACHE_PROVIDER));
            //  Checks if this cache provider implements required interface
            if (false == $cacheProvider->implementsInterface(ICacheProvider::class)) {
                throw new SettingsException('Provided CacheProvider does not implement ICacheProvider interface.');
            }
            //  Gets default parameters
            $params = $this->getSetting(self::SET_CACHE_PROVIDER_PARAMS, []);
            //  and creates new instance of this cache provider
            $this->cache = $cacheProvider->newInstanceArgs($params);
        } catch (\ReflectionException $ex) {
            //  probably problem when instantiating the class
            throw new SettingsException('Failed to initialize CacheProvider class: '.$ex->getMessage().'.', 0, $ex);
        } catch (\Exception $ex) {
            //  something went wrong when initializing the class - invalid settings, etc.
            throw new SettingsException('CacheProvider class failed to be initialized: '.$ex->getMessage().'.', 0, $ex);
        }

        //  Loads existing cache or creates new storages
        $this->loadCache();
    }

    /**
     *   Initializes library call caching.
     *
     * @throws SettingsException
     */
    public function _setupCacheCalls()
    {
        if (false == $this->isSettingSet(self::SET_CACHE_CALLS_LENGTH)) {
            //  Value is not set, setting default values
            $this->setSetting(self::SET_CACHE_CALLS_LENGTH, [
                self::RESOURCE_LEAGUE => 60 * 10,
            ]);
        } else {
            $lengths = $this->getSetting(self::SET_CACHE_CALLS_LENGTH);

            //  Resource caching lengths are specified
            if (is_array($lengths)) {
                array_walk($lengths, function ($value, $key) {
                    if ((!is_integer($value) && !is_null($value)) || false == strpos($key, ':')) {
                        throw new SettingsException("Value of settings parameter '".self::SET_CACHE_CALLS_LENGTH."' is not valid.");
                    }
                });
            } elseif (!is_integer($lengths)) {
                throw new SettingsException("Value of settings parameter '".self::SET_CACHE_CALLS_LENGTH."' is not valid.");
            }
            if (is_array($lengths)) {
                //  The value is array, let's check it
                $new_value = [];
                $resources = $this->resources;
                foreach ($resources as $resource) {
                    if (isset($lengths[$resource])) {
                        if ($lengths[$resource] > $this->ccc_savetime) {
                            $this->ccc_savetime = $lengths[$resource];
                        }

                        $new_value[$resource] = $lengths[$resource];
                    } else {
                        $new_value[$resource] = null;
                    }
                }

                $this->setSetting(self::SET_CACHE_CALLS_LENGTH, $new_value);
            } else {
                //  The value is numeric, lets set the same limit to all resources
                $new_value = [];
                $resources = $this->resources;
                $this->ccc_savetime = $lengths;

                foreach ($resources as $resource) {
                    $new_value[$resource] = $lengths;
                }

                $this->setSetting(self::SET_CACHE_CALLS_LENGTH, $new_value);
            }
        }
    }

    /**
     *   Sets up internal callbacks - before the call is made.
     *
     * @throws SettingsException
     */
    protected function _setupBeforeCalls()
    {
        //  API rate limit check before call is made
        $this->beforeCall[] = function () {
            if ($this->getSetting(self::SET_CACHE_RATELIMIT) && false != $this->rlc) {
                if (false == $this->rlc->canCall($this->getSetting($this->used_key), $this->getResource(), $this->getResourceEndpoint())) {
                    throw new ServerLimitException('API call rate limit would be exceeded by this call.');
                }
            }
        };

        $callbacks = $this->getSetting(self::SET_CALLBACKS_BEFORE, []);
        if (false == is_array($callbacks)) {
            $callbacks = [$callbacks];
        }

        foreach ($callbacks as $c) {
            if (false == is_callable($c)) {
                throw new SettingsException("Provided value of '".self::SET_CALLBACKS_BEFORE."' option is not valid.");
            }
            $this->beforeCall[] = $c;
        }
    }

    /**
     *   Sets up internal callbacks - after the call is made.
     *
     * @throws SettingsException
     */
    protected function _setupAfterCalls()
    {
        //  Save ratelimits received with this request if RateLimit cache is enabled
        $this->afterCall[] = function () {
            if ($this->getSetting(self::SET_CACHE_RATELIMIT, false) && false != $this->rlc) {
                $this->rlc->registerLimits($this->getSetting($this->used_key), $this->getResourceEndpoint(), @$this->result_headers[self::HEADER_APP_RATELIMIT]);
            }
        };

        //  Register, that call has been made if RateLimit cache is enabled
        $this->afterCall[] = function () {
            if ($this->getSetting(self::SET_CACHE_RATELIMIT, false) && false != $this->rlc) {
                $this->rlc->registerCall($this->getSetting($this->used_key), $this->getResourceEndpoint(), @$this->result_headers[self::HEADER_APP_RATELIMIT]);
            }
        };

        //  Save result data, if CallCache is enabled and when the old result has expired
        $this->afterCall[] = function () {
            $requestHash = func_get_arg(2);
            if ($this->getSetting(self::SET_CACHE_CALLS, false) && false != $this->ccc && false == $this->ccc->isCallCached($requestHash)) {
                //  Get information for how long to save the data
                if ($timeInterval = @$this->getSetting(self::SET_CACHE_CALLS_LENGTH)[$this->getResource()]) {
                    $this->ccc->saveCallData($requestHash, $this->result_data_raw, $timeInterval);
                }
            }
        };

        //  Save newly cached data
        $this->afterCall[] = function () {
            if ($this->getSetting(self::SET_CACHE_CALLS, false) || $this->getSetting(self::SET_CACHE_RATELIMIT, false)) {
                $this->saveCache();
            }
        };

        $callbacks = $this->getSetting(self::SET_CALLBACKS_AFTER, []);
        if (false == is_array($callbacks)) {
            $callbacks = [$callbacks];
        }

        foreach ($callbacks as $c) {
            if (false == is_callable($c)) {
                throw new SettingsException("Provided value of '".self::SET_CALLBACKS_AFTER."' option is not valid.");
            }
            $this->afterCall[] = $c;
        }
    }

    /**
     * ==================================================================d=d=
     *     League Endpoint Methods.
     *
     *     @see https://developers.pandascore.co/doc/#tag/Leagues
     * ==================================================================d=d=
     **/
    const RESOURCE_LEAGUE = 'league';

    /**
     *   List leagues.
     *
     * @return Objects\LeagueDto
     *
     * @throws SettingsException
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues
     */
    public function listLeagues()
    {
        $resultPromise = $this->setEndpoint('/leagues')
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   Get single league object for a given league ID.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws SettingsException
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug
     */
    public function getLeague(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List matches of the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws SettingsException
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches
     */
    public function getLeagueMatches(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/matches")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List past matches of the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws SettingsException
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_past
     */
    public function getLeaguePastMatches(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/matches/past")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/past')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List upcoming matches for the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws SettingsException
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_upcoming
     */
    public function getLeagueUpcomingMatches(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/matches/upcoming")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/upcoming')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List running matches of the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_matches_running
     */
    public function getLeagueRunningMatches(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/matches/running")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/matches/running')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List series for the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_series
     */
    public function getLeagueSeries(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/series")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/series')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }

    /**
     *   List tournaments for the given league.
     *
     * @param int $league_id
     *
     * @return Objects\LeagueDto
     *
     * @throws RequestException
     * @throws ServerException
     * @throws ServerLimitException
     * @throws GeneralException
     *
     * @see https://developers.pandascore.co/doc/#operation/get_leagues_leagueIdOrSlug_tournaments
     */
    public function getLeagueTournaments(int $league_id)
    {
        $resultPromise = $this->setEndpoint("/leagues/{$league_id}/tournaments")
            ->setResource(self::RESOURCE_LEAGUE, '/leagues/%s/tournaments')
            ->makeCall();

        return $this->resolveOrEnqueuePromise($resultPromise, function (array $result) {
            return new Objects\LeagueDto($result, $this);
        });
    }
}
