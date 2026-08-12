<?php

namespace Auth0\SDK\API\Management\AttackProtection\PhoneProviderProtection\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PhoneProviderProtectionBackoffStrategyEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PatchPhoneProviderProtectionRequestContent extends JsonSerializableType
{
    /**
     * @var value-of<PhoneProviderProtectionBackoffStrategyEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @param array{
     *   type: value-of<PhoneProviderProtectionBackoffStrategyEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
    }

    /**
     * @return value-of<PhoneProviderProtectionBackoffStrategyEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<PhoneProviderProtectionBackoffStrategyEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }
}
