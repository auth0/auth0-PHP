<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class EmailProviderCredentialsSchemaThree extends JsonSerializableType
{
    /**
     * @var ?string $apiKey API Key
     */
    #[JsonProperty('api_key')]
    private ?string $apiKey;

    /**
     * @var ?value-of<EmailSparkPostRegionEnum> $region
     */
    #[JsonProperty('region')]
    private ?string $region;

    /**
     * @param array{
     *   apiKey?: ?string,
     *   region?: ?value-of<EmailSparkPostRegionEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->apiKey = $values['apiKey'] ?? null;
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
     * @return ?value-of<EmailSparkPostRegionEnum>
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @param ?value-of<EmailSparkPostRegionEnum> $value
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
