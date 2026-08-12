<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PostConnectionsKeysResponseContentItem extends JsonSerializableType
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
     * @var ?string $pkcs The public certificate of the signing key in pkcs7 format
     */
    #[JsonProperty('pkcs')]
    private ?string $pkcs;

    /**
     * @var ?bool $current True if the key is the current key
     */
    #[JsonProperty('current')]
    private ?bool $current;

    /**
     * @var ?bool $next True if the key is the next key
     */
    #[JsonProperty('next')]
    private ?bool $next;

    /**
     * @var ?string $currentSince The date and time when the key became the current key
     */
    #[JsonProperty('current_since')]
    private ?string $currentSince;

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
     * @var ?string $algorithm Signing key algorithm
     */
    #[JsonProperty('algorithm')]
    private ?string $algorithm;

    /**
     * @var ?value-of<ConnectionKeyUseEnum> $keyUse
     */
    #[JsonProperty('key_use')]
    private ?string $keyUse;

    /**
     * @var ?string $subjectDn
     */
    #[JsonProperty('subject_dn')]
    private ?string $subjectDn;

    /**
     * @param array{
     *   kid: string,
     *   cert: string,
     *   fingerprint: string,
     *   thumbprint: string,
     *   pkcs?: ?string,
     *   current?: ?bool,
     *   next?: ?bool,
     *   currentSince?: ?string,
     *   algorithm?: ?string,
     *   keyUse?: ?value-of<ConnectionKeyUseEnum>,
     *   subjectDn?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->kid = $values['kid'];
        $this->cert = $values['cert'];
        $this->pkcs = $values['pkcs'] ?? null;
        $this->current = $values['current'] ?? null;
        $this->next = $values['next'] ?? null;
        $this->currentSince = $values['currentSince'] ?? null;
        $this->fingerprint = $values['fingerprint'];
        $this->thumbprint = $values['thumbprint'];
        $this->algorithm = $values['algorithm'] ?? null;
        $this->keyUse = $values['keyUse'] ?? null;
        $this->subjectDn = $values['subjectDn'] ?? null;
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
    public function getPkcs(): ?string
    {
        return $this->pkcs;
    }

    /**
     * @param ?string $value
     */
    public function setPkcs(?string $value = null): self
    {
        $this->pkcs = $value;
        $this->_setField('pkcs');
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
     * @return ?string
     */
    public function getCurrentSince(): ?string
    {
        return $this->currentSince;
    }

    /**
     * @param ?string $value
     */
    public function setCurrentSince(?string $value = null): self
    {
        $this->currentSince = $value;
        $this->_setField('currentSince');
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
     * @return ?string
     */
    public function getAlgorithm(): ?string
    {
        return $this->algorithm;
    }

    /**
     * @param ?string $value
     */
    public function setAlgorithm(?string $value = null): self
    {
        $this->algorithm = $value;
        $this->_setField('algorithm');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionKeyUseEnum>
     */
    public function getKeyUse(): ?string
    {
        return $this->keyUse;
    }

    /**
     * @param ?value-of<ConnectionKeyUseEnum> $value
     */
    public function setKeyUse(?string $value = null): self
    {
        $this->keyUse = $value;
        $this->_setField('keyUse');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubjectDn(): ?string
    {
        return $this->subjectDn;
    }

    /**
     * @param ?string $value
     */
    public function setSubjectDn(?string $value = null): self
    {
        $this->subjectDn = $value;
        $this->_setField('subjectDn');
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
