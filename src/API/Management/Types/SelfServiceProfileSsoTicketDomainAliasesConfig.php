<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * Configuration for the setup of the connection’s domain_aliases in the Self-Service Enterprise Configuration flow.
 */
class SelfServiceProfileSsoTicketDomainAliasesConfig extends JsonSerializableType
{
    /**
     * @var value-of<SelfServiceProfileSsoTicketDomainVerificationEnum> $domainVerification
     */
    #[JsonProperty('domain_verification')]
    private string $domainVerification;

    /**
     * @var ?array<string> $pendingDomains List of domains that will be submitted for verification during the Self-Service Enterprise Configuration flow.
     */
    #[JsonProperty('pending_domains'), ArrayType(['string'])]
    private ?array $pendingDomains;

    /**
     * @param array{
     *   domainVerification: value-of<SelfServiceProfileSsoTicketDomainVerificationEnum>,
     *   pendingDomains?: ?array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domainVerification = $values['domainVerification'];
        $this->pendingDomains = $values['pendingDomains'] ?? null;
    }

    /**
     * @return value-of<SelfServiceProfileSsoTicketDomainVerificationEnum>
     */
    public function getDomainVerification(): string
    {
        return $this->domainVerification;
    }

    /**
     * @param value-of<SelfServiceProfileSsoTicketDomainVerificationEnum> $value
     */
    public function setDomainVerification(string $value): self
    {
        $this->domainVerification = $value;
        $this->_setField('domainVerification');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getPendingDomains(): ?array
    {
        return $this->pendingDomains;
    }

    /**
     * @param ?array<string> $value
     */
    public function setPendingDomains(?array $value = null): self
    {
        $this->pendingDomains = $value;
        $this->_setField('pendingDomains');
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
