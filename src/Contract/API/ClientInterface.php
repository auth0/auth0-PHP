<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\{HttpClient, HttpRequest};

interface ClientInterface
{
    /**
     * Return an instance of SdkConfiguration.
     */
    public function getConfiguration(): SdkConfiguration;

    /**
     * Return an instance of HttpClient.
     */
    public function getHttpClient(): HttpClient;

    /**
     * Return an instance of HttpRequest representing the last issued request.
     */
    public function getLastRequest(): ?HttpRequest;
}
