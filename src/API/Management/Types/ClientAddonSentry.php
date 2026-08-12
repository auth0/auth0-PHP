<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Sentry SSO configuration.
 */
class ClientAddonSentry extends JsonSerializableType
{
    /**
     * @var ?string $orgSlug Generated slug for your Sentry organization. Found in your Sentry URL. e.g. `https://sentry.acme.com/acme-org/` would be `acme-org`.
     */
    #[JsonProperty('org_slug')]
    private ?string $orgSlug;

    /**
     * @var ?string $baseUrl URL prefix only if running Sentry Community Edition, otherwise leave should be blank.
     */
    #[JsonProperty('base_url')]
    private ?string $baseUrl;

    /**
     * @param array{
     *   orgSlug?: ?string,
     *   baseUrl?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->orgSlug = $values['orgSlug'] ?? null;
        $this->baseUrl = $values['baseUrl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getOrgSlug(): ?string
    {
        return $this->orgSlug;
    }

    /**
     * @param ?string $value
     */
    public function setOrgSlug(?string $value = null): self
    {
        $this->orgSlug = $value;
        $this->_setField('orgSlug');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getBaseUrl(): ?string
    {
        return $this->baseUrl;
    }

    /**
     * @param ?string $value
     */
    public function setBaseUrl(?string $value = null): self
    {
        $this->baseUrl = $value;
        $this->_setField('baseUrl');
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
