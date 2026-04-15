<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class UpdateVerifiableCredentialTemplateResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The id of the template.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of the template.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $type The type of the template.
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $dialect The dialect of the template.
     */
    #[JsonProperty('dialect')]
    private ?string $dialect;

    /**
     * @var ?MdlPresentationRequest $presentation
     */
    #[JsonProperty('presentation')]
    private ?MdlPresentationRequest $presentation;

    /**
     * @var ?string $customCertificateAuthority The custom certificate authority.
     */
    #[JsonProperty('custom_certificate_authority')]
    private ?string $customCertificateAuthority;

    /**
     * @var ?string $wellKnownTrustedIssuers The well-known trusted issuers, comma separated.
     */
    #[JsonProperty('well_known_trusted_issuers')]
    private ?string $wellKnownTrustedIssuers;

    /**
     * @var ?DateTime $createdAt The date and time the template was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The date and time the template was created.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   type?: ?string,
     *   dialect?: ?string,
     *   presentation?: ?MdlPresentationRequest,
     *   customCertificateAuthority?: ?string,
     *   wellKnownTrustedIssuers?: ?string,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->dialect = $values['dialect'] ?? null;
        $this->presentation = $values['presentation'] ?? null;
        $this->customCertificateAuthority = $values['customCertificateAuthority'] ?? null;
        $this->wellKnownTrustedIssuers = $values['wellKnownTrustedIssuers'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?string $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDialect(): ?string
    {
        return $this->dialect;
    }

    /**
     * @param ?string $value
     */
    public function setDialect(?string $value = null): self
    {
        $this->dialect = $value;
        $this->_setField('dialect');
        return $this;
    }

    /**
     * @return ?MdlPresentationRequest
     */
    public function getPresentation(): ?MdlPresentationRequest
    {
        return $this->presentation;
    }

    /**
     * @param ?MdlPresentationRequest $value
     */
    public function setPresentation(?MdlPresentationRequest $value = null): self
    {
        $this->presentation = $value;
        $this->_setField('presentation');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCustomCertificateAuthority(): ?string
    {
        return $this->customCertificateAuthority;
    }

    /**
     * @param ?string $value
     */
    public function setCustomCertificateAuthority(?string $value = null): self
    {
        $this->customCertificateAuthority = $value;
        $this->_setField('customCertificateAuthority');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getWellKnownTrustedIssuers(): ?string
    {
        return $this->wellKnownTrustedIssuers;
    }

    /**
     * @param ?string $value
     */
    public function setWellKnownTrustedIssuers(?string $value = null): self
    {
        $this->wellKnownTrustedIssuers = $value;
        $this->_setField('wellKnownTrustedIssuers');
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
