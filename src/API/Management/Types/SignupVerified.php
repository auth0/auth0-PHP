<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class SignupVerified extends JsonSerializableType
{
    /**
     * @var ?value-of<SignupStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?SignupVerification $verification
     */
    #[JsonProperty('verification')]
    private ?SignupVerification $verification;

    /**
     * @param array{
     *   status?: ?value-of<SignupStatusEnum>,
     *   verification?: ?SignupVerification,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->status = $values['status'] ?? null;
        $this->verification = $values['verification'] ?? null;
    }

    /**
     * @return ?value-of<SignupStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<SignupStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?SignupVerification
     */
    public function getVerification(): ?SignupVerification
    {
        return $this->verification;
    }

    /**
     * @param ?SignupVerification $value
     */
    public function setVerification(?SignupVerification $value = null): self
    {
        $this->verification = $value;
        $this->_setField('verification');
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
