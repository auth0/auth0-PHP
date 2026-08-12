<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PhoneAttributeIdentifier extends JsonSerializableType
{
    /**
     * @var ?bool $active Determines if the attribute is used for identification
     */
    #[JsonProperty('active')]
    private ?bool $active;

    /**
     * @var ?value-of<DefaultMethodPhoneNumberIdentifierEnum> $defaultMethod
     */
    #[JsonProperty('default_method')]
    private ?string $defaultMethod;

    /**
     * @param array{
     *   active?: ?bool,
     *   defaultMethod?: ?value-of<DefaultMethodPhoneNumberIdentifierEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->defaultMethod = $values['defaultMethod'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getActive(): ?bool
    {
        return $this->active;
    }

    /**
     * @param ?bool $value
     */
    public function setActive(?bool $value = null): self
    {
        $this->active = $value;
        $this->_setField('active');
        return $this;
    }

    /**
     * @return ?value-of<DefaultMethodPhoneNumberIdentifierEnum>
     */
    public function getDefaultMethod(): ?string
    {
        return $this->defaultMethod;
    }

    /**
     * @param ?value-of<DefaultMethodPhoneNumberIdentifierEnum> $value
     */
    public function setDefaultMethod(?string $value = null): self
    {
        $this->defaultMethod = $value;
        $this->_setField('defaultMethod');
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
