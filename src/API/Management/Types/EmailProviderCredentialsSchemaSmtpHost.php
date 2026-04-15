<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaSmtpHost extends JsonSerializableType
{
    /**
     * @var ?string $smtpHost
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
     * @var ?string $smtpPass SMTP password.
     */
    #[JsonProperty('smtp_pass')]
    private ?string $smtpPass;

    /**
     * @param array{
     *   smtpHost?: ?string,
     *   smtpPort?: ?int,
     *   smtpUser?: ?string,
     *   smtpPass?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->smtpHost = $values['smtpHost'] ?? null;
        $this->smtpPort = $values['smtpPort'] ?? null;
        $this->smtpUser = $values['smtpUser'] ?? null;
        $this->smtpPass = $values['smtpPass'] ?? null;
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
     * @return ?string
     */
    public function getSmtpPass(): ?string
    {
        return $this->smtpPass;
    }

    /**
     * @param ?string $value
     */
    public function setSmtpPass(?string $value = null): self
    {
        $this->smtpPass = $value;
        $this->_setField('smtpPass');
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
