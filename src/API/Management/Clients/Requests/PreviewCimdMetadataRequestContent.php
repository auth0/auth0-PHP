<?php

namespace Auth0\SDK\API\Management\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PreviewCimdMetadataRequestContent extends JsonSerializableType
{
    /**
     * @var string $externalClientId URL to the Client ID Metadata Document
     */
    #[JsonProperty('external_client_id')]
    private string $externalClientId;

    /**
     * @param array{
     *   externalClientId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->externalClientId = $values['externalClientId'];
    }

    /**
     * @return string
     */
    public function getExternalClientId(): string
    {
        return $this->externalClientId;
    }

    /**
     * @param string $value
     */
    public function setExternalClientId(string $value): self
    {
        $this->externalClientId = $value;
        $this->_setField('externalClientId');
        return $this;
    }
}
