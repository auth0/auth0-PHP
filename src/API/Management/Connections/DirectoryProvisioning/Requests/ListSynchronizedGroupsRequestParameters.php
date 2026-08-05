<?php

namespace Auth0\SDK\API\Management\Connections\DirectoryProvisioning\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListSynchronizedGroupsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $q Query in <a target='_new' href ='https://lucene.apache.org/core/2_9_4/queryparsersyntax.html'>Lucene query string syntax</a>. Only prefix search on "name" or "email" fields are allowed, with a single wildcard suffix. Operators, modifiers, and groupings are not allowed. Terms are treated as case-insensitive. Example query: "name:engineering*".
     */
    private ?string $q;

    /**
     * @param array{
     *   from?: ?string,
     *   take?: ?int,
     *   q?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->q = $values['q'] ?? null;
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
