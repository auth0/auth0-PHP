<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\MdlPresentationRequest;

class CreateVerifiableCredentialTemplateRequestContent extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $dialect
     */
    #[JsonProperty('dialect')]
    private string $dialect;

    /**
     * @var MdlPresentationRequest $presentation
     */
    #[JsonProperty('presentation')]
    private MdlPresentationRequest $presentation;

    /**
     * @var ?string $customCertificateAuthority
     */
    #[JsonProperty('custom_certificate_authority')]
    private ?string $customCertificateAuthority;

    /**
     * @var string $wellKnownTrustedIssuers
     */
    #[JsonProperty('well_known_trusted_issuers')]
    private string $wellKnownTrustedIssuers;

    /**
     * @param array{
     *   name: string,
     *   type: string,
     *   dialect: string,
     *   presentation: MdlPresentationRequest,
     *   wellKnownTrustedIssuers: string,
     *   customCertificateAuthority?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->type = $values['type'];
        $this->dialect = $values['dialect'];
        $this->presentation = $values['presentation'];
        $this->customCertificateAuthority = $values['customCertificateAuthority'] ?? null;
        $this->wellKnownTrustedIssuers = $values['wellKnownTrustedIssuers'];
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
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getDialect(): string
    {
        return $this->dialect;
    }

    /**
     * @param string $value
     */
    public function setDialect(string $value): self
    {
        $this->dialect = $value;
        $this->_setField('dialect');
        return $this;
    }

    /**
     * @return MdlPresentationRequest
     */
    public function getPresentation(): MdlPresentationRequest
    {
        return $this->presentation;
    }

    /**
     * @param MdlPresentationRequest $value
     */
    public function setPresentation(MdlPresentationRequest $value): self
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
     * @return string
     */
    public function getWellKnownTrustedIssuers(): string
    {
        return $this->wellKnownTrustedIssuers;
    }

    /**
     * @param string $value
     */
    public function setWellKnownTrustedIssuers(string $value): self
    {
        $this->wellKnownTrustedIssuers = $value;
        $this->_setField('wellKnownTrustedIssuers');
        return $this;
    }
}
