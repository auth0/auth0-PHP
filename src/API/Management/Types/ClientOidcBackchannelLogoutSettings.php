<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for OIDC backchannel logout
 */
class ClientOidcBackchannelLogoutSettings extends JsonSerializableType
{
    /**
     * @var ?array<string> $backchannelLogoutUrls Comma-separated list of URLs that are valid to call back from Auth0 for OIDC backchannel logout. Currently only one URL is allowed.
     */
    #[JsonProperty('backchannel_logout_urls'), ArrayType(['string'])]
    private ?array $backchannelLogoutUrls;

    /**
     * @var ?ClientOidcBackchannelLogoutInitiators $backchannelLogoutInitiators
     */
    #[JsonProperty('backchannel_logout_initiators')]
    private ?ClientOidcBackchannelLogoutInitiators $backchannelLogoutInitiators;

    /**
     * @var ?ClientOidcBackchannelLogoutSessionMetadata $backchannelLogoutSessionMetadata
     */
    #[JsonProperty('backchannel_logout_session_metadata')]
    private ?ClientOidcBackchannelLogoutSessionMetadata $backchannelLogoutSessionMetadata;

    /**
     * @param array{
     *   backchannelLogoutUrls?: ?array<string>,
     *   backchannelLogoutInitiators?: ?ClientOidcBackchannelLogoutInitiators,
     *   backchannelLogoutSessionMetadata?: ?ClientOidcBackchannelLogoutSessionMetadata,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->backchannelLogoutUrls = $values['backchannelLogoutUrls'] ?? null;
        $this->backchannelLogoutInitiators = $values['backchannelLogoutInitiators'] ?? null;
        $this->backchannelLogoutSessionMetadata = $values['backchannelLogoutSessionMetadata'] ?? null;
    }

    /**
     * @return ?array<string>
     */
    public function getBackchannelLogoutUrls(): ?array
    {
        return $this->backchannelLogoutUrls;
    }

    /**
     * @param ?array<string> $value
     */
    public function setBackchannelLogoutUrls(?array $value = null): self
    {
        $this->backchannelLogoutUrls = $value;
        $this->_setField('backchannelLogoutUrls');
        return $this;
    }

    /**
     * @return ?ClientOidcBackchannelLogoutInitiators
     */
    public function getBackchannelLogoutInitiators(): ?ClientOidcBackchannelLogoutInitiators
    {
        return $this->backchannelLogoutInitiators;
    }

    /**
     * @param ?ClientOidcBackchannelLogoutInitiators $value
     */
    public function setBackchannelLogoutInitiators(?ClientOidcBackchannelLogoutInitiators $value = null): self
    {
        $this->backchannelLogoutInitiators = $value;
        $this->_setField('backchannelLogoutInitiators');
        return $this;
    }

    /**
     * @return ?ClientOidcBackchannelLogoutSessionMetadata
     */
    public function getBackchannelLogoutSessionMetadata(): ?ClientOidcBackchannelLogoutSessionMetadata
    {
        return $this->backchannelLogoutSessionMetadata;
    }

    /**
     * @param ?ClientOidcBackchannelLogoutSessionMetadata $value
     */
    public function setBackchannelLogoutSessionMetadata(?ClientOidcBackchannelLogoutSessionMetadata $value = null): self
    {
        $this->backchannelLogoutSessionMetadata = $value;
        $this->_setField('backchannelLogoutSessionMetadata');
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
