<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;

/**
 * Attribute conditions that must not match.
 */
class SegmentNotMatchConditions extends JsonSerializableType
{
    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $clientId
     */
    #[JsonProperty('client_id'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $clientId;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $connection
     */
    #[JsonProperty('connection'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $connection;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $connectionType
     */
    #[JsonProperty('connection_type'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $connectionType;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $organizationId
     */
    #[JsonProperty('organization_id'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $organizationId;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $domain
     */
    #[JsonProperty('domain'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $domain;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $deviceType
     */
    #[JsonProperty('device_type'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $deviceType;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $browser
     */
    #[JsonProperty('browser'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $browser;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $platform
     */
    #[JsonProperty('platform'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $platform;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $userAgent
     */
    #[JsonProperty('user_agent'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $userAgent;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $country
     */
    #[JsonProperty('country'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $country;

    /**
     * @var (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $region
     */
    #[JsonProperty('region'), Union(['string'], SegmentContainsExpression::class, SegmentStartsWithExpression::class, SegmentEndsWithExpression::class, SegmentExistsExpression::class, 'null')]
    private array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $region;

    /**
     * @param array{
     *   clientId?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   connection?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   connectionType?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   organizationId?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   domain?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   deviceType?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   browser?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   platform?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   userAgent?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   country?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     *   region?: (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->clientId = $values['clientId'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->connectionType = $values['connectionType'] ?? null;
        $this->organizationId = $values['organizationId'] ?? null;
        $this->domain = $values['domain'] ?? null;
        $this->deviceType = $values['deviceType'] ?? null;
        $this->browser = $values['browser'] ?? null;
        $this->platform = $values['platform'] ?? null;
        $this->userAgent = $values['userAgent'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->region = $values['region'] ?? null;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getClientId(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->clientId;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setClientId(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getConnection(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->connection;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setConnection(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->connection = $value;
        $this->_setField('connection');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getConnectionType(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->connectionType;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setConnectionType(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->connectionType = $value;
        $this->_setField('connectionType');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getOrganizationId(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->organizationId;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setOrganizationId(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->organizationId = $value;
        $this->_setField('organizationId');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getDomain(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->domain;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setDomain(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->domain = $value;
        $this->_setField('domain');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getDeviceType(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->deviceType;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setDeviceType(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->deviceType = $value;
        $this->_setField('deviceType');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getBrowser(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->browser;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setBrowser(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->browser = $value;
        $this->_setField('browser');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getPlatform(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->platform;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setPlatform(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->platform = $value;
        $this->_setField('platform');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getUserAgent(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->userAgent;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setUserAgent(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->userAgent = $value;
        $this->_setField('userAgent');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getCountry(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->country;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setCountry(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->country = $value;
        $this->_setField('country');
        return $this;
    }

    /**
     * @return (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null
     */
    public function getRegion(): array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null
    {
        return $this->region;
    }

    /**
     * @param (
     *    array<string>
     *   |SegmentContainsExpression
     *   |SegmentStartsWithExpression
     *   |SegmentEndsWithExpression
     *   |SegmentExistsExpression
     * )|null $value
     */
    public function setRegion(array|SegmentContainsExpression|SegmentStartsWithExpression|SegmentEndsWithExpression|SegmentExistsExpression|null $value = null): self
    {
        $this->region = $value;
        $this->_setField('region');
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
