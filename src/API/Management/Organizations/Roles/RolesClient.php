<?php

namespace Auth0\SDK\API\Management\Organizations\Roles;

use Auth0\SDK\API\Management\Organizations\Roles\Members\MembersClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Organizations\Roles\Members\MembersClientInterface;

class RolesClient implements RolesClientInterface
{
    /**
     * @var MembersClient $members
     */
    public MembersClient $members;

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
        $this->members = new MembersClient($this->client, $this->options);
    }

    /**
     * @return MembersClientInterface
     */
    public function getMembers(): MembersClientInterface
    {
        return $this->members;
    }
}
