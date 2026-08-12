<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Authentication signal details
 */
class SessionAuthenticationSignal extends JsonSerializableType
{
    /**
     * @var ?string $name One of: "federated", "passkey", "pwd", "sms", "email", "mfa", "mock" or a custom method denoted by a URL
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var (
     *    DateTime
     *   |array<string, mixed>
     * )|null $timestamp
     */
    #[JsonProperty('timestamp'), Union('datetime', ['string' => 'mixed'], 'null')]
    private DateTime|array|null $timestamp;

    /**
     * @var ?string $type A specific MFA factor. Only present when "name" is set to "mfa"
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @param array{
     *   name?: ?string,
     *   timestamp?: (
     *    DateTime
     *   |array<string, mixed>
     * )|null,
     *   type?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->timestamp = $values['timestamp'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return (
     *    DateTime
     *   |array<string, mixed>
     * )|null
     */
    public function getTimestamp(): DateTime|array|null
    {
        return $this->timestamp;
    }

    /**
     * @param (
     *    DateTime
     *   |array<string, mixed>
     * )|null $value
     */
    public function setTimestamp(DateTime|array|null $value = null): self
    {
        $this->timestamp = $value;
        $this->_setField('timestamp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?string $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
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
