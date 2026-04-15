<?php

namespace Auth0\SDK\API\Management\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListClientsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $fields Comma-separated list of fields to include or exclude (based on value provided for include_fields) in the result. Leave empty to retrieve all fields.
     */
    private ?string $fields;

    /**
     * @var ?bool $includeFields Whether specified fields are to be included (true) or excluded (false).
     */
    private ?bool $includeFields;

    /**
     * @var ?int $page Page index of the results to return. First page is 0.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage Number of results per page. Default value is 50, maximum value is 100
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?bool $isGlobal Optional filter on the global client parameter.
     */
    private ?bool $isGlobal;

    /**
     * @var ?bool $isFirstParty Optional filter on whether or not a client is a first-party client.
     */
    private ?bool $isFirstParty;

    /**
     * @var ?string $appType Optional filter by a comma-separated list of application types.
     */
    private ?string $appType;

    /**
     * @var ?string $externalClientId Optional filter by the <a href="https://www.ietf.org/archive/id/draft-ietf-oauth-client-id-metadata-document-04.html">Client ID Metadata Document</a> URI for CIMD-registered clients.
     */
    private ?string $externalClientId;

    /**
     * @var ?string $q Advanced Query in <a href="https://lucene.apache.org/core/2_9_4/queryparsersyntax.html">Lucene</a> syntax.<br /><b>Permitted Queries</b>:<br /><ul><li><i>client_grant.organization_id:{organization_id}</i></li><li><i>client_grant.allow_any_organization:true</i></li></ul><b>Additional Restrictions</b>:<br /><ul><li>Cannot be used in combination with other filters</li><li>Requires use of the <i>from</i> and <i>take</i> paging parameters (checkpoint paginatinon)</li><li>Reduced rate limits apply. See <a href="https://auth0.com/docs/troubleshoot/customer-support/operational-policies/rate-limit-policy/rate-limit-configurations/enterprise-public">Rate Limit Configurations</a></li></ul><i><b>Note</b>: Recent updates may not be immediately reflected in query results</i>
     */
    private ?string $q;

    /**
     * @param array{
     *   fields?: ?string,
     *   includeFields?: ?bool,
     *   page?: ?int,
     *   perPage?: ?int,
     *   includeTotals?: ?bool,
     *   isGlobal?: ?bool,
     *   isFirstParty?: ?bool,
     *   appType?: ?string,
     *   externalClientId?: ?string,
     *   q?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->fields = $values['fields'] ?? null;
        $this->includeFields = $values['includeFields'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->isGlobal = $values['isGlobal'] ?? null;
        $this->isFirstParty = $values['isFirstParty'] ?? null;
        $this->appType = $values['appType'] ?? null;
        $this->externalClientId = $values['externalClientId'] ?? null;
        $this->q = $values['q'] ?? null;
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
     * @return ?bool
     */
    public function getIsGlobal(): ?bool
    {
        return $this->isGlobal;
    }

    /**
     * @param ?bool $value
     */
    public function setIsGlobal(?bool $value = null): self
    {
        $this->isGlobal = $value;
        $this->_setField('isGlobal');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getIsFirstParty(): ?bool
    {
        return $this->isFirstParty;
    }

    /**
     * @param ?bool $value
     */
    public function setIsFirstParty(?bool $value = null): self
    {
        $this->isFirstParty = $value;
        $this->_setField('isFirstParty');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getAppType(): ?string
    {
        return $this->appType;
    }

    /**
     * @param ?string $value
     */
    public function setAppType(?string $value = null): self
    {
        $this->appType = $value;
        $this->_setField('appType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getExternalClientId(): ?string
    {
        return $this->externalClientId;
    }

    /**
     * @param ?string $value
     */
    public function setExternalClientId(?string $value = null): self
    {
        $this->externalClientId = $value;
        $this->_setField('externalClientId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getQ(): ?string
    {
        return $this->q;
    }

    /**
     * @param ?string $value
     */
    public function setQ(?string $value = null): self
    {
        $this->q = $value;
        $this->_setField('q');
        return $this;
    }
}
