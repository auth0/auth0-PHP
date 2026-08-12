<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'email' connection
 */
class ConnectionOptionsEmail extends JsonSerializableType
{
    use ConnectionOptionsCommon;

    /**
     * @var ?string $authParams
     */
    #[JsonProperty('authParams')]
    private ?string $authParams;

    /**
     * @var bool $bruteForceProtection
     */
    #[JsonProperty('brute_force_protection')]
    private bool $bruteForceProtection;

    /**
     * @var ?bool $disableSignup
     */
    #[JsonProperty('disable_signup')]
    private ?bool $disableSignup;

    /**
     * @var ConnectionEmailEmail $email
     */
    #[JsonProperty('email')]
    private ConnectionEmailEmail $email;

    /**
     * @var string $name Connection name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?ConnectionTotpEmail $totp
     */
    #[JsonProperty('totp')]
    private ?ConnectionTotpEmail $totp;

    /**
     * @param array{
     *   bruteForceProtection: bool,
     *   email: ConnectionEmailEmail,
     *   name: string,
     *   nonPersistentAttrs?: ?array<string>,
     *   authParams?: ?string,
     *   disableSignup?: ?bool,
     *   totp?: ?ConnectionTotpEmail,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->authParams = $values['authParams'] ?? null;
        $this->bruteForceProtection = $values['bruteForceProtection'];
        $this->disableSignup = $values['disableSignup'] ?? null;
        $this->email = $values['email'];
        $this->name = $values['name'];
        $this->totp = $values['totp'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getAuthParams(): ?string
    {
        return $this->authParams;
    }

    /**
     * @param ?string $value
     */
    public function setAuthParams(?string $value = null): self
    {
        $this->authParams = $value;
        $this->_setField('authParams');
        return $this;
    }

    /**
     * @return bool
     */
    public function getBruteForceProtection(): bool
    {
        return $this->bruteForceProtection;
    }

    /**
     * @param bool $value
     */
    public function setBruteForceProtection(bool $value): self
    {
        $this->bruteForceProtection = $value;
        $this->_setField('bruteForceProtection');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisableSignup(): ?bool
    {
        return $this->disableSignup;
    }

    /**
     * @param ?bool $value
     */
    public function setDisableSignup(?bool $value = null): self
    {
        $this->disableSignup = $value;
        $this->_setField('disableSignup');
        return $this;
    }

    /**
     * @return ConnectionEmailEmail
     */
    public function getEmail(): ConnectionEmailEmail
    {
        return $this->email;
    }

    /**
     * @param ConnectionEmailEmail $value
     */
    public function setEmail(ConnectionEmailEmail $value): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?ConnectionTotpEmail
     */
    public function getTotp(): ?ConnectionTotpEmail
    {
        return $this->totp;
    }

    /**
     * @param ?ConnectionTotpEmail $value
     */
    public function setTotp(?ConnectionTotpEmail $value = null): self
    {
        $this->totp = $value;
        $this->_setField('totp');
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
