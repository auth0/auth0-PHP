<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class Portal extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

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
     * @var string $slug
     */
    #[JsonProperty('slug')]
    private string $slug;

    /**
     * @var ?PortalClientSecretPost $client
     */
    #[JsonProperty('client')]
    private ?PortalClientSecretPost $client;

    /**
     * @var ?PortalCustomCode $customCode
     */
    #[JsonProperty('custom_code')]
    private ?PortalCustomCode $customCode;

    /**
     * @var DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @param array{
     *   id: string,
     *   name: string,
     *   slug: string,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   navigation?: ?PortalNavigation,
     *   pages?: ?PortalPagesByType,
     *   client?: ?PortalClientSecretPost,
     *   customCode?: ?PortalCustomCode,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
        $this->navigation = $values['navigation'] ?? null;
        $this->pages = $values['pages'] ?? null;
        $this->slug = $values['slug'];
        $this->client = $values['client'] ?? null;
        $this->customCode = $values['customCode'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $value
     */
    public function setSlug(string $value): self
    {
        $this->slug = $value;
        $this->_setField('slug');
        return $this;
    }

    /**
     * @return ?PortalClientSecretPost
     */
    public function getClient(): ?PortalClientSecretPost
    {
        return $this->client;
    }

    /**
     * @param ?PortalClientSecretPost $value
     */
    public function setClient(?PortalClientSecretPost $value = null): self
    {
        $this->client = $value;
        $this->_setField('client');
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

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
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
