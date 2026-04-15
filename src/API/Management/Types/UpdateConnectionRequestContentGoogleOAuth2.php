<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Traits\ConnectionCommon;
use Auth0\SDK\API\Management\Traits\ConnectionPurposes;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Update a connection with strategy=google-oauth2
 */
class UpdateConnectionRequestContentGoogleOAuth2 extends JsonSerializableType
{
    use ConnectionCommon;
    use ConnectionPurposes;

    /**
     * @var ?ConnectionOptionsGoogleOAuth2 $options
     */
    #[JsonProperty('options')]
    private ?ConnectionOptionsGoogleOAuth2 $options;

    /**
     * @param array{
     *   displayName?: ?string,
     *   enabledClients?: ?array<string>,
     *   isDomainConnection?: ?bool,
     *   metadata?: ?array<string, ?string>,
     *   authentication?: ?ConnectionAuthenticationPurpose,
     *   connectedAccounts?: ?ConnectionConnectedAccountsPurpose,
     *   options?: ?ConnectionOptionsGoogleOAuth2,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->displayName = $values['displayName'] ?? null;
        $this->enabledClients = $values['enabledClients'] ?? null;
        $this->isDomainConnection = $values['isDomainConnection'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->authentication = $values['authentication'] ?? null;
        $this->connectedAccounts = $values['connectedAccounts'] ?? null;
        $this->options = $values['options'] ?? null;
    }

    /**
     * @return ?ConnectionOptionsGoogleOAuth2
     */
    public function getOptions(): ?ConnectionOptionsGoogleOAuth2
    {
        return $this->options;
    }

    /**
     * @param ?ConnectionOptionsGoogleOAuth2 $value
     */
    public function setOptions(?ConnectionOptionsGoogleOAuth2 $value = null): self
    {
        $this->options = $value;
        $this->_setField('options');
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
