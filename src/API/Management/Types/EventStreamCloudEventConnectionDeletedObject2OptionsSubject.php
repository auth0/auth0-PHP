<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

/**
 * Certificate Subject Distinguished Name (DN) extracted from the identity provider's signing certificate.
 */
class EventStreamCloudEventConnectionDeletedObject2OptionsSubject extends JsonSerializableType
{
    /**
     * @param array{
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        unset($values);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
