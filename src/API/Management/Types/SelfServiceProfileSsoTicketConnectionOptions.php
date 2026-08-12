<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * The connection's options (depend on the connection strategy)
 */
class SelfServiceProfileSsoTicketConnectionOptions extends JsonSerializableType
{
    /**
     * @var ?string $iconUrl URL for the icon. Must use HTTPS.
     */
    #[JsonProperty('icon_url')]
    private ?string $iconUrl;

    /**
     * @var ?array<string> $domainAliases List of domain_aliases that can be authenticated in the Identity Provider
     */
    #[JsonProperty('domain_aliases'), ArrayType(['string'])]
    private ?array $domainAliases;

    /**
     * @var ?SelfServiceProfileSsoTicketIdpInitiatedOptions $idpinitiated
     */
    #[JsonProperty('idpinitiated')]
    private ?SelfServiceProfileSsoTicketIdpInitiatedOptions $idpinitiated;

    /**
     * @param array{
     *   iconUrl?: ?string,
     *   domainAliases?: ?array<string>,
     *   idpinitiated?: ?SelfServiceProfileSsoTicketIdpInitiatedOptions,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->iconUrl = $values['iconUrl'] ?? null;
        $this->domainAliases = $values['domainAliases'] ?? null;
        $this->idpinitiated = $values['idpinitiated'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getIconUrl(): ?string
    {
        return $this->iconUrl;
    }

    /**
     * @param ?string $value
     */
    public function setIconUrl(?string $value = null): self
    {
        $this->iconUrl = $value;
        $this->_setField('iconUrl');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getDomainAliases(): ?array
    {
        return $this->domainAliases;
    }

    /**
     * @param ?array<string> $value
     */
    public function setDomainAliases(?array $value = null): self
    {
        $this->domainAliases = $value;
        $this->_setField('domainAliases');
        return $this;
    }

    /**
     * @return ?SelfServiceProfileSsoTicketIdpInitiatedOptions
     */
    public function getIdpinitiated(): ?SelfServiceProfileSsoTicketIdpInitiatedOptions
    {
        return $this->idpinitiated;
    }

    /**
     * @param ?SelfServiceProfileSsoTicketIdpInitiatedOptions $value
     */
    public function setIdpinitiated(?SelfServiceProfileSsoTicketIdpInitiatedOptions $value = null): self
    {
        $this->idpinitiated = $value;
        $this->_setField('idpinitiated');
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
