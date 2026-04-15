<?php

namespace Auth0\SDK\API\Management\Emails;

use Auth0\SDK\API\Management\Emails\Provider\ProviderClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Emails\Provider\ProviderClientInterface;

class EmailsClient implements EmailsClientInterface
{
    /**
     * @var ProviderClient $provider
     */
    public ProviderClient $provider;

    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
        $this->provider = new ProviderClient($this->client, $this->options);
    }

    /**
     * @return ProviderClientInterface
     */
    public function getProvider(): ProviderClientInterface
    {
        return $this->provider;
    }
}
