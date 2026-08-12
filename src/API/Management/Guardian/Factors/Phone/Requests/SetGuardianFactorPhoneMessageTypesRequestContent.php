<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Phone\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\GuardianFactorPhoneFactorMessageTypeEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class SetGuardianFactorPhoneMessageTypesRequestContent extends JsonSerializableType
{
    /**
     * @var array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>> $messageTypes The list of phone factors to enable on the tenant. Can include `sms` and `voice`.
     */
    #[JsonProperty('message_types'), ArrayType(['string'])]
    private array $messageTypes;

    /**
     * @param array{
     *   messageTypes: array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->messageTypes = $values['messageTypes'];
    }

    /**
     * @return array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>>
     */
    public function getMessageTypes(): array
    {
        return $this->messageTypes;
    }

    /**
     * @param array<value-of<GuardianFactorPhoneFactorMessageTypeEnum>> $value
     */
    public function setMessageTypes(array $value): self
    {
        $this->messageTypes = $value;
        $this->_setField('messageTypes');
        return $this;
    }
}
