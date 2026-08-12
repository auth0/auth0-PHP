<?php

namespace Auth0\SDK\API\Management\Anomaly;

use Auth0\SDK\API\Management\Anomaly\Blocks\BlocksClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Anomaly\Blocks\BlocksClientInterface;

class AnomalyClient implements AnomalyClientInterface
{
    /**
     * @var BlocksClient $blocks
     */
    public BlocksClient $blocks;

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
        $this->blocks = new BlocksClient($this->client, $this->options);
    }

    /**
     * @return BlocksClientInterface
     */
    public function getBlocks(): BlocksClientInterface
    {
        return $this->blocks;
    }
}
