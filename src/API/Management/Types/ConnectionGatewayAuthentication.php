<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Token-based authentication settings to be applied when connection is using an sms strategy.
 */
class ConnectionGatewayAuthentication extends JsonSerializableType
{
    /**
     * @var string $method The Authorization header type.
     */
    #[JsonProperty('method')]
    private string $method;

    /**
     * @var ?string $subject The subject to be added to the JWT payload.
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @var string $audience The audience to be added to the JWT payload.
     */
    #[JsonProperty('audience')]
    private string $audience;

    /**
     * @var string $secret The secret to be used for signing tokens.
     */
    #[JsonProperty('secret')]
    private string $secret;

    /**
     * @var ?bool $secretBase64Encoded Set to true if the provided secret is base64 encoded.
     */
    #[JsonProperty('secret_base64_encoded')]
    private ?bool $secretBase64Encoded;

    /**
     * @param array{
     *   method: string,
     *   audience: string,
     *   secret: string,
     *   subject?: ?string,
     *   secretBase64Encoded?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
        $this->subject = $values['subject'] ?? null;
        $this->audience = $values['audience'];
        $this->secret = $values['secret'];
        $this->secretBase64Encoded = $values['secretBase64Encoded'] ?? null;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $value
     */
    public function setMethod(string $value): self
    {
        $this->method = $value;
        $this->_setField('method');
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
     * @return string
     */
    public function getAudience(): string
    {
        return $this->audience;
    }

    /**
     * @param string $value
     */
    public function setAudience(string $value): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $value
     */
    public function setSecret(string $value): self
    {
        $this->secret = $value;
        $this->_setField('secret');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSecretBase64Encoded(): ?bool
    {
        return $this->secretBase64Encoded;
    }

    /**
     * @param ?bool $value
     */
    public function setSecretBase64Encoded(?bool $value = null): self
    {
        $this->secretBase64Encoded = $value;
        $this->_setField('secretBase64Encoded');
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
