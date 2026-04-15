<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class DailyStats extends JsonSerializableType
{
    /**
     * @var ?string $date Date these events occurred in ISO 8601 format.
     */
    #[JsonProperty('date')]
    private ?string $date;

    /**
     * @var ?int $logins Number of logins on this date.
     */
    #[JsonProperty('logins')]
    private ?int $logins;

    /**
     * @var ?int $signups Number of signups on this date.
     */
    #[JsonProperty('signups')]
    private ?int $signups;

    /**
     * @var ?int $leakedPasswords Number of breached-password detections on this date (subscription required).
     */
    #[JsonProperty('leaked_passwords')]
    private ?int $leakedPasswords;

    /**
     * @var ?string $updatedAt Date and time this stats entry was last updated in ISO 8601 format.
     */
    #[JsonProperty('updated_at')]
    private ?string $updatedAt;

    /**
     * @var ?string $createdAt Approximate date and time the first event occurred in ISO 8601 format.
     */
    #[JsonProperty('created_at')]
    private ?string $createdAt;

    /**
     * @param array{
     *   date?: ?string,
     *   logins?: ?int,
     *   signups?: ?int,
     *   leakedPasswords?: ?int,
     *   updatedAt?: ?string,
     *   createdAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->date = $values['date'] ?? null;
        $this->logins = $values['logins'] ?? null;
        $this->signups = $values['signups'] ?? null;
        $this->leakedPasswords = $values['leakedPasswords'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param ?string $value
     */
    public function setDate(?string $value = null): self
    {
        $this->date = $value;
        $this->_setField('date');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLogins(): ?int
    {
        return $this->logins;
    }

    /**
     * @param ?int $value
     */
    public function setLogins(?int $value = null): self
    {
        $this->logins = $value;
        $this->_setField('logins');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getSignups(): ?int
    {
        return $this->signups;
    }

    /**
     * @param ?int $value
     */
    public function setSignups(?int $value = null): self
    {
        $this->signups = $value;
        $this->_setField('signups');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getLeakedPasswords(): ?int
    {
        return $this->leakedPasswords;
    }

    /**
     * @param ?int $value
     */
    public function setLeakedPasswords(?int $value = null): self
    {
        $this->leakedPasswords = $value;
        $this->_setField('leakedPasswords');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param ?string $value
     */
    public function setUpdatedAt(?string $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param ?string $value
     */
    public function setCreatedAt(?string $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
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
