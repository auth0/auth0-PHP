<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaClientId extends JsonSerializableType
{
    /**
     * @var ?string $tenantId Microsoft 365 Tenant ID.
     */
    #[JsonProperty('tenantId')]
    private ?string $tenantId;

    /**
     * @var ?string $clientId Microsoft 365 Client ID.
     */
    #[JsonProperty('clientId')]
    private ?string $clientId;

    /**
     * @var ?string $clientSecret Microsoft 365 Client Secret.
     */
    #[JsonProperty('clientSecret')]
    private ?string $clientSecret;

    /**
     * @param array{
     *   tenantId?: ?string,
     *   clientId?: ?string,
     *   clientSecret?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->tenantId = $values['tenantId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientSecret = $values['clientSecret'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }

    /**
     * @param ?string $value
     */
    public function setTenantId(?string $value = null): self
    {
        $this->tenantId = $value;
        $this->_setField('tenantId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param ?string $value
     */
    public function setClientSecret(?string $value = null): self
    {
        $this->clientSecret = $value;
        $this->_setField('clientSecret');
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
