<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Domain verification settings.
 */
class DomainVerification extends JsonSerializableType
{
    /**
     * @var ?array<DomainVerificationMethod> $methods Domain verification methods.
     */
    #[JsonProperty('methods'), ArrayType([DomainVerificationMethod::class])]
    private ?array $methods;

    /**
     * @var ?value-of<DomainVerificationStatusEnum> $status
     */
    #[JsonProperty('status')]
    private ?string $status;

    /**
     * @var ?string $errorMsg The user0-friendly error message in case of failed verification. This field is relevant only for Custom Domains with Auth0-Managed Certificates.
     */
    #[JsonProperty('error_msg')]
    private ?string $errorMsg;

    /**
     * @var ?string $lastVerifiedAt The date and time when the custom domain was last verified. This field is relevant only for Custom Domains with Auth0-Managed Certificates.
     */
    #[JsonProperty('last_verified_at')]
    private ?string $lastVerifiedAt;

    /**
     * @param array{
     *   methods?: ?array<DomainVerificationMethod>,
     *   status?: ?value-of<DomainVerificationStatusEnum>,
     *   errorMsg?: ?string,
     *   lastVerifiedAt?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->methods = $values['methods'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->errorMsg = $values['errorMsg'] ?? null;
        $this->lastVerifiedAt = $values['lastVerifiedAt'] ?? null;
    }

    /**
     * @return ?array<DomainVerificationMethod>
     */
    public function getMethods(): ?array
    {
        return $this->methods;
    }

    /**
     * @param ?array<DomainVerificationMethod> $value
     */
    public function setMethods(?array $value = null): self
    {
        $this->methods = $value;
        $this->_setField('methods');
        return $this;
    }

    /**
     * @return ?value-of<DomainVerificationStatusEnum>
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param ?value-of<DomainVerificationStatusEnum> $value
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
    public function getErrorMsg(): ?string
    {
        return $this->errorMsg;
    }

    /**
     * @param ?string $value
     */
    public function setErrorMsg(?string $value = null): self
    {
        $this->errorMsg = $value;
        $this->_setField('errorMsg');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLastVerifiedAt(): ?string
    {
        return $this->lastVerifiedAt;
    }

    /**
     * @param ?string $value
     */
    public function setLastVerifiedAt(?string $value = null): self
    {
        $this->lastVerifiedAt = $value;
        $this->_setField('lastVerifiedAt');
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
