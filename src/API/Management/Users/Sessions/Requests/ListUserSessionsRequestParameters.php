<?php

namespace Auth0\SDK\API\Management\Users\Sessions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserSessionsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?bool $includeTotals Return results inside an object that contains the total result count (true) or as a direct array of results (false, default).
     */
    private ?bool $includeTotals = true;

    /**
     * @var ?string $from An optional cursor from which to start the selection (exclusive).
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @param array{
     *   includeTotals?: ?bool,
     *   from?: ?string,
     *   take?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->includeTotals = $values['includeTotals'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
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
}
