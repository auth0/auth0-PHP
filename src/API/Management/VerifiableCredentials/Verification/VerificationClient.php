<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials\Verification;

use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\TemplatesClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\TemplatesClientInterface;

class VerificationClient implements VerificationClientInterface
{
    /**
     * @var TemplatesClient $templates
     */
    public TemplatesClient $templates;

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
        $this->templates = new TemplatesClient($this->client, $this->options);
    }

    /**
     * @return TemplatesClientInterface
     */
    public function getTemplates(): TemplatesClientInterface
    {
        return $this->templates;
    }
}
