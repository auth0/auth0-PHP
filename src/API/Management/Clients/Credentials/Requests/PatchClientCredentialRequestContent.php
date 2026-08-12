<?php

namespace Auth0\SDK\API\Management\Clients\Credentials\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use DateTime;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Date;

class PatchClientCredentialRequestContent extends JsonSerializableType
{
    /**
     * @var ?DateTime $expiresAt The ISO 8601 formatted date representing the expiration of the credential.
     */
    #[JsonProperty('expires_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $expiresAt;

    /**
     * @param array{
     *   expiresAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->expiresAt = $values['expiresAt'] ?? null;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setExpiresAt(?DateTime $value = null): self
    {
        $this->expiresAt = $value;
        $this->_setField('expiresAt');
        return $this;
    }
}
