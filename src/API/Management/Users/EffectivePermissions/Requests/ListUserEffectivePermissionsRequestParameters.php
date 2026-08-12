<?php

namespace Auth0\SDK\API\Management\Users\EffectivePermissions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserEffectivePermissionsRequestParameters extends JsonSerializableType
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
     * @var string $resourceServerIdentifier The identifier of the resource server for which to calculate user permissions.
     */
    private string $resourceServerIdentifier;

    /**
     * @param array{
     *   resourceServerIdentifier: string,
     *   from?: ?string,
     *   take?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
        $this->resourceServerIdentifier = $values['resourceServerIdentifier'];
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
     * @return string
     */
    public function getResourceServerIdentifier(): string
    {
        return $this->resourceServerIdentifier;
    }

    /**
     * @param string $value
     */
    public function setResourceServerIdentifier(string $value): self
    {
        $this->resourceServerIdentifier = $value;
        $this->_setField('resourceServerIdentifier');
        return $this;
    }
}
