<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowActionJwtVerifyJwtParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var string $token
     */
    #[JsonProperty('token')]
    private string $token;

    /**
     * @var ?string $audience
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $issuer
     */
    #[JsonProperty('issuer')]
    private ?string $issuer;

    /**
     * @param array{
     *   connectionId: string,
     *   token: string,
     *   audience?: ?string,
     *   issuer?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->token = $values['token'];
        $this->audience = $values['audience'] ?? null;
        $this->issuer = $values['issuer'] ?? null;
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
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $value
     */
    public function setToken(string $value): self
    {
        $this->token = $value;
        $this->_setField('token');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
