<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RegenerateUsersRecoveryCodeResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $recoveryCode New account recovery code.
     */
    #[JsonProperty('recovery_code')]
    private ?string $recoveryCode;

    /**
     * @param array{
     *   recoveryCode?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->recoveryCode = $values['recoveryCode'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getRecoveryCode(): ?string
    {
        return $this->recoveryCode;
    }

    /**
     * @param ?string $value
     */
    public function setRecoveryCode(?string $value = null): self
    {
        $this->recoveryCode = $value;
        $this->_setField('recoveryCode');
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
