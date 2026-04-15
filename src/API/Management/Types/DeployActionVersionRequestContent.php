<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class DeployActionVersionRequestContent extends JsonSerializableType
{
    /**
     * @var ?bool $updateDraft True if the draft of the action should be updated with the reverted version.
     */
    #[JsonProperty('update_draft')]
    private ?bool $updateDraft;

    /**
     * @param array{
     *   updateDraft?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->updateDraft = $values['updateDraft'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getUpdateDraft(): ?bool
    {
        return $this->updateDraft;
    }

    /**
     * @param ?bool $value
     */
    public function setUpdateDraft(?bool $value = null): self
    {
        $this->updateDraft = $value;
        $this->_setField('updateDraft');
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
