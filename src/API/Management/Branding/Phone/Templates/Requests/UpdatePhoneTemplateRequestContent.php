<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Templates\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PartialPhoneTemplateContent;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdatePhoneTemplateRequestContent extends JsonSerializableType
{
    /**
     * @var ?PartialPhoneTemplateContent $content
     */
    #[JsonProperty('content')]
    private ?PartialPhoneTemplateContent $content;

    /**
     * @var ?bool $disabled Whether the template is enabled (false) or disabled (true).
     */
    #[JsonProperty('disabled')]
    private ?bool $disabled;

    /**
     * @param array{
     *   content?: ?PartialPhoneTemplateContent,
     *   disabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->content = $values['content'] ?? null;
        $this->disabled = $values['disabled'] ?? null;
    }

    /**
     * @return ?PartialPhoneTemplateContent
     */
    public function getContent(): ?PartialPhoneTemplateContent
    {
        return $this->content;
    }

    /**
     * @param ?PartialPhoneTemplateContent $value
     */
    public function setContent(?PartialPhoneTemplateContent $value = null): self
    {
        $this->content = $value;
        $this->_setField('content');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param ?bool $value
     */
    public function setDisabled(?bool $value = null): self
    {
        $this->disabled = $value;
        $this->_setField('disabled');
        return $this;
    }
}
