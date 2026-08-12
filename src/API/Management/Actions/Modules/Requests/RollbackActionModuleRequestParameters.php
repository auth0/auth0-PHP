<?php

namespace Auth0\SDK\API\Management\Actions\Modules\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class RollbackActionModuleRequestParameters extends JsonSerializableType
{
    /**
     * @var string $moduleVersionId The unique ID of the module version to roll back to.
     */
    #[JsonProperty('module_version_id')]
    private string $moduleVersionId;

    /**
     * @param array{
     *   moduleVersionId: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->moduleVersionId = $values['moduleVersionId'];
    }

    /**
     * @return string
     */
    public function getModuleVersionId(): string
    {
        return $this->moduleVersionId;
    }

    /**
     * @param string $value
     */
    public function setModuleVersionId(string $value): self
    {
        $this->moduleVersionId = $value;
        $this->_setField('moduleVersionId');
        return $this;
    }
}
