<?php

namespace Auth0\SDK\API\Management\Stats\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetDailyStatsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?string $from Optional first day of the date range (inclusive) in YYYYMMDD format.
     */
    private ?string $from;

    /**
     * @var ?string $to Optional last day of the date range (inclusive) in YYYYMMDD format.
     */
    private ?string $to;

    /**
     * @param array{
     *   from?: ?string,
     *   to?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->from = $values['from'] ?? null;
        $this->to = $values['to'] ?? null;
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
     * @return ?string
     */
    public function getTo(): ?string
    {
        return $this->to;
    }

    /**
     * @param ?string $value
     */
    public function setTo(?string $value = null): self
    {
        $this->to = $value;
        $this->_setField('to');
        return $this;
    }
}
