<?php

namespace Auth0\SDK\API\Management\Flows\Vault;

use Auth0\SDK\API\Management\Flows\Vault\Connections\ConnectionsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Flows\Vault\Connections\ConnectionsClientInterface;

class VaultClient implements VaultClientInterface
{
    /**
     * @var ConnectionsClient $connections
     */
    public ConnectionsClient $connections;

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
        $this->connections = new ConnectionsClient($this->client, $this->options);
    }

    /**
     * @return ConnectionsClientInterface
     */
    public function getConnections(): ConnectionsClientInterface
    {
        return $this->connections;
    }
}
