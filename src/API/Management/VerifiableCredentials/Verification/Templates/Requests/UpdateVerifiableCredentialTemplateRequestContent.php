<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\MdlPresentationRequest;

class UpdateVerifiableCredentialTemplateRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $dialect
     */
    #[JsonProperty('dialect')]
    private ?string $dialect;

    /**
     * @var ?MdlPresentationRequest $presentation
     */
    #[JsonProperty('presentation')]
    private ?MdlPresentationRequest $presentation;

    /**
     * @var ?string $wellKnownTrustedIssuers
     */
    #[JsonProperty('well_known_trusted_issuers')]
    private ?string $wellKnownTrustedIssuers;

    /**
     * @var ?float $version
     */
    #[JsonProperty('version')]
    private ?float $version;

    /**
     * @param array{
     *   name?: ?string,
     *   type?: ?string,
     *   dialect?: ?string,
     *   presentation?: ?MdlPresentationRequest,
     *   wellKnownTrustedIssuers?: ?string,
     *   version?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->dialect = $values['dialect'] ?? null;
        $this->presentation = $values['presentation'] ?? null;
        $this->wellKnownTrustedIssuers = $values['wellKnownTrustedIssuers'] ?? null;
        $this->version = $values['version'] ?? null;
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
     * @return ?float
     */
    public function getVersion(): ?float
    {
        return $this->version;
    }

    /**
     * @param ?float $value
     */
    public function setVersion(?float $value = null): self
    {
        $this->version = $value;
        $this->_setField('version');
        return $this;
    }
}
