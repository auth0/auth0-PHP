<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Salesforce API addon configuration.
 */
class ClientAddonSalesforceApi extends JsonSerializableType
{
    /**
     * @var ?string $clientid Consumer Key assigned by Salesforce to the Connected App.
     */
    #[JsonProperty('clientid')]
    private ?string $clientid;

    /**
     * @var ?string $principal Name of the property in the user object that maps to a Salesforce username. e.g. `email`.
     */
    #[JsonProperty('principal')]
    private ?string $principal;

    /**
     * @var ?string $communityName Community name.
     */
    #[JsonProperty('communityName')]
    private ?string $communityName;

    /**
     * @var ?string $communityUrlSection Community url section.
     */
    #[JsonProperty('community_url_section')]
    private ?string $communityUrlSection;

    /**
     * @param array{
     *   clientid?: ?string,
     *   principal?: ?string,
     *   communityName?: ?string,
     *   communityUrlSection?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientid = $values['clientid'] ?? null;
        $this->principal = $values['principal'] ?? null;
        $this->communityName = $values['communityName'] ?? null;
        $this->communityUrlSection = $values['communityUrlSection'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getClientid(): ?string
    {
        return $this->clientid;
    }

    /**
     * @param ?string $value
     */
    public function setClientid(?string $value = null): self
    {
        $this->clientid = $value;
        $this->_setField('clientid');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrincipal(): ?string
    {
        return $this->principal;
    }

    /**
     * @param ?string $value
     */
    public function setPrincipal(?string $value = null): self
    {
        $this->principal = $value;
        $this->_setField('principal');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCommunityName(): ?string
    {
        return $this->communityName;
    }

    /**
     * @param ?string $value
     */
    public function setCommunityName(?string $value = null): self
    {
        $this->communityName = $value;
        $this->_setField('communityName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCommunityUrlSection(): ?string
    {
        return $this->communityUrlSection;
    }

    /**
     * @param ?string $value
     */
    public function setCommunityUrlSection(?string $value = null): self
    {
        $this->communityUrlSection = $value;
        $this->_setField('communityUrlSection');
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
