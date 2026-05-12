<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Reference to a tenant in event context
 */
class EventStreamCloudEventContextTenant extends JsonSerializableType
{
    /**
     * @var string $tenantId Machine-generated unique tenant identifier.
     */
    #[JsonProperty('tenant_id')]
    private string $tenantId;

    /**
     * @param array{
     *   tenantId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->tenantId = $values['tenantId'];
    }

    /**
     * @return string
     */
    public function getTenantId(): string
    {
        return $this->tenantId;
    }

    /**
     * @param string $value
     */
    public function setTenantId(string $value): self
    {
        $this->tenantId = $value;
        $this->_setField('tenantId');
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
