<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

/**
 * Integration defines a self contained functioning unit which partners
 * publish. A partner may create one or many of these integrations.
 */
class Integration extends JsonSerializableType
{
    /**
     * id is a system generated GUID. This same ID is designed to be federated in
     * all the applicable localities.
     *
     * @var ?string $id
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $catalogId catalog_id refers to the ID in the marketplace catalog
     */
    #[JsonProperty('catalog_id')]
    private ?string $catalogId;

    /**
     * @var ?string $urlSlug url_slug refers to the url_slug in the marketplace catalog
     */
    #[JsonProperty('url_slug')]
    private ?string $urlSlug;

    /**
     * partner_id is the foreign key reference to the partner account this
     * integration belongs to.
     *
     * @var ?string $partnerId
     */
    #[JsonProperty('partner_id')]
    private ?string $partnerId;

    /**
     * name is the integration name, which will be used for display purposes in
     * the marketplace.
     *
     * To start we're going to make sure the display name is at least 3
     * characters. Can adjust this easily later.
     *
     * @var ?string $name
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * description adds more text for the integration name -- also relevant for
     * the marketplace listing.
     *
     * @var ?string $description
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $shortDescription short_description is the brief description of the integration, which is used for display purposes in cards
     */
    #[JsonProperty('short_description')]
    private ?string $shortDescription;

    /**
     * @var ?string $logo
     */
    #[JsonProperty('logo')]
    private ?string $logo;

    /**
     * @var ?value-of<IntegrationFeatureTypeEnum> $featureType
     */
    #[JsonProperty('feature_type')]
    private ?string $featureType;

    /**
     * @var ?string $termsOfUseUrl
     */
    #[JsonProperty('terms_of_use_url')]
    private ?string $termsOfUseUrl;

    /**
     * @var ?string $privacyPolicyUrl
     */
    #[JsonProperty('privacy_policy_url')]
    private ?string $privacyPolicyUrl;

    /**
     * @var ?string $publicSupportLink
     */
    #[JsonProperty('public_support_link')]
    private ?string $publicSupportLink;

    /**
     * @var ?IntegrationRelease $currentRelease
     */
    #[JsonProperty('current_release')]
    private ?IntegrationRelease $currentRelease;

    /**
     * @var ?DateTime $createdAt
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   catalogId?: ?string,
     *   urlSlug?: ?string,
     *   partnerId?: ?string,
     *   name?: ?string,
     *   description?: ?string,
     *   shortDescription?: ?string,
     *   logo?: ?string,
     *   featureType?: ?value-of<IntegrationFeatureTypeEnum>,
     *   termsOfUseUrl?: ?string,
     *   privacyPolicyUrl?: ?string,
     *   publicSupportLink?: ?string,
     *   currentRelease?: ?IntegrationRelease,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->catalogId = $values['catalogId'] ?? null;
        $this->urlSlug = $values['urlSlug'] ?? null;
        $this->partnerId = $values['partnerId'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->shortDescription = $values['shortDescription'] ?? null;
        $this->logo = $values['logo'] ?? null;
        $this->featureType = $values['featureType'] ?? null;
        $this->termsOfUseUrl = $values['termsOfUseUrl'] ?? null;
        $this->privacyPolicyUrl = $values['privacyPolicyUrl'] ?? null;
        $this->publicSupportLink = $values['publicSupportLink'] ?? null;
        $this->currentRelease = $values['currentRelease'] ?? null;
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
    public function getCatalogId(): ?string
    {
        return $this->catalogId;
    }

    /**
     * @param ?string $value
     */
    public function setCatalogId(?string $value = null): self
    {
        $this->catalogId = $value;
        $this->_setField('catalogId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUrlSlug(): ?string
    {
        return $this->urlSlug;
    }

    /**
     * @param ?string $value
     */
    public function setUrlSlug(?string $value = null): self
    {
        $this->urlSlug = $value;
        $this->_setField('urlSlug');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPartnerId(): ?string
    {
        return $this->partnerId;
    }

    /**
     * @param ?string $value
     */
    public function setPartnerId(?string $value = null): self
    {
        $this->partnerId = $value;
        $this->_setField('partnerId');
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param ?string $value
     */
    public function setShortDescription(?string $value = null): self
    {
        $this->shortDescription = $value;
        $this->_setField('shortDescription');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    /**
     * @param ?string $value
     */
    public function setLogo(?string $value = null): self
    {
        $this->logo = $value;
        $this->_setField('logo');
        return $this;
    }

    /**
     * @return ?value-of<IntegrationFeatureTypeEnum>
     */
    public function getFeatureType(): ?string
    {
        return $this->featureType;
    }

    /**
     * @param ?value-of<IntegrationFeatureTypeEnum> $value
     */
    public function setFeatureType(?string $value = null): self
    {
        $this->featureType = $value;
        $this->_setField('featureType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTermsOfUseUrl(): ?string
    {
        return $this->termsOfUseUrl;
    }

    /**
     * @param ?string $value
     */
    public function setTermsOfUseUrl(?string $value = null): self
    {
        $this->termsOfUseUrl = $value;
        $this->_setField('termsOfUseUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPrivacyPolicyUrl(): ?string
    {
        return $this->privacyPolicyUrl;
    }

    /**
     * @param ?string $value
     */
    public function setPrivacyPolicyUrl(?string $value = null): self
    {
        $this->privacyPolicyUrl = $value;
        $this->_setField('privacyPolicyUrl');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPublicSupportLink(): ?string
    {
        return $this->publicSupportLink;
    }

    /**
     * @param ?string $value
     */
    public function setPublicSupportLink(?string $value = null): self
    {
        $this->publicSupportLink = $value;
        $this->_setField('publicSupportLink');
        return $this;
    }

    /**
     * @return ?IntegrationRelease
     */
    public function getCurrentRelease(): ?IntegrationRelease
    {
        return $this->currentRelease;
    }

    /**
     * @param ?IntegrationRelease $value
     */
    public function setCurrentRelease(?IntegrationRelease $value = null): self
    {
        $this->currentRelease = $value;
        $this->_setField('currentRelease');
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
