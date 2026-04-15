<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration related to JWTs for the client.
 */
class ClientJwtConfiguration extends JsonSerializableType
{
    /**
     * @var ?int $lifetimeInSeconds Number of seconds the JWT will be valid for (affects `exp` claim).
     */
    #[JsonProperty('lifetime_in_seconds')]
    private ?int $lifetimeInSeconds;

    /**
     * @var ?bool $secretEncoded Whether the client secret is base64 encoded (true) or unencoded (false).
     */
    #[JsonProperty('secret_encoded')]
    private ?bool $secretEncoded;

    /**
     * @var ?array<string, mixed> $scopes
     */
    #[JsonProperty('scopes'), ArrayType(['string' => 'mixed'])]
    private ?array $scopes;

    /**
     * @var ?value-of<SigningAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private ?string $alg;

    /**
     * @param array{
     *   lifetimeInSeconds?: ?int,
     *   secretEncoded?: ?bool,
     *   scopes?: ?array<string, mixed>,
     *   alg?: ?value-of<SigningAlgorithmEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->lifetimeInSeconds = $values['lifetimeInSeconds'] ?? null;
        $this->secretEncoded = $values['secretEncoded'] ?? null;
        $this->scopes = $values['scopes'] ?? null;
        $this->alg = $values['alg'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getLifetimeInSeconds(): ?int
    {
        return $this->lifetimeInSeconds;
    }

    /**
     * @param ?int $value
     */
    public function setLifetimeInSeconds(?int $value = null): self
    {
        $this->lifetimeInSeconds = $value;
        $this->_setField('lifetimeInSeconds');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSecretEncoded(): ?bool
    {
        return $this->secretEncoded;
    }

    /**
     * @param ?bool $value
     */
    public function setSecretEncoded(?bool $value = null): self
    {
        $this->secretEncoded = $value;
        $this->_setField('secretEncoded');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getScopes(): ?array
    {
        return $this->scopes;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setScopes(?array $value = null): self
    {
        $this->scopes = $value;
        $this->_setField('scopes');
        return $this;
    }

    /**
     * @return ?value-of<SigningAlgorithmEnum>
     */
    public function getAlg(): ?string
    {
        return $this->alg;
    }

    /**
     * @param ?value-of<SigningAlgorithmEnum> $value
     */
    public function setAlg(?string $value = null): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
