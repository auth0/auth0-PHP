<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Device used while issuing/exchanging the refresh token
 */
class RefreshTokenDevice extends JsonSerializableType
{
    /**
     * @var ?string $initialIp First IP address associated with the refresh token
     */
    #[JsonProperty('initial_ip')]
    private ?string $initialIp;

    /**
     * @var ?string $initialAsn First autonomous system number associated with the refresh token
     */
    #[JsonProperty('initial_asn')]
    private ?string $initialAsn;

    /**
     * @var ?string $initialUserAgent First user agent associated with the refresh token
     */
    #[JsonProperty('initial_user_agent')]
    private ?string $initialUserAgent;

    /**
     * @var ?string $lastIp Last IP address associated with the refresh token
     */
    #[JsonProperty('last_ip')]
    private ?string $lastIp;

    /**
     * @var ?string $lastAsn Last autonomous system number associated with the refresh token
     */
    #[JsonProperty('last_asn')]
    private ?string $lastAsn;

    /**
     * @var ?string $lastUserAgent Last user agent associated with the refresh token
     */
    #[JsonProperty('last_user_agent')]
    private ?string $lastUserAgent;

    /**
     * @param array{
     *   initialIp?: ?string,
     *   initialAsn?: ?string,
     *   initialUserAgent?: ?string,
     *   lastIp?: ?string,
     *   lastAsn?: ?string,
     *   lastUserAgent?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->initialIp = $values['initialIp'] ?? null;
        $this->initialAsn = $values['initialAsn'] ?? null;
        $this->initialUserAgent = $values['initialUserAgent'] ?? null;
        $this->lastIp = $values['lastIp'] ?? null;
        $this->lastAsn = $values['lastAsn'] ?? null;
        $this->lastUserAgent = $values['lastUserAgent'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getInitialIp(): ?string
    {
        return $this->initialIp;
    }

    /**
     * @param ?string $value
     */
    public function setInitialIp(?string $value = null): self
    {
        $this->initialIp = $value;
        $this->_setField('initialIp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInitialAsn(): ?string
    {
        return $this->initialAsn;
    }

    /**
     * @param ?string $value
     */
    public function setInitialAsn(?string $value = null): self
    {
        $this->initialAsn = $value;
        $this->_setField('initialAsn');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getInitialUserAgent(): ?string
    {
        return $this->initialUserAgent;
    }

    /**
     * @param ?string $value
     */
    public function setInitialUserAgent(?string $value = null): self
    {
        $this->initialUserAgent = $value;
        $this->_setField('initialUserAgent');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastIp(): ?string
    {
        return $this->lastIp;
    }

    /**
     * @param ?string $value
     */
    public function setLastIp(?string $value = null): self
    {
        $this->lastIp = $value;
        $this->_setField('lastIp');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastAsn(): ?string
    {
        return $this->lastAsn;
    }

    /**
     * @param ?string $value
     */
    public function setLastAsn(?string $value = null): self
    {
        $this->lastAsn = $value;
        $this->_setField('lastAsn');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastUserAgent(): ?string
    {
        return $this->lastUserAgent;
    }

    /**
     * @param ?string $value
     */
    public function setLastUserAgent(?string $value = null): self
    {
        $this->lastUserAgent = $value;
        $this->_setField('lastUserAgent');
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
