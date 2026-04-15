<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetGuardianFactorPhoneTemplatesResponseContent extends JsonSerializableType
{
    /**
     * @var string $enrollmentMessage Message sent to the user when they are invited to enroll with a phone number.
     */
    #[JsonProperty('enrollment_message')]
    private string $enrollmentMessage;

    /**
     * @var string $verificationMessage Message sent to the user when they are prompted to verify their account.
     */
    #[JsonProperty('verification_message')]
    private string $verificationMessage;

    /**
     * @param array{
     *   enrollmentMessage: string,
     *   verificationMessage: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->enrollmentMessage = $values['enrollmentMessage'];
        $this->verificationMessage = $values['verificationMessage'];
    }

    /**
     * @return string
     */
    public function getEnrollmentMessage(): string
    {
        return $this->enrollmentMessage;
    }

    /**
     * @param string $value
     */
    public function setEnrollmentMessage(string $value): self
    {
        $this->enrollmentMessage = $value;
        $this->_setField('enrollmentMessage');
        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationMessage(): string
    {
        return $this->verificationMessage;
    }

    /**
     * @param string $value
     */
    public function setVerificationMessage(string $value): self
    {
        $this->verificationMessage = $value;
        $this->_setField('verificationMessage');
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
