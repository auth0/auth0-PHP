<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials;

use Auth0\SDK\API\Management\VerifiableCredentials\Verification\VerificationClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\VerifiableCredentials\Verification\VerificationClientInterface;

class VerifiableCredentialsClient implements VerifiableCredentialsClientInterface
{
    /**
     * @var VerificationClient $verification
     */
    public VerificationClient $verification;

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
        $this->verification = new VerificationClient($this->client, $this->options);
    }

    /**
     * @return VerificationClientInterface
     */
    public function getVerification(): VerificationClientInterface
    {
        return $this->verification;
    }
}
