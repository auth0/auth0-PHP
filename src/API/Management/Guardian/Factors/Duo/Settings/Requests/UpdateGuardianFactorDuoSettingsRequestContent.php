<?php

namespace Auth0\SDK\API\Management\Guardian\Factors\Duo\Settings\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateGuardianFactorDuoSettingsRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $ikey
     */
    #[JsonProperty('ikey')]
    private ?string $ikey;

    /**
     * @var ?string $skey
     */
    #[JsonProperty('skey')]
    private ?string $skey;

    /**
     * @var ?string $host
     */
    #[JsonProperty('host')]
    private ?string $host;

    /**
     * @param array{
     *   ikey?: ?string,
     *   skey?: ?string,
     *   host?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->ikey = $values['ikey'] ?? null;
        $this->skey = $values['skey'] ?? null;
        $this->host = $values['host'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getIkey(): ?string
    {
        return $this->ikey;
    }

    /**
     * @param ?string $value
     */
    public function setIkey(?string $value = null): self
    {
        $this->ikey = $value;
        $this->_setField('ikey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSkey(): ?string
    {
        return $this->skey;
    }

    /**
     * @param ?string $value
     */
    public function setSkey(?string $value = null): self
    {
        $this->skey = $value;
        $this->_setField('skey');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @param ?string $value
     */
    public function setHost(?string $value = null): self
    {
        $this->host = $value;
        $this->_setField('host');
        return $this;
    }
}
