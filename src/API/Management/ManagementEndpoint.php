<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\SDK\Utility\HttpResponsePaginator;

/**
 * Class ManagementEndpoint.
 * Extended by Management API endpoints classes.
 */
abstract class ManagementEndpoint
{
    /**
     * Injected HttpClient instance to use.
     */
    private HttpClient $httpClient;

    /**
     * ManagementEndpoint constructor.
     *
     * @param HttpClient $httpClient HttpClient instance to use.
     */
    public function __construct(
        HttpClient $httpClient
    ) {
        $this->httpClient = $httpClient;
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
}
