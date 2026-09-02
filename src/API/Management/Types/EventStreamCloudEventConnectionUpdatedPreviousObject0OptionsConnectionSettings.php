<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * OAuth 2.0 PKCE (Proof Key for Code Exchange) settings. PKCE enhances security for public clients by preventing authorization code interception attacks. 'auto' (recommended) uses the strongest method supported by the IdP.
 */
class EventStreamCloudEventConnectionUpdatedPreviousObject0OptionsConnectionSettings extends JsonSerializableType
{
    /**
     * @var ?value-of<EventStreamCloudEventConnectionUpdatedPreviousObject0OptionsConnectionSettingsPkceEnum> $pkce
     */
    #[JsonProperty('pkce')]
    private ?string $pkce;

    /**
     * @param array{
     *   pkce?: ?value-of<EventStreamCloudEventConnectionUpdatedPreviousObject0OptionsConnectionSettingsPkceEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->pkce = $values['pkce'] ?? null;
    }

    /**
     * @return ?value-of<EventStreamCloudEventConnectionUpdatedPreviousObject0OptionsConnectionSettingsPkceEnum>
     */
    public function getPkce(): ?string
    {
        return $this->pkce;
    }

    /**
     * @param ?value-of<EventStreamCloudEventConnectionUpdatedPreviousObject0OptionsConnectionSettingsPkceEnum> $value
     */
    public function setPkce(?string $value = null): self
    {
        $this->pkce = $value;
        $this->_setField('pkce');
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
