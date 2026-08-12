<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class PatchClientCredentialResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id ID of the credential. Generated on creation.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name given to the credential by the user.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $kid The key identifier of the credential, generated on creation.
     */
    #[JsonProperty('kid')]
    private ?string $kid;

    /**
     * @var ?value-of<ClientCredentialAlgorithmEnum> $alg
     */
    #[JsonProperty('alg')]
    private ?string $alg;

    /**
     * @var ?value-of<ClientCredentialTypeEnum> $credentialType
     */
    #[JsonProperty('credential_type')]
    private ?string $credentialType;

    /**
     * @var ?string $subjectDn The X509 certificate's Subject Distinguished Name
     */
    #[JsonProperty('subject_dn')]
    private ?string $subjectDn;

    /**
     * @var ?string $thumbprintSha256 The X509 certificate's SHA256 thumbprint
     */
    #[JsonProperty('thumbprint_sha256')]
    private ?string $thumbprintSha256;

    /**
     * @var ?DateTime $createdAt The ISO 8601 formatted date the credential was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The ISO 8601 formatted date the credential was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @var ?DateTime $expiresAt The ISO 8601 formatted date representing the expiration of the credential.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   kid?: ?string,
     *   alg?: ?value-of<ClientCredentialAlgorithmEnum>,
     *   credentialType?: ?value-of<ClientCredentialTypeEnum>,
     *   subjectDn?: ?string,
     *   thumbprintSha256?: ?string,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   expiresAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->kid = $values['kid'] ?? null;
        $this->alg = $values['alg'] ?? null;
        $this->credentialType = $values['credentialType'] ?? null;
        $this->subjectDn = $values['subjectDn'] ?? null;
        $this->thumbprintSha256 = $values['thumbprintSha256'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->expiresAt = $values['expiresAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getKid(): ?string
    {
        return $this->kid;
    }

    /**
     * @param ?string $value
     */
    public function setKid(?string $value = null): self
    {
        $this->kid = $value;
        $this->_setField('kid');
        return $this;
    }

    /**
     * @return ?value-of<ClientCredentialAlgorithmEnum>
     */
    public function getAlg(): ?string
    {
        return $this->alg;
    }

    /**
     * @param ?value-of<ClientCredentialAlgorithmEnum> $value
     */
    public function setAlg(?string $value = null): self
    {
        $this->alg = $value;
        $this->_setField('alg');
        return $this;
    }

    /**
     * @return ?value-of<ClientCredentialTypeEnum>
     */
    public function getCredentialType(): ?string
    {
        return $this->credentialType;
    }

    /**
     * @param ?value-of<ClientCredentialTypeEnum> $value
     */
    public function setCredentialType(?string $value = null): self
    {
        $this->credentialType = $value;
        $this->_setField('credentialType');
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
     * @return ?string
     */
    public function getThumbprintSha256(): ?string
    {
        return $this->thumbprintSha256;
    }

    /**
     * @param ?string $value
     */
    public function setThumbprintSha256(?string $value = null): self
    {
        $this->thumbprintSha256 = $value;
        $this->_setField('thumbprintSha256');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpiresAt(?DateTime $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
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
