<?php

namespace PandaScoreAPI\Definitions;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;

/**
 *   Class AsyncRequest.
 */
class AsyncRequest
{
    /** @var Client $client */
    public $client;

    /** @var callable $onFulfilled */
    public $onFulfilled;

    /** @var callable $onRejected */
    public $onRejected;

    /** @var PromiseInterface $promise */
    protected $promise;

    /**
     *   AsyncRequest constructor.
     *
     * @param Client        $client
     * @param callable|null $onFulfilled
     * @param callable|null $onRejected
     */
    public function __construct(Client $client, callable $onFulfilled = null, callable $onRejected = null)
    {
        $this->client = $client;
        $this->onFulfilled = $onFulfilled;
        $this->onRejected = $onRejected;
    }

    /**
     *   Promise getter.
     *
     * @return PromiseInterface
     */
    public function getPromise(): PromiseInterface
    {
        return $this->promise;
    }

    /**
     *   Promise setter.
     *
     * @param PromiseInterface $promise
     *
     * @return AsyncRequest
     */
    public function setPromise(PromiseInterface $promise): self
    {
        $this->promise = $promise;
        $promise->then($this->onFulfilled, $this->onRejected);

        return $this;
    }
}
