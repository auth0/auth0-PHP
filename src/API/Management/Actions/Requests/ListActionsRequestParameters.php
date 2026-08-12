<?php

namespace Auth0\SDK\API\Management\Actions\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\ActionTriggerTypeEnum;

class ListActionsRequestParameters extends JsonSerializableType
{
    /**
     * @var ?value-of<ActionTriggerTypeEnum> $triggerId An actions extensibility point.
     */
    private ?string $triggerId;

    /**
     * @var ?string $actionName The name of the action to retrieve.
     */
    private ?string $actionName;

    /**
     * @var ?bool $deployed Optional filter to only retrieve actions that are deployed.
     */
    private ?bool $deployed;

    /**
     * @var ?int $page Use this field to request a specific page of the list results.
     */
    private ?int $page = 0;

    /**
     * @var ?int $perPage The maximum number of results to be returned by the server in single response. 20 by default
     */
    private ?int $perPage = 50;

    /**
     * @var ?bool $installed Optional. When true, return only installed actions. When false, return only custom actions. Returns all actions by default.
     */
    private ?bool $installed;

    /**
     * @param array{
     *   triggerId?: ?value-of<ActionTriggerTypeEnum>,
     *   actionName?: ?string,
     *   deployed?: ?bool,
     *   page?: ?int,
     *   perPage?: ?int,
     *   installed?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->triggerId = $values['triggerId'] ?? null;
        $this->actionName = $values['actionName'] ?? null;
        $this->deployed = $values['deployed'] ?? null;
        $this->page = $values['page'] ?? null;
        $this->perPage = $values['perPage'] ?? null;
        $this->installed = $values['installed'] ?? null;
    }

    /**
     * @return ?value-of<ActionTriggerTypeEnum>
     */
    public function getTriggerId(): ?string
    {
        return $this->triggerId;
    }

    /**
     * @param ?value-of<ActionTriggerTypeEnum> $value
     */
    public function setTriggerId(?string $value = null): self
    {
        $this->triggerId = $value;
        $this->_setField('triggerId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getActionName(): ?string
    {
        return $this->actionName;
    }

    /**
     * @param ?string $value
     */
    public function setActionName(?string $value = null): self
    {
        $this->actionName = $value;
        $this->_setField('actionName');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDeployed(): ?bool
    {
        return $this->deployed;
    }

    /**
     * @param ?bool $value
     */
    public function setDeployed(?bool $value = null): self
    {
        $this->deployed = $value;
        $this->_setField('deployed');
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
    public function getInstalled(): ?bool
    {
        return $this->installed;
    }

    /**
     * @param ?bool $value
     */
    public function setInstalled(?bool $value = null): self
    {
        $this->installed = $value;
        $this->_setField('installed');
        return $this;
    }
}
