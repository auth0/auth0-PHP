<?php

namespace Auth0\SDK\API\Management\SelfServiceProfiles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\SelfServiceProfileBrandingProperties;
use Auth0\SDK\API\Management\Types\SelfServiceProfileAllowedStrategyEnum;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\SelfServiceProfileUserAttribute;

class CreateSelfServiceProfileRequestContent extends JsonSerializableType
{
    /**
     * @var string $name The name of the self-service Profile.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $description The description of the self-service Profile.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?SelfServiceProfileBrandingProperties $branding
     */
    #[JsonProperty('branding')]
    private ?SelfServiceProfileBrandingProperties $branding;

    /**
     * @var ?array<value-of<SelfServiceProfileAllowedStrategyEnum>> $allowedStrategies List of IdP strategies that will be shown to users during the Self-Service SSO flow. Possible values: [`oidc`, `samlp`, `waad`, `google-apps`, `adfs`, `okta`, `auth0-samlp`, `okta-samlp`, `keycloak-samlp`, `pingfederate`]
     */
    #[JsonProperty('allowed_strategies'), ArrayType(['string'])]
    private ?array $allowedStrategies;

    /**
     * @var ?array<SelfServiceProfileUserAttribute> $userAttributes List of attributes to be mapped that will be shown to the user during the SS-SSO flow.
     */
    #[JsonProperty('user_attributes'), ArrayType([SelfServiceProfileUserAttribute::class])]
    private ?array $userAttributes;

    /**
     * @var ?string $userAttributeProfileId ID of the user-attribute-profile to associate with this self-service profile.
     */
    #[JsonProperty('user_attribute_profile_id')]
    private ?string $userAttributeProfileId;

    /**
     * @param array{
     *   name: string,
     *   description?: ?string,
     *   branding?: ?SelfServiceProfileBrandingProperties,
     *   allowedStrategies?: ?array<value-of<SelfServiceProfileAllowedStrategyEnum>>,
     *   userAttributes?: ?array<SelfServiceProfileUserAttribute>,
     *   userAttributeProfileId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->branding = $values['branding'] ?? null;
        $this->allowedStrategies = $values['allowedStrategies'] ?? null;
        $this->userAttributes = $values['userAttributes'] ?? null;
        $this->userAttributeProfileId = $values['userAttributeProfileId'] ?? null;
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
}
