<?php

namespace Auth0\SDK\API\Management\CustomDomains\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SetDefaultCustomDomainRequestContent extends JsonSerializableType
{
    /**
     * @var string $domain The domain to set as the default custom domain. Must be a verified custom domain or the canonical domain.
     */
    #[JsonProperty('domain')]
    private string $domain;

    /**
     * @param array{
     *   domain: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domain = $values['domain'];
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $value
     */
    public function setDomain(string $value): self
    {
        $this->domain = $value;
        $this->_setField('domain');
        return $this;
    }
}
