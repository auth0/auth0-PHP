<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class Log extends JsonSerializableType
{
    /**
     * @var (
     *    string
     *   |array<string, mixed>
     * )|null $date
     */
    #[JsonProperty('date'), Union('string', ['string' => 'mixed'], 'null')]
    private string|array|null $date;

    /**
     * @var ?string $type Type of event.
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?string $description Description of this event.
     */
    #[JsonProperty('description')]
    private ?string $description;

    /**
     * @var ?string $connection Name of the connection the event relates to.
     */
    #[JsonProperty('connection')]
    private ?string $connection;

    /**
     * @var ?string $connectionId ID of the connection the event relates to.
     */
    #[JsonProperty('connection_id')]
    private ?string $connectionId;

    /**
     * @var ?string $clientId ID of the client (application).
     */
    #[JsonProperty('client_id')]
    private ?string $clientId;

    /**
     * @var ?string $clientName Name of the client (application).
     */
    #[JsonProperty('client_name')]
    private ?string $clientName;

    /**
     * @var ?string $ip IP address of the log event source.
     */
    #[JsonProperty('ip')]
    private ?string $ip;

    /**
     * @var ?string $hostname Hostname the event applies to.
     */
    #[JsonProperty('hostname')]
    private ?string $hostname;

    /**
     * @var ?string $userId ID of the user involved in the event.
     */
    #[JsonProperty('user_id')]
    private ?string $userId;

    /**
     * @var ?string $userName Name of the user involved in the event.
     */
    #[JsonProperty('user_name')]
    private ?string $userName;

    /**
     * @var ?string $audience API audience the event applies to.
     */
    #[JsonProperty('audience')]
    private ?string $audience;

    /**
     * @var ?string $scope Scope permissions applied to the event.
     */
    #[JsonProperty('scope')]
    private ?string $scope;

    /**
     * @var ?string $strategy Name of the strategy involved in the event.
     */
    #[JsonProperty('strategy')]
    private ?string $strategy;

    /**
     * @var ?string $strategyType Type of strategy involved in the event.
     */
    #[JsonProperty('strategy_type')]
    private ?string $strategyType;

    /**
     * @var ?string $logId Unique ID of the event.
     */
    #[JsonProperty('log_id')]
    private ?string $logId;

    /**
     * @var ?bool $isMobile Whether the client was a mobile device (true) or desktop/laptop/server (false).
     */
    #[JsonProperty('isMobile')]
    private ?bool $isMobile;

    /**
     * @var ?array<string, mixed> $details
     */
    #[JsonProperty('details'), ArrayType(['string' => 'mixed'])]
    private ?array $details;

    /**
     * @var ?string $userAgent User agent string from the client device that caused the event.
     */
    #[JsonProperty('user_agent')]
    private ?string $userAgent;

    /**
     * @var ?LogSecurityContext $securityContext
     */
    #[JsonProperty('security_context')]
    private ?LogSecurityContext $securityContext;

    /**
     * @var ?LogLocationInfo $locationInfo
     */
    #[JsonProperty('location_info')]
    private ?LogLocationInfo $locationInfo;

    /**
     * @param array{
     *   date?: (
     *    string
     *   |array<string, mixed>
     * )|null,
     *   type?: ?string,
     *   description?: ?string,
     *   connection?: ?string,
     *   connectionId?: ?string,
     *   clientId?: ?string,
     *   clientName?: ?string,
     *   ip?: ?string,
     *   hostname?: ?string,
     *   userId?: ?string,
     *   userName?: ?string,
     *   audience?: ?string,
     *   scope?: ?string,
     *   strategy?: ?string,
     *   strategyType?: ?string,
     *   logId?: ?string,
     *   isMobile?: ?bool,
     *   details?: ?array<string, mixed>,
     *   userAgent?: ?string,
     *   securityContext?: ?LogSecurityContext,
     *   locationInfo?: ?LogLocationInfo,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->date = $values['date'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->connection = $values['connection'] ?? null;
        $this->connectionId = $values['connectionId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->clientName = $values['clientName'] ?? null;
        $this->ip = $values['ip'] ?? null;
        $this->hostname = $values['hostname'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->userName = $values['userName'] ?? null;
        $this->audience = $values['audience'] ?? null;
        $this->scope = $values['scope'] ?? null;
        $this->strategy = $values['strategy'] ?? null;
        $this->strategyType = $values['strategyType'] ?? null;
        $this->logId = $values['logId'] ?? null;
        $this->isMobile = $values['isMobile'] ?? null;
        $this->details = $values['details'] ?? null;
        $this->userAgent = $values['userAgent'] ?? null;
        $this->securityContext = $values['securityContext'] ?? null;
        $this->locationInfo = $values['locationInfo'] ?? null;
    }

    /**
     * @return (
     *    string
     *   |array<string, mixed>
     * )|null
     */
    public function getDate(): string|array|null
    {
        return $this->date;
    }

    /**
     * @param (
     *    string
     *   |array<string, mixed>
     * )|null $value
     */
    public function setDate(string|array|null $value = null): self
    {
        $this->date = $value;
        $this->_setField('date');
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $value
     */
    public function setDescription(?string $value = null): self
    {
        $this->description = $value;
        $this->_setField('description');
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
     * @return ?string
     */
    public function getConnectionId(): ?string
    {
        return $this->connectionId;
    }

    /**
     * @param ?string $value
     */
    public function setConnectionId(?string $value = null): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    /**
     * @param ?string $value
     */
    public function setClientId(?string $value = null): self
    {
        $this->clientId = $value;
        $this->_setField('clientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getClientName(): ?string
    {
        return $this->clientName;
    }

    /**
     * @param ?string $value
     */
    public function setClientName(?string $value = null): self
    {
        $this->clientName = $value;
        $this->_setField('clientName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @param ?string $value
     */
    public function setIp(?string $value = null): self
    {
        $this->ip = $value;
        $this->_setField('ip');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    /**
     * @param ?string $value
     */
    public function setHostname(?string $value = null): self
    {
        $this->hostname = $value;
        $this->_setField('hostname');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param ?string $value
     */
    public function setUserId(?string $value = null): self
    {
        $this->userId = $value;
        $this->_setField('userId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param ?string $value
     */
    public function setUserName(?string $value = null): self
    {
        $this->userName = $value;
        $this->_setField('userName');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAudience(): ?string
    {
        return $this->audience;
    }

    /**
     * @param ?string $value
     */
    public function setAudience(?string $value = null): self
    {
        $this->audience = $value;
        $this->_setField('audience');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getScope(): ?string
    {
        return $this->scope;
    }

    /**
     * @param ?string $value
     */
    public function setScope(?string $value = null): self
    {
        $this->scope = $value;
        $this->_setField('scope');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    /**
     * @param ?string $value
     */
    public function setStrategy(?string $value = null): self
    {
        $this->strategy = $value;
        $this->_setField('strategy');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getStrategyType(): ?string
    {
        return $this->strategyType;
    }

    /**
     * @param ?string $value
     */
    public function setStrategyType(?string $value = null): self
    {
        $this->strategyType = $value;
        $this->_setField('strategyType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLogId(): ?string
    {
        return $this->logId;
    }

    /**
     * @param ?string $value
     */
    public function setLogId(?string $value = null): self
    {
        $this->logId = $value;
        $this->_setField('logId');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsMobile(): ?bool
    {
        return $this->isMobile;
    }

    /**
     * @param ?bool $value
     */
    public function setIsMobile(?bool $value = null): self
    {
        $this->isMobile = $value;
        $this->_setField('isMobile');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getDetails(): ?array
    {
        return $this->details;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setDetails(?array $value = null): self
    {
        $this->details = $value;
        $this->_setField('details');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getUserAgent(): ?string
    {
        return $this->userAgent;
    }

    /**
     * @param ?string $value
     */
    public function setUserAgent(?string $value = null): self
    {
        $this->userAgent = $value;
        $this->_setField('userAgent');
        return $this;
    }

    /**
     * @return ?LogSecurityContext
     */
    public function getSecurityContext(): ?LogSecurityContext
    {
        return $this->securityContext;
    }

    /**
     * @param ?LogSecurityContext $value
     */
    public function setSecurityContext(?LogSecurityContext $value = null): self
    {
        $this->securityContext = $value;
        $this->_setField('securityContext');
        return $this;
    }

    /**
     * @return ?LogLocationInfo
     */
    public function getLocationInfo(): ?LogLocationInfo
    {
        return $this->locationInfo;
    }

    /**
     * @param ?LogLocationInfo $value
     */
    public function setLocationInfo(?LogLocationInfo $value = null): self
    {
        $this->locationInfo = $value;
        $this->_setField('locationInfo');
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
