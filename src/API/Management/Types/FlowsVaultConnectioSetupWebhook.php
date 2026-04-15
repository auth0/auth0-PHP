<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FlowsVaultConnectioSetupWebhook extends JsonSerializableType
{
    /**
     * @var value-of<FlowsVaultConnectioSetupTypeWebhookEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var string $url
     */
    #[JsonProperty('url')]
    private string $url;

    /**
     * @param array{
     *   type: value-of<FlowsVaultConnectioSetupTypeWebhookEnum>,
     *   url: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->url = $values['url'];
    }

    /**
     * @return value-of<FlowsVaultConnectioSetupTypeWebhookEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<FlowsVaultConnectioSetupTypeWebhookEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $value
     */
    public function setUrl(string $value): self
    {
        $this->url = $value;
        $this->_setField('url');
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
