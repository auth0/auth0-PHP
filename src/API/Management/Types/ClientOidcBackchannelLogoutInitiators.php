<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for OIDC backchannel logout initiators
 */
class ClientOidcBackchannelLogoutInitiators extends JsonSerializableType
{
    /**
     * @var ?value-of<ClientOidcBackchannelLogoutInitiatorsModeEnum> $mode
     */
    #[JsonProperty('mode')]
    private ?string $mode;

    /**
     * @var ?array<value-of<ClientOidcBackchannelLogoutInitiatorsEnum>> $selectedInitiators
     */
    #[JsonProperty('selected_initiators'), ArrayType(['string'])]
    private ?array $selectedInitiators;

    /**
     * @param array{
     *   mode?: ?value-of<ClientOidcBackchannelLogoutInitiatorsModeEnum>,
     *   selectedInitiators?: ?array<value-of<ClientOidcBackchannelLogoutInitiatorsEnum>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->mode = $values['mode'] ?? null;
        $this->selectedInitiators = $values['selectedInitiators'] ?? null;
    }

    /**
     * @return ?value-of<ClientOidcBackchannelLogoutInitiatorsModeEnum>
     */
    public function getMode(): ?string
    {
        return $this->mode;
    }

    /**
     * @param ?value-of<ClientOidcBackchannelLogoutInitiatorsModeEnum> $value
     */
    public function setMode(?string $value = null): self
    {
        $this->mode = $value;
        $this->_setField('mode');
        return $this;
    }

    /**
     * @return ?array<value-of<ClientOidcBackchannelLogoutInitiatorsEnum>>
     */
    public function getSelectedInitiators(): ?array
    {
        return $this->selectedInitiators;
    }

    /**
     * @param ?array<value-of<ClientOidcBackchannelLogoutInitiatorsEnum>> $value
     */
    public function setSelectedInitiators(?array $value = null): self
    {
        $this->selectedInitiators = $value;
        $this->_setField('selectedInitiators');
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
