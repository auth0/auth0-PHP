<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupOauthCode extends JsonSerializableType
{
    /**
     * @var ?value-of<FlowsVaultConnectioSetupTypeOauthCodeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $code
     */
    #[JsonProperty('code')]
    private ?string $code;

    /**
     * @param array{
     *   type?: ?value-of<FlowsVaultConnectioSetupTypeOauthCodeEnum>,
     *   code?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->code = $values['code'] ?? null;
    }

    /**
     * @return ?value-of<FlowsVaultConnectioSetupTypeOauthCodeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<FlowsVaultConnectioSetupTypeOauthCodeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param ?string $value
     */
    public function setCode(?string $value = null): self
    {
        $this->code = $value;
        $this->_setField('code');
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
