<?php

namespace Auth0\SDK\API\Management\Users\EffectiveRoles\Sources\Groups\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListUserRoleSourceGroupsRequestParameters extends JsonSerializableType
{
    /**
     * @var string $roleId ID of the role to get source groups for.
     */
    private string $roleId;

    /**
     * @var ?string $from Optional Id from which to start selection.
     */
    private ?string $from;

    /**
     * @var ?int $take Number of results per page. Defaults to 50.
     */
    private ?int $take = 50;

    /**
     * @param array{
     *   roleId: string,
     *   from?: ?string,
     *   take?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->roleId = $values['roleId'];
        $this->from = $values['from'] ?? null;
        $this->take = $values['take'] ?? null;
    }

    /**
     * @return string
     */
    public function getRoleId(): string
    {
        return $this->roleId;
    }

    /**
     * @param string $value
     */
    public function setRoleId(string $value): self
    {
        $this->roleId = $value;
        $this->_setField('roleId');
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
