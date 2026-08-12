<?php

namespace Auth0\SDK\API\Management\Guardian\Enrollments\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\GuardianEnrollmentFactorEnum;

class CreateGuardianEnrollmentTicketRequestContent extends JsonSerializableType
{
    /**
     * @var string $userId user_id for the enrollment ticket
     */
    #[JsonProperty('user_id')]
    private string $userId;

    /**
     * @var ?string $email alternate email to which the enrollment email will be sent. Optional - by default, the email will be sent to the user's default address
     */
    #[JsonProperty('email')]
    private ?string $email;

    /**
     * @var ?bool $sendMail Send an email to the user to start the enrollment
     */
    #[JsonProperty('send_mail')]
    private ?bool $sendMail;

    /**
     * @var ?string $emailLocale Optional. Specify the locale of the enrollment email. Used with send_email.
     */
    #[JsonProperty('email_locale')]
    private ?string $emailLocale;

    /**
     * @var ?value-of<GuardianEnrollmentFactorEnum> $factor
     */
    #[JsonProperty('factor')]
    private ?string $factor;

    /**
     * @var ?bool $allowMultipleEnrollments Optional. Allows a user who has previously enrolled in MFA to enroll with additional factors.<br />Note: Parameter can only be used with Universal Login; it cannot be used with Classic Login or custom MFA pages.
     */
    #[JsonProperty('allow_multiple_enrollments')]
    private ?bool $allowMultipleEnrollments;

    /**
     * @param array{
     *   userId: string,
     *   email?: ?string,
     *   sendMail?: ?bool,
     *   emailLocale?: ?string,
     *   factor?: ?value-of<GuardianEnrollmentFactorEnum>,
     *   allowMultipleEnrollments?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->email = $values['email'] ?? null;
        $this->sendMail = $values['sendMail'] ?? null;
        $this->emailLocale = $values['emailLocale'] ?? null;
        $this->factor = $values['factor'] ?? null;
        $this->allowMultipleEnrollments = $values['allowMultipleEnrollments'] ?? null;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $value
     */
    public function setUserId(string $value): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param ?string $value
     */
    public function setEmail(?string $value = null): self
    {
        $this->email = $value;
        $this->_setField('email');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getSendMail(): ?bool
    {
        return $this->sendMail;
    }

    /**
     * @param ?bool $value
     */
    public function setSendMail(?bool $value = null): self
    {
        $this->sendMail = $value;
        $this->_setField('sendMail');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getEmailLocale(): ?string
    {
        return $this->emailLocale;
    }

    /**
     * @param ?string $value
     */
    public function setEmailLocale(?string $value = null): self
    {
        $this->emailLocale = $value;
        $this->_setField('emailLocale');
        return $this;
    }

    /**
     * @return ?value-of<GuardianEnrollmentFactorEnum>
     */
    public function getFactor(): ?string
    {
        return $this->factor;
    }

    /**
     * @param ?value-of<GuardianEnrollmentFactorEnum> $value
     */
    public function setFactor(?string $value = null): self
    {
        $this->factor = $value;
        $this->_setField('factor');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getAllowMultipleEnrollments(): ?bool
    {
        return $this->allowMultipleEnrollments;
    }

    /**
     * @param ?bool $value
     */
    public function setAllowMultipleEnrollments(?bool $value = null): self
    {
        $this->allowMultipleEnrollments = $value;
        $this->_setField('allowMultipleEnrollments');
        return $this;
    }
}
