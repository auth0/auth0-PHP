<?php

namespace Auth0\SDK\API\Management\Tenants;

use Auth0\SDK\API\Management\Tenants\Settings\SettingsClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Tenants\Settings\SettingsClientInterface;

class TenantsClient implements TenantsClientInterface
{
    /**
     * @var SettingsClient $settings
     */
    public SettingsClient $settings;

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
        $this->settings = new SettingsClient($this->client, $this->options);
    }

    /**
     * @return SettingsClientInterface
     */
    public function getSettings(): SettingsClientInterface
    {
        return $this->settings;
    }
}
