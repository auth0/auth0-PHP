<?php

namespace Auth0\SDK\API\Management\RefreshTokens\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetRefreshTokensRequestParameters extends JsonSerializableType
{
    /**
     * @var string $userId ID of the user whose refresh tokens to retrieve. Required.
     */
    private string $userId;

    /**
     * @var ?string $clientId Filter results by client ID. Only valid when user_id is provided.
     */
    private ?string $clientId;

    /**
     * @var ?string $from An opaque cursor from which to start the selection (exclusive). Expires after 24 hours. Obtained from the next property of a previous response.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @param array{
     *   userId: string,
     *   clientId?: ?string,
     *   from?: ?string,
     *   take?: ?int,
     *   fields?: ?string,
     *   includeFields?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->userId = $values['userId'];
        $this->clientId = $values['clientId'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $value
     */
    public function setUserId(string $value): self
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
     * @return ?string
     */
    public function getFrom(): ?string
    {
        return $this->from;
    }

    /**
     * @param ?string $value
     */
    public function setFrom(?string $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return ?int
     */
    public function getTake(): ?int
    {
        return $this->take;
    }

    /**
     * @param ?int $value
     */
    public function setTake(?int $value = null): self
    {
        $this->take = $value;
        $this->_setField('take');
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
}
