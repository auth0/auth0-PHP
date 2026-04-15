<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Salesforce SSO configuration.
 */
class ClientAddonSalesforce extends JsonSerializableType
{
    /**
     * @var ?string $entityId Arbitrary logical URL that identifies the Saleforce resource. e.g. `https://acme-org.com`.
     */
    #[JsonProperty('entity_id')]
    private ?string $entityId;

    /**
     * @param array{
     *   entityId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->entityId = $values['entityId'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }

    /**
     * @param ?string $value
     */
    public function setEntityId(?string $value = null): self
    {
        $this->entityId = $value;
        $this->_setField('entityId');
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
