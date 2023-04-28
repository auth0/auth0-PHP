<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\Contract\API\ClientInterface;
use Auth0\SDK\Utility\{HttpClient, HttpRequest};

abstract class ClientAbstract implements ClientInterface
{
    final public function getLastRequest(): ?HttpRequest
    {
        return $this->getHttpClient()->getLastRequest();
    }

    /**
     * Return the HttpClient instance being used for management API requests.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when a Management Token is not able to be obtained
     */
    abstract public function getHttpClient(
    ): HttpClient;
}
