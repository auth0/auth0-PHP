<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Adobe EchoSign SSO configuration.
 */
class ClientAddonEchoSign extends JsonSerializableType
{
    /**
     * @var ?string $domain Your custom domain found in your EchoSign URL. e.g. `https://acme-org.echosign.com` would be `acme-org`.
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @param array{
     *   domain?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->domain = $values['domain'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param ?string $value
     */
    public function setDomain(?string $value = null): self
    {
        $this->domain = $value;
        $this->_setField('domain');
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
