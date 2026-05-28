<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class SelfServiceProfile extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the self-service Profile.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $name The name of the self-service Profile.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $description The description of the self-service Profile.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?array<SelfServiceProfileUserAttribute> $userAttributes List of attributes to be mapped that will be shown to the user during the Self-Service Enterprise Configuration flow.
     */
    #[JsonProperty('user_attributes'), ArrayType([SelfServiceProfileUserAttribute::class])]
    private ?array $userAttributes;

    /**
     * @var ?DateTime $createdAt The time when this self-service Profile was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when this self-service Profile was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @var ?SelfServiceProfileBrandingProperties $branding
     */
    #[JsonProperty('branding')]
    private ?SelfServiceProfileBrandingProperties $branding;

    /**
     * @var ?array<value-of<SelfServiceProfileAllowedStrategyEnum>> $allowedStrategies List of IdP strategies that will be shown to users during the Self-Service Enterprise Configuration flow. Possible values: [`oidc`, `samlp`, `waad`, `google-apps`, `adfs`, `okta`, `auth0-samlp`, `okta-samlp`, `keycloak-samlp`, `pingfederate`]
     */
    #[JsonProperty('allowed_strategies'), ArrayType(['string'])]
    private ?array $allowedStrategies;

    /**
     * @var ?string $userAttributeProfileId ID of the user-attribute-profile to associate with this self-service profile.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private ?string $userAttributeProfileId;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   description?: ?string,
     *   userAttributes?: ?array<SelfServiceProfileUserAttribute>,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     *   branding?: ?SelfServiceProfileBrandingProperties,
     *   allowedStrategies?: ?array<value-of<SelfServiceProfileAllowedStrategyEnum>>,
     *   userAttributeProfileId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->userAttributes = $values['userAttributes'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->branding = $values['branding'] ?? null;
        $this->allowedStrategies = $values['allowedStrategies'] ?? null;
        $this->userAttributeProfileId = $values['userAttributeProfileId'] ?? null;
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
     * @return ?array<SelfServiceProfileUserAttribute>
     */
    public function getUserAttributes(): ?array
    {
        return $this->userAttributes;
    }

    /**
     * @param ?array<SelfServiceProfileUserAttribute> $value
     */
    public function setUserAttributes(?array $value = null): self
    {
        $this->userAttributes = $value;
        $this->_setField('userAttributes');
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
     * @return ?SelfServiceProfileBrandingProperties
     */
    public function getBranding(): ?SelfServiceProfileBrandingProperties
    {
        return $this->branding;
    }

    /**
     * @param ?SelfServiceProfileBrandingProperties $value
     */
    public function setBranding(?SelfServiceProfileBrandingProperties $value = null): self
    {
        $this->branding = $value;
        $this->_setField('branding');
        return $this;
    }

    /**
     * @return ?array<value-of<SelfServiceProfileAllowedStrategyEnum>>
     */
    public function getAllowedStrategies(): ?array
    {
        return $this->allowedStrategies;
    }

    /**
     * @param ?array<value-of<SelfServiceProfileAllowedStrategyEnum>> $value
     */
    public function setAllowedStrategies(?array $value = null): self
    {
        $this->allowedStrategies = $value;
        $this->_setField('allowedStrategies');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserAttributeProfileId(): ?string
    {
        return $this->userAttributeProfileId;
    }

    /**
     * @param ?string $value
     */
    public function setUserAttributeProfileId(?string $value = null): self
    {
        $this->userAttributeProfileId = $value;
        $this->_setField('userAttributeProfileId');
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
