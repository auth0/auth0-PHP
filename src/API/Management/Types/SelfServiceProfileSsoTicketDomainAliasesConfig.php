<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Configuration for the setup of the connection’s domain_aliases in the self-service SSO flow.
 */
class SelfServiceProfileSsoTicketDomainAliasesConfig extends JsonSerializableType
{
    /**
     * @var value-of<SelfServiceProfileSsoTicketDomainVerificationEnum> $domainVerification
     */
    #[JsonProperty('domain_verification')]
    private string $domainVerification;

    /**
     * @param array{
     *   domainVerification: value-of<SelfServiceProfileSsoTicketDomainVerificationEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->domainVerification = $values['domainVerification'];
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
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
