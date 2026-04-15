<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=pingfederate
 */
class UpdateConnectionRequestContentPingFederate extends JsonSerializableType
{
    use ConnectionCommon;

    /**
     * @var ?ConnectionOptionsPingFederate $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsPingFederate $options;

    /**
     * @var ?bool $showAsButton
     */
    #[JsonProperty('show_as_button')]
    private ?bool $showAsButton;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   options?: ?ConnectionOptionsPingFederate,
     *   showAsButton?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->options = $values['options'] ?? null;
        $this->showAsButton = $values['showAsButton'] ?? null;
    }

    /**
     * @return ?ConnectionOptionsPingFederate
     */
    public function getOptions(): ?ConnectionOptionsPingFederate
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsPingFederate $value
     */
    public function setOptions(?ConnectionOptionsPingFederate $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getShowAsButton(): ?bool
    {
        return $this->showAsButton;
    }

    /**
     * @param ?bool $value
     */
    public function setShowAsButton(?bool $value = null): self
    {
        $this->showAsButton = $value;
        $this->_setField('showAsButton');
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
