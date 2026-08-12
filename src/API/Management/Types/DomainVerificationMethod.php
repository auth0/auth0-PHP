<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class DomainVerificationMethod extends JsonSerializableType
{
    /**
     * @var value-of<DomainVerificationMethodNameEnum> $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $record Value used to verify the domain.
     */
    #[JsonProperty('record')]
    private string $record;

    /**
     * @var ?string $domain The name of the txt record for verification
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @param array{
     *   name: value-of<DomainVerificationMethodNameEnum>,
     *   record: string,
     *   domain?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->record = $values['record'];
        $this->domain = $values['domain'] ?? null;
    }

    /**
     * @return value-of<DomainVerificationMethodNameEnum>
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param value-of<DomainVerificationMethodNameEnum> $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return string
     */
    public function getRecord(): string
    {
        return $this->record;
    }

    /**
     * @param string $value
     */
    public function setRecord(string $value): self
    {
        $this->record = $value;
        $this->_setField('record');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param ?string $value
     */
    public function setDomain(?string $value = null): self
    {
        $this->domain = $value;
        $this->_setField('domain');
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
