<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class UsersEnrollment extends JsonSerializableType
{
    /**
     * @var ?string $id ID of this enrollment.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?value-of<UserEnrollmentStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?string $type Type of enrollment.
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $name Name of enrollment (usually phone number).
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $identifier Device identifier (usually phone identifier) of this enrollment.
     */
    #[JsonProperty('identifier')]
    private ?string $identifier;

    /**
     * @var ?string $phoneNumber Phone number for this enrollment.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?value-of<UserEnrollmentAuthMethodEnum> $authMethod
     */
    #[JsonProperty('auth_method')]
    private ?string $authMethod;

    /**
     * @var ?DateTime $enrolledAt Start date and time of this enrollment.
     */
    #[JsonProperty('enrolled_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $enrolledAt;

    /**
     * @var ?DateTime $lastAuth Last authentication date and time of this enrollment.
     */
    #[JsonProperty('last_auth'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $lastAuth;

    /**
     * @param array{
     *   id?: ?string,
     *   status?: ?value-of<UserEnrollmentStatusEnum>,
     *   type?: ?string,
     *   name?: ?string,
     *   identifier?: ?string,
     *   phoneNumber?: ?string,
     *   authMethod?: ?value-of<UserEnrollmentAuthMethodEnum>,
     *   enrolledAt?: ?DateTime,
     *   lastAuth?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->identifier = $values['identifier'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->authMethod = $values['authMethod'] ?? null;
        $this->enrolledAt = $values['enrolledAt'] ?? null;
        $this->lastAuth = $values['lastAuth'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?value-of<UserEnrollmentStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<UserEnrollmentStatusEnum> $value
     */
    public function setStatus(?string $value = null): self
    {
        $this->status = $value;
        $this->_setField('status');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?string $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param ?string $value
     */
    public function setIdentifier(?string $value = null): self
    {
        $this->identifier = $value;
        $this->_setField('identifier');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param ?string $value
     */
    public function setPhoneNumber(?string $value = null): self
    {
        $this->phoneNumber = $value;
        $this->_setField('phoneNumber');
        return $this;
    }

    /**
     * @return ?value-of<UserEnrollmentAuthMethodEnum>
     */
    public function getAuthMethod(): ?string
    {
        return $this->authMethod;
    }

    /**
     * @param ?value-of<UserEnrollmentAuthMethodEnum> $value
     */
    public function setAuthMethod(?string $value = null): self
    {
        $this->authMethod = $value;
        $this->_setField('authMethod');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getEnrolledAt(): ?DateTime
    {
        return $this->enrolledAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setEnrolledAt(?DateTime $value = null): self
    {
        $this->enrolledAt = $value;
        $this->_setField('enrolledAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getLastAuth(): ?DateTime
    {
        return $this->lastAuth;
    }

    /**
     * @param ?DateTime $value
     */
    public function setLastAuth(?DateTime $value = null): self
    {
        $this->lastAuth = $value;
        $this->_setField('lastAuth');
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
