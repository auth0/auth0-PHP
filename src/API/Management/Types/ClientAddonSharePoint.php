<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * SharePoint SSO configuration.
 */
class ClientAddonSharePoint extends JsonSerializableType
{
    /**
     * @var ?string $url Internal SharePoint application URL.
     */
    #[JsonProperty('url')]
    private ?string $url;

    /**
     * @var (
     *    array<string>
     *   |string
     * )|null $externalUrl
     */
    #[JsonProperty('external_url'), Union(['string'], 'string', 'null')]
    private array|string|null $externalUrl;

    /**
     * @param array{
     *   url?: ?string,
     *   externalUrl?: (
     *    array<string>
     *   |string
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->url = $values['url'] ?? null;
        $this->externalUrl = $values['externalUrl'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param ?string $value
     */
    public function setUrl(?string $value = null): self
    {
        $this->url = $value;
        $this->_setField('url');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |string
     * )|null
     */
    public function getExternalUrl(): array|string|null
    {
        return $this->externalUrl;
    }

    /**
     * @param (
     *    array<string>
     *   |string
     * )|null $value
     */
    public function setExternalUrl(array|string|null $value = null): self
    {
        $this->externalUrl = $value;
        $this->_setField('externalUrl');
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
