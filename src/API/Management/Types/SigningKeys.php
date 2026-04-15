<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

class SigningKeys extends JsonSerializableType
{
    /**
     * @var string $kid The key id of the signing key
     */
    #[JsonProperty('kid')]
    private string $kid;

    /**
     * @var string $cert The public certificate of the signing key
     */
    #[JsonProperty('cert')]
    private string $cert;

    /**
     * @var ?string $pkcs7 The public certificate of the signing key in pkcs7 format
     */
    #[JsonProperty('pkcs7')]
    private ?string $pkcs7;

    /**
     * @var ?bool $current True if the key is the the current key
     */
    #[JsonProperty('current')]
    private ?bool $current;

    /**
     * @var ?bool $next True if the key is the the next key
     */
    #[JsonProperty('next')]
    private ?bool $next;

    /**
     * @var ?bool $previous True if the key is the the previous key
     */
    #[JsonProperty('previous')]
    private ?bool $previous;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $currentSince
     */
    #[JsonProperty('current_since'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $currentSince;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $currentUntil
     */
    #[JsonProperty('current_until'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $currentUntil;

    /**
     * @var string $fingerprint The cert fingerprint
     */
    #[JsonProperty('fingerprint')]
    private string $fingerprint;

    /**
     * @var string $thumbprint The cert thumbprint
     */
    #[JsonProperty('thumbprint')]
    private string $thumbprint;

    /**
     * @var ?bool $revoked True if the key is revoked
     */
    #[JsonProperty('revoked')]
    private ?bool $revoked;

    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $revokedAt
     */
    #[JsonProperty('revoked_at'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $revokedAt;

    /**
     * @param array{
     *   kid: string,
     *   cert: string,
     *   fingerprint: string,
     *   thumbprint: string,
     *   pkcs7?: ?string,
     *   current?: ?bool,
     *   next?: ?bool,
     *   previous?: ?bool,
     *   currentSince?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   currentUntil?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   revoked?: ?bool,
     *   revokedAt?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->kid = $values['kid'];
        $this->cert = $values['cert'];
        $this->pkcs7 = $values['pkcs7'] ?? null;
        $this->current = $values['current'] ?? null;
        $this->next = $values['next'] ?? null;
        $this->previous = $values['previous'] ?? null;
        $this->currentSince = $values['currentSince'] ?? null;
        $this->currentUntil = $values['currentUntil'] ?? null;
        $this->fingerprint = $values['fingerprint'];
        $this->thumbprint = $values['thumbprint'];
        $this->revoked = $values['revoked'] ?? null;
        $this->revokedAt = $values['revokedAt'] ?? null;
    }

    /**
     * @return string
     */
    public function getKid(): string
    {
        return $this->kid;
    }

    /**
     * @param string $value
     */
    public function setKid(string $value): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return string
     */
    public function getCert(): string
    {
        return $this->cert;
    }

    /**
     * @param string $value
     */
    public function setCert(string $value): self
    {
        $this->cert = $value;
        $this->_setField('cert');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPkcs7(): ?string
    {
        return $this->pkcs7;
    }

    /**
     * @param ?string $value
     */
    public function setPkcs7(?string $value = null): self
    {
        $this->pkcs7 = $value;
        $this->_setField('pkcs7');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCurrent(): ?bool
    {
        return $this->current;
    }

    /**
     * @param ?bool $value
     */
    public function setCurrent(?bool $value = null): self
    {
        $this->current = $value;
        $this->_setField('current');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getNext(): ?bool
    {
        return $this->next;
    }

    /**
     * @param ?bool $value
     */
    public function setNext(?bool $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getPrevious(): ?bool
    {
        return $this->previous;
    }

    /**
     * @param ?bool $value
     */
    public function setPrevious(?bool $value = null): self
    {
        $this->previous = $value;
        $this->_setField('previous');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getCurrentSince(): string|array|null
    {
        return $this->currentSince;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setCurrentSince(string|array|null $value = null): self
    {
        $this->currentSince = $value;
        $this->_setField('currentSince');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getCurrentUntil(): string|array|null
    {
        return $this->currentUntil;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setCurrentUntil(string|array|null $value = null): self
    {
        $this->currentUntil = $value;
        $this->_setField('currentUntil');
        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $value
     */
    public function setFingerprint(string $value): self
    {
        $this->fingerprint = $value;
        $this->_setField('fingerprint');
        return $this;
    }

    /**
     * @return string
     */
    public function getThumbprint(): string
    {
        return $this->thumbprint;
    }

    /**
     * @param string $value
     */
    public function setThumbprint(string $value): self
    {
        $this->thumbprint = $value;
        $this->_setField('thumbprint');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getRevoked(): ?bool
    {
        return $this->revoked;
    }

    /**
     * @param ?bool $value
     */
    public function setRevoked(?bool $value = null): self
    {
        $this->revoked = $value;
        $this->_setField('revoked');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getRevokedAt(): string|array|null
    {
        return $this->revokedAt;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setRevokedAt(string|array|null $value = null): self
    {
        $this->revokedAt = $value;
        $this->_setField('revokedAt');
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
