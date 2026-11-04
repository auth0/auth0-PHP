<?php

namespace Auth0\SDK\API\Management\Portals\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\PortalClientSecretPostRequest;
use Auth0\SDK\API\Management\Types\PortalNavigation;
use Auth0\SDK\API\Management\Types\PortalPagesByType;
use Auth0\SDK\API\Management\Types\PortalCustomCode;

class UpdatePortalRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $slug
     */
    #[JsonProperty('slug')]
    private ?string $slug;

    /**
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?PortalClientSecretPostRequest $client
     */
    #[JsonProperty('client')]
    private ?PortalClientSecretPostRequest $client;

    /**
     * @var ?PortalNavigation $navigation
     */
    #[JsonProperty('navigation')]
    private ?PortalNavigation $navigation;

    /**
     * @var ?PortalPagesByType $pages
     */
    #[JsonProperty('pages')]
    private ?PortalPagesByType $pages;

    /**
     * @var ?PortalCustomCode $customCode
     */
    #[JsonProperty('custom_code')]
    private ?PortalCustomCode $customCode;

    /**
     * @param array{
     *   slug?: ?string,
     *   name?: ?string,
     *   client?: ?PortalClientSecretPostRequest,
     *   navigation?: ?PortalNavigation,
     *   pages?: ?PortalPagesByType,
     *   customCode?: ?PortalCustomCode,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->slug = $values['slug'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->client = $values['client'] ?? null;
        $this->navigation = $values['navigation'] ?? null;
        $this->pages = $values['pages'] ?? null;
        $this->customCode = $values['customCode'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param ?string $value
     */
    public function setSlug(?string $value = null): self
    {
        $this->slug = $value;
        $this->_setField('slug');
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
     * @return ?PortalClientSecretPostRequest
     */
    public function getClient(): ?PortalClientSecretPostRequest
    {
        return $this->client;
    }

    /**
     * @param ?PortalClientSecretPostRequest $value
     */
    public function setClient(?PortalClientSecretPostRequest $value = null): self
    {
        $this->client = $value;
        $this->_setField('client');
        return $this;
    }

    /**
     * @return ?PortalNavigation
     */
    public function getNavigation(): ?PortalNavigation
    {
        return $this->navigation;
    }

    /**
     * @param ?PortalNavigation $value
     */
    public function setNavigation(?PortalNavigation $value = null): self
    {
        $this->navigation = $value;
        $this->_setField('navigation');
        return $this;
    }

    /**
     * @return ?PortalPagesByType
     */
    public function getPages(): ?PortalPagesByType
    {
        return $this->pages;
    }

    /**
     * @param ?PortalPagesByType $value
     */
    public function setPages(?PortalPagesByType $value = null): self
    {
        $this->pages = $value;
        $this->_setField('pages');
        return $this;
    }

    /**
     * @return ?PortalCustomCode
     */
    public function getCustomCode(): ?PortalCustomCode
    {
        return $this->customCode;
    }

    /**
     * @param ?PortalCustomCode $value
     */
    public function setCustomCode(?PortalCustomCode $value = null): self
    {
        $this->customCode = $value;
        $this->_setField('customCode');
        return $this;
    }
}
