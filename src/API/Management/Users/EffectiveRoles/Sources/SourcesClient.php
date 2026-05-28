<?php

namespace Auth0\SDK\API\Management\Users\EffectiveRoles\Sources;

use Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups\GroupsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups\GroupsClientInterface;

class SourcesClient implements SourcesClientInterface
{
    /**
     * @var GroupsClient $groups
     */
    public GroupsClient $groups;

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
        $this->groups = new GroupsClient($this->client, $this->options);
    }

    /**
     * @return GroupsClientInterface
     */
    public function getGroups(): GroupsClientInterface
    {
        return $this->groups;
    }
}
