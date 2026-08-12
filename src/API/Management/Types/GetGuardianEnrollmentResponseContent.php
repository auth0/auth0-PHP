<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class GetGuardianEnrollmentResponseContent extends JsonSerializableType
{
    /**
     * @var string $id ID for this enrollment.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?value-of<GuardianEnrollmentStatus> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?string $name Device name (only for push notification).
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $identifier Device identifier. This is usually the phone identifier.
     */
    #[JsonProperty('identifier')]
    private ?string $identifier;

    /**
     * @var ?string $phoneNumber Phone number.
     */
    #[JsonProperty('phone_number')]
    private ?string $phoneNumber;

    /**
     * @var ?string $enrolledAt
     */
    #[JsonProperty('enrolled_at')]
    private ?string $enrolledAt;

    /**
     * @var ?string $lastAuth
     */
    #[JsonProperty('last_auth')]
    private ?string $lastAuth;

    /**
     * @param array{
     *   id: string,
     *   status?: ?value-of<GuardianEnrollmentStatus>,
     *   name?: ?string,
     *   identifier?: ?string,
     *   phoneNumber?: ?string,
     *   enrolledAt?: ?string,
     *   lastAuth?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->status = $values['status'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->identifier = $values['identifier'] ?? null;
        $this->phoneNumber = $values['phoneNumber'] ?? null;
        $this->enrolledAt = $values['enrolledAt'] ?? null;
        $this->lastAuth = $values['lastAuth'] ?? null;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?value-of<GuardianEnrollmentStatus>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<GuardianEnrollmentStatus> $value
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
     * @return ?string
     */
    public function getEnrolledAt(): ?string
    {
        return $this->enrolledAt;
    }

    /**
     * @param ?string $value
     */
    public function setEnrolledAt(?string $value = null): self
    {
        $this->enrolledAt = $value;
        $this->_setField('enrolledAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastAuth(): ?string
    {
        return $this->lastAuth;
    }

    /**
     * @param ?string $value
     */
    public function setLastAuth(?string $value = null): self
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
