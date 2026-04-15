<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Credentials required to use the provider.
 */
class EmailProviderCredentials extends JsonSerializableType
{
    /**
     * @var ?string $apiUser API User.
     */
    #[JsonProperty('api_user')]
    private ?string $apiUser;

    /**
     * @var ?string $region AWS or SparkPost region.
     */
    #[JsonProperty('region')]
    private ?string $region;

    /**
     * @var ?string $smtpHost SMTP host.
     */
    #[JsonProperty('smtp_host')]
    private ?string $smtpHost;

    /**
     * @var ?int $smtpPort SMTP port.
     */
    #[JsonProperty('smtp_port')]
    private ?int $smtpPort;

    /**
     * @var ?string $smtpUser SMTP username.
     */
    #[JsonProperty('smtp_user')]
    private ?string $smtpUser;

    /**
     * @param array{
     *   apiUser?: ?string,
     *   region?: ?string,
     *   smtpHost?: ?string,
     *   smtpPort?: ?int,
     *   smtpUser?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->apiUser = $values['apiUser'] ?? null;
        $this->region = $values['region'] ?? null;
        $this->smtpHost = $values['smtpHost'] ?? null;
        $this->smtpPort = $values['smtpPort'] ?? null;
        $this->smtpUser = $values['smtpUser'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getApiUser(): ?string
    {
        return $this->apiUser;
    }

    /**
     * @param ?string $value
     */
    public function setApiUser(?string $value = null): self
    {
        $this->apiUser = $value;
        $this->_setField('apiUser');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param ?string $value
     */
    public function setRegion(?string $value = null): self
    {
        $this->region = $value;
        $this->_setField('region');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSmtpHost(): ?string
    {
        return $this->smtpHost;
    }

    /**
     * @param ?string $value
     */
    public function setSmtpHost(?string $value = null): self
    {
        $this->smtpHost = $value;
        $this->_setField('smtpHost');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getSmtpPort(): ?int
    {
        return $this->smtpPort;
    }

    /**
     * @param ?int $value
     */
    public function setSmtpPort(?int $value = null): self
    {
        $this->smtpPort = $value;
        $this->_setField('smtpPort');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSmtpUser(): ?string
    {
        return $this->smtpUser;
    }

    /**
     * @param ?string $value
     */
    public function setSmtpUser(?string $value = null): self
    {
        $this->smtpUser = $value;
        $this->_setField('smtpUser');
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
