<?php

namespace Auth0\SDK\API\Management\Users\AuthenticationMethods\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\PreferredAuthenticationMethodEnum;

class UpdateUserAuthenticationMethodRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name A human-readable label to identify the authentication method.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?value-of<PreferredAuthenticationMethodEnum> $preferredAuthenticationMethod Preferred phone authentication method
     */
    #[JsonProperty('preferred_authentication_method')]
    private ?string $preferredAuthenticationMethod;

    /**
     * @param array{
     *   name?: ?string,
     *   preferredAuthenticationMethod?: ?value-of<PreferredAuthenticationMethodEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->preferredAuthenticationMethod = $values['preferredAuthenticationMethod'] ?? null;
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
     * @return ?value-of<PreferredAuthenticationMethodEnum>
     */
    public function getPreferredAuthenticationMethod(): ?string
    {
        return $this->preferredAuthenticationMethod;
    }

    /**
     * @param ?value-of<PreferredAuthenticationMethodEnum> $value
     */
    public function setPreferredAuthenticationMethod(?string $value = null): self
    {
        $this->preferredAuthenticationMethod = $value;
        $this->_setField('preferredAuthenticationMethod');
        return $this;
    }
}
