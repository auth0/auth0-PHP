<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionJwtSignJwtParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?array<string, mixed> $payload
     */
    #[JsonProperty('payload'), ArrayType(['string' => 'mixed'])]
    private ?array $payload;

    /**
     * @var ?string $subject
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @var ?string $issuer
     */
    #[JsonProperty('issuer')]
    private ?string $issuer;

    /**
     * @var ?string $audience
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $expiresIn
     */
    #[JsonProperty('expires_in')]
    private ?string $expiresIn;

    /**
     * @param array{
     *   connectionId: string,
     *   payload?: ?array<string, mixed>,
     *   subject?: ?string,
     *   issuer?: ?string,
     *   audience?: ?string,
     *   expiresIn?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->payload = $values['payload'] ?? null;
        $this->subject = $values['subject'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->expiresIn = $values['expiresIn'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getPayload(): ?array
    {
        return $this->payload;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setPayload(?array $value = null): self
    {
        $this->payload = $value;
        $this->_setField('payload');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param ?string $value
     */
    public function setSubject(?string $value = null): self
    {
        $this->subject = $value;
        $this->_setField('subject');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIssuer(): ?string
    {
        return $this->issuer;
    }

    /**
     * @param ?string $value
     */
    public function setIssuer(?string $value = null): self
    {
        $this->issuer = $value;
        $this->_setField('issuer');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExpiresIn(): ?string
    {
        return $this->expiresIn;
    }

    /**
     * @param ?string $value
     */
    public function setExpiresIn(?string $value = null): self
    {
        $this->expiresIn = $value;
        $this->_setField('expiresIn');
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
