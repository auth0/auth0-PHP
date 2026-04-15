<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SetGuardianFactorPhoneMessageTypesResponseContent extends JsonSerializableType
{
    /**
     * @var ?array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>> $messageTypes The list of phone factors to enable on the tenant. Can include `sms` and `voice`.
     */
    #[JsonProperty('message_types'), ArrayType(['string'])]
    private ?array $messageTypes;

    /**
     * @param array{
     *   messageTypes?: ?array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->messageTypes = $values['messageTypes'] ?? null;
    }

    /**
     * @return ?array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>>
     */
    public function getMessageTypes(): ?array
    {
        return $this->messageTypes;
    }

    /**
     * @param ?array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>> $value
     */
    public function setMessageTypes(?array $value = null): self
    {
        $this->messageTypes = $value;
        $this->_setField('messageTypes');
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
