<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateTokenQuota extends JsonSerializableType
{
    /**
     * @var TokenQuotaClientCredentials $clientCredentials
     */
    #[JsonProperty('client_credentials')]
    private TokenQuotaClientCredentials $clientCredentials;

    /**
     * @param array{
     *   clientCredentials: TokenQuotaClientCredentials,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->clientCredentials = $values['clientCredentials'];
    }

    /**
     * @return TokenQuotaClientCredentials
     */
    public function getClientCredentials(): TokenQuotaClientCredentials
    {
        return $this->clientCredentials;
    }

    /**
     * @param TokenQuotaClientCredentials $value
     */
    public function setClientCredentials(TokenQuotaClientCredentials $value): self
    {
        $this->clientCredentials = $value;
        $this->_setField('clientCredentials');
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
