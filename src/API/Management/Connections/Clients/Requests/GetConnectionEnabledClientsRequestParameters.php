<?php

namespace Auth0\SDK\API\Management\Connections\Clients\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class GetConnectionEnabledClientsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @param array{
     *   take?: ?int,
     *   from?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->take = $values['take'] ?? null;
        $this->from = $values['from'] ?? null;
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
}
