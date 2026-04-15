<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormWidgetAuth0VerifiableCredentialsConfig extends JsonSerializableType
{
    /**
     * @var string $url
     */
    #[JsonProperty('url')]
    private string $url;

    /**
     * @var ?float $size
     */
    #[JsonProperty('size')]
    private ?float $size;

    /**
     * @var string $alternateText
     */
    #[JsonProperty('alternate_text')]
    private string $alternateText;

    /**
     * @var string $accessToken
     */
    #[JsonProperty('access_token')]
    private string $accessToken;

    /**
     * @var string $verificationId
     */
    #[JsonProperty('verification_id')]
    private string $verificationId;

    /**
     * @var ?float $maxWait
     */
    #[JsonProperty('max_wait')]
    private ?float $maxWait;

    /**
     * @param array{
     *   url: string,
     *   alternateText: string,
     *   accessToken: string,
     *   verificationId: string,
     *   size?: ?float,
     *   maxWait?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->url = $values['url'];
        $this->size = $values['size'] ?? null;
        $this->alternateText = $values['alternateText'];
        $this->accessToken = $values['accessToken'];
        $this->verificationId = $values['verificationId'];
        $this->maxWait = $values['maxWait'] ?? null;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $value
     */
    public function setUrl(string $value): self
    {
        $this->url = $value;
        $this->_setField('url');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getSize(): ?float
    {
        return $this->size;
    }

    /**
     * @param ?float $value
     */
    public function setSize(?float $value = null): self
    {
        $this->size = $value;
        $this->_setField('size');
        return $this;
    }

    /**
     * @return string
     */
    public function getAlternateText(): string
    {
        return $this->alternateText;
    }

    /**
     * @param string $value
     */
    public function setAlternateText(string $value): self
    {
        $this->alternateText = $value;
        $this->_setField('alternateText');
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $value
     */
    public function setAccessToken(string $value): self
    {
        $this->accessToken = $value;
        $this->_setField('accessToken');
        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationId(): string
    {
        return $this->verificationId;
    }

    /**
     * @param string $value
     */
    public function setVerificationId(string $value): self
    {
        $this->verificationId = $value;
        $this->_setField('verificationId');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getMaxWait(): ?float
    {
        return $this->maxWait;
    }

    /**
     * @param ?float $value
     */
    public function setMaxWait(?float $value = null): self
    {
        $this->maxWait = $value;
        $this->_setField('maxWait');
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
