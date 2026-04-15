<?php

namespace Auth0\SDK\API\Management\Organizations\ClientGrants\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListOrganizationClientGrantsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $audience Optional filter on audience of the client grant.
     */
    private ?string $audience;

    /**
     * @var ?string $clientId Optional filter on client_id of the client grant.
     */
    private ?string $clientId;

    /**
     * @var ?array<?string> $grantIds Optional filter on the ID of the client grant. Must be URL encoded and may be specified multiple times (max 10).<br /><b>e.g.</b> <i>../client-grants?grant_ids=id1&grant_ids=id2</i>
     */
    private ?array $grantIds;

    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page. Defaults to 50.
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @param array{
     *   audience?: ?string,
     *   clientId?: ?string,
     *   grantIds?: ?array<?string>,
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->audience = $values['audience'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->grantIds = $values['grantIds'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
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
     * @return ?array<?string>
     */
    public function getGrantIds(): ?array
    {
        return $this->grantIds;
    }

    /**
     * @param ?array<?string> $value
     */
    public function setGrantIds(?array $value = null): self
    {
        $this->grantIds = $value;
        $this->_setField('grantIds');
        return $this;
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
}
