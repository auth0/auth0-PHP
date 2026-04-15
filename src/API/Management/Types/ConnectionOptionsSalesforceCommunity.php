<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionOptionsSalesforce;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Options for the 'salesforce-community' connection
 */
class ConnectionOptionsSalesforceCommunity extends JsonSerializableType
{
    use ConnectionOptionsSalesforce;

    /**
     * @var ?string $communityBaseUrl
     */
    #[JsonProperty('community_base_url')]
    private ?string $communityBaseUrl;

    /**
     * @param array{
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     *   freeformScopes?: ?array<string>,
     *   profile?: ?bool,
     *   scope?: ?array<string>,
     *   setUserRootAttributes?: ?value-of<ConnectionSetUserRootAttributesEnum>,
     *   upstreamParams?: ?array<string, (
     *    ConnectionUpstreamAlias
     *   |ConnectionUpstreamValue
     * )|null>,
     *   nonPersistentAttrs?: ?array<string>,
     *   communityBaseUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
        $this->freeformScopes = $values['freeformScopes'] ?? null;
        $this->profile = $values['profile'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->setUserRootAttributes = $values['setUserRootAttributes'] ?? null;
        $this->upstreamParams = $values['upstreamParams'] ?? null;
        $this->nonPersistentAttrs = $values['nonPersistentAttrs'] ?? null;
        $this->communityBaseUrl = $values['communityBaseUrl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getCommunityBaseUrl(): ?string
    {
        return $this->communityBaseUrl;
    }

    /**
     * @param ?string $value
     */
    public function setCommunityBaseUrl(?string $value = null): self
    {
        $this->communityBaseUrl = $value;
        $this->_setField('communityBaseUrl');
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
