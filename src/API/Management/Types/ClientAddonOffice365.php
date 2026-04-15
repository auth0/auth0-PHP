<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Microsoft Office 365 SSO configuration.
 */
class ClientAddonOffice365 extends JsonSerializableType
{
    /**
     * @var ?string $domain Your Office 365 domain name. e.g. `acme-org.com`.
     */
    #[JsonProperty('domain')]
    private ?string $domain;

    /**
     * @var ?string $connection Optional Auth0 database connection for testing an already-configured Office 365 tenant.
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @param array{
     *   domain?: ?string,
     *   connection?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->domain = $values['domain'] ?? null;
        $this->connection = $values['connection'] ?? null;
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
     * @return ?string
     */
    public function getConnection(): ?string
    {
        return $this->connection;
    }

    /**
     * @param ?string $value
     */
    public function setConnection(?string $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
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
