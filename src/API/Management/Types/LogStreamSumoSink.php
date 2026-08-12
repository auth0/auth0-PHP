<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class LogStreamSumoSink extends JsonSerializableType
{
    /**
     * @var string $sumoSourceAddress HTTP Source Address
     */
    #[JsonProperty('sumoSourceAddress')]
    private string $sumoSourceAddress;

    /**
     * @param array{
     *   sumoSourceAddress: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->sumoSourceAddress = $values['sumoSourceAddress'];
    }

    /**
     * @return string
     */
    public function getSumoSourceAddress(): string
    {
        return $this->sumoSourceAddress;
    }

    /**
     * @param string $value
     */
    public function setSumoSourceAddress(string $value): self
    {
        $this->sumoSourceAddress = $value;
        $this->_setField('sumoSourceAddress');
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
