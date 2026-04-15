<?php

namespace Auth0\SDK\API\Management\Keys;

use Auth0\SDK\API\Management\Keys\CustomSigning\CustomSigningClient;
use Auth0\SDK\API\Management\Keys\Encryption\EncryptionClient;
use Auth0\SDK\API\Management\Keys\Signing\SigningClient;
use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Keys\CustomSigning\CustomSigningClientInterface;
use Auth0\SDK\API\Management\Keys\Encryption\EncryptionClientInterface;
use Auth0\SDK\API\Management\Keys\Signing\SigningClientInterface;

class KeysClient implements KeysClientInterface
{
    /**
     * @var CustomSigningClient $customSigning
     */
    public CustomSigningClient $customSigning;

    /**
     * @var EncryptionClient $encryption
     */
    public EncryptionClient $encryption;

    /**
     * @var SigningClient $signing
     */
    public SigningClient $signing;

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
        $this->customSigning = new CustomSigningClient($this->client, $this->options);
        $this->encryption = new EncryptionClient($this->client, $this->options);
        $this->signing = new SigningClient($this->client, $this->options);
    }

    /**
     * @return CustomSigningClientInterface
     */
    public function getCustomSigning(): CustomSigningClientInterface
    {
        return $this->customSigning;
    }

    /**
     * @return EncryptionClientInterface
     */
    public function getEncryption(): EncryptionClientInterface
    {
        return $this->encryption;
    }

    /**
     * @return SigningClientInterface
     */
    public function getSigning(): SigningClientInterface
    {
        return $this->signing;
    }
}
