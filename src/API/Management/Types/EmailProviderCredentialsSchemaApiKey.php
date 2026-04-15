<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaApiKey extends JsonSerializableType
{
    /**
     * @var ?string $apiKey API Key
     */
    #[JsonProperty('api_key')]
    private ?string $apiKey;

    /**
     * @var ?string $domain Domain
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?value-of<EmailMailgunRegionEnum> $region
     */
    #[JsonProperty('region')]
    private ?string $region;

    /**
     * @param array{
     *   apiKey?: ?string,
     *   domain?: ?string,
     *   region?: ?value-of<EmailMailgunRegionEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->apiKey = $values['apiKey'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->region = $values['region'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param ?string $value
     */
    public function setApiKey(?string $value = null): self
    {
        $this->apiKey = $value;
        $this->_setField('apiKey');
        return $this;
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
     * @return ?value-of<EmailMailgunRegionEnum>
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param ?value-of<EmailMailgunRegionEnum> $value
     */
    public function setRegion(?string $value = null): self
    {
        $this->region = $value;
        $this->_setField('region');
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
