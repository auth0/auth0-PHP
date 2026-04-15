<?php

namespace Auth0\SDK\API\Management\DeviceCredentials\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\DeviceCredentialTypeEnum;

class ListDeviceCredentialsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page.  There is a maximum of 1000 results allowed from this endpoint.
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?string $userId user_id of the devices to retrieve.
     */
    private ?string $userId;

    /**
     * @var ?string $clientId client_id of the devices to retrieve.
     */
    private ?string $clientId;

    /**
     * @var ?value-of<DeviceCredentialTypeEnum> $type Type of credentials to retrieve. Must be `public_key`, `refresh_token` or `rotating_refresh_token`. The property will default to `refresh_token` when paging is requested
     */
    private ?string $type;

    /**
     * @param array{
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   userId?: ?string,
     *   clientId?: ?string,
     *   type?: ?value-of<DeviceCredentialTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->userId = $values['userId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return ?int
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    /**
     * @param ?int $value
     */
    public function setPage(?int $value = null): self
    {
        $this->page = $value;
        $this->_setField('page');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getPerPage(): ?int
    {
        return $this->perPage;
    }

    /**
     * @param ?int $value
     */
    public function setPerPage(?int $value = null): self
    {
        $this->perPage = $value;
        $this->_setField('perPage');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeTotals(): ?bool
    {
        return $this->includeTotals;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeTotals(?bool $value = null): self
    {
        $this->includeTotals = $value;
        $this->_setField('includeTotals');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getFields(): ?string
    {
        return $this->fields;
    }

    /**
     * @param ?string $value
     */
    public function setFields(?string $value = null): self
    {
        $this->fields = $value;
        $this->_setField('fields');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIncludeFields(): ?bool
    {
        return $this->includeFields;
    }

    /**
     * @param ?bool $value
     */
    public function setIncludeFields(?bool $value = null): self
    {
        $this->includeFields = $value;
        $this->_setField('includeFields');
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
     * @return ?value-of<DeviceCredentialTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<DeviceCredentialTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }
}
