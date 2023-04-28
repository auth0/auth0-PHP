<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\{HttpClient, HttpRequest, HttpResponsePaginator};

/**
 * Extended by Management API endpoints classes.
 */
abstract class ManagementEndpoint
{
    /**
     * ManagementEndpoint constructor.
     *
     * @param HttpClient $httpClient httpClient instance to use
     */
    final public function __construct(
        private HttpClient $httpClient,
    ) {
    }

    /**
     * Get the injected HttpClient instance.
     */
    final public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Return an instance of HttpRequest representing the last issued request.
     */
    final public function getLastRequest(): ?HttpRequest
    {
        return $this->getHttpClient()->getLastRequest();
    }

    /**
     * Return a ResponsePaginator instance configured for the last HttpRequest.
     */
    final public function getResponsePaginator(): HttpResponsePaginator
    {
        return new HttpResponsePaginator($this->getHttpClient());
    }

    final public static function instance(
        HttpClient $httpClient,
    ): static {
        return new static($httpClient);
    }
}
