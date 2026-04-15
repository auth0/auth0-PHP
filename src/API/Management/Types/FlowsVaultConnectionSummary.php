<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class FlowsVaultConnectionSummary extends JsonSerializableType
{
    /**
     * @var string $id Flows Vault Connection identifier.
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var string $appId Flows Vault Connection app identifier.
     */
    #[JsonProperty('app_id')]
    private string $appId;

    /**
     * @var string $name Flows Vault Connection name.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?string $accountName Flows Vault Connection custom account name.
     */
    #[JsonProperty('account_name')]
    private ?string $accountName;

    /**
     * @var bool $ready Whether the Flows Vault Connection is configured.
     */
    #[JsonProperty('ready')]
    private bool $ready;

    /**
     * @var DateTime $createdAt The ISO 8601 formatted date when this Flows Vault Connection was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $createdAt;

    /**
     * @var DateTime $updatedAt The ISO 8601 formatted date when this Flows Vault Connection was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private DateTime $updatedAt;

    /**
     * @var ?DateTime $refreshedAt The ISO 8601 formatted date when this Flows Vault Connection was refreshed.
     */
    #[JsonProperty('refreshed_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $refreshedAt;

    /**
     * @var string $fingerprint
     */
    #[JsonProperty('fingerprint')]
    private string $fingerprint;

    /**
     * @param array{
     *   id: string,
     *   appId: string,
     *   name: string,
     *   ready: bool,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   fingerprint: string,
     *   accountName?: ?string,
     *   refreshedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->appId = $values['appId'];
        $this->name = $values['name'];
        $this->accountName = $values['accountName'] ?? null;
        $this->ready = $values['ready'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->refreshedAt = $values['refreshedAt'] ?? null;
        $this->fingerprint = $values['fingerprint'];
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
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @param string $value
     */
    public function setAppId(string $value): self
    {
        $this->appId = $value;
        $this->_setField('appId');
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * @param ?string $value
     */
    public function setAccountName(?string $value = null): self
    {
        $this->accountName = $value;
        $this->_setField('accountName');
        return $this;
    }

    /**
     * @return bool
     */
    public function getReady(): bool
    {
        return $this->ready;
    }

    /**
     * @param bool $value
     */
    public function setReady(bool $value): self
    {
        $this->ready = $value;
        $this->_setField('ready');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $value
     */
    public function setCreatedAt(DateTime $value): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $value
     */
    public function setUpdatedAt(DateTime $value): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getRefreshedAt(): ?DateTime
    {
        return $this->refreshedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setRefreshedAt(?DateTime $value = null): self
    {
        $this->refreshedAt = $value;
        $this->_setField('refreshedAt');
        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $value
     */
    public function setFingerprint(string $value): self
    {
        $this->fingerprint = $value;
        $this->_setField('fingerprint');
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
