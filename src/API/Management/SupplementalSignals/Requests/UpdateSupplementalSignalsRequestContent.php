<?php

namespace Auth0\SDK\API\Management\SupplementalSignals\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateSupplementalSignalsRequestContent extends JsonSerializableType
{
    /**
     * @var bool $akamaiEnabled Indicates if incoming Akamai Headers should be processed
     */
    #[JsonProperty('akamai_enabled')]
    private bool $akamaiEnabled;

    /**
     * @param array{
     *   akamaiEnabled: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->akamaiEnabled = $values['akamaiEnabled'];
    }

    /**
     * @return bool
     */
    public function getAkamaiEnabled(): bool
    {
        return $this->akamaiEnabled;
    }

    /**
     * @param bool $value
     */
    public function setAkamaiEnabled(bool $value): self
    {
        $this->akamaiEnabled = $value;
        $this->_setField('akamaiEnabled');
        return $this;
    }
}
