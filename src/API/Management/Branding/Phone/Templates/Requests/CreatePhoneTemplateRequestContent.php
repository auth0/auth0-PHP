<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Templates\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Types\PhoneTemplateNotificationTypeEnum;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\PhoneTemplateContent;

class CreatePhoneTemplateRequestContent extends JsonSerializableType
{
    /**
     * @var ?value-of<PhoneTemplateNotificationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?bool $disabled Whether the template is enabled (false) or disabled (true).
     */
    #[JsonProperty('disabled')]
    private ?bool $disabled;

    /**
     * @var ?PhoneTemplateContent $content
     */
    #[JsonProperty('content')]
    private ?PhoneTemplateContent $content;

    /**
     * @param array{
     *   type?: ?value-of<PhoneTemplateNotificationTypeEnum>,
     *   disabled?: ?bool,
     *   content?: ?PhoneTemplateContent,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->disabled = $values['disabled'] ?? null;
        $this->content = $values['content'] ?? null;
    }

    /**
     * @return ?value-of<PhoneTemplateNotificationTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<PhoneTemplateNotificationTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
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

    /**
     * @return ?PhoneTemplateContent
     */
    public function getContent(): ?PhoneTemplateContent
    {
        return $this->content;
    }

    /**
     * @param ?PhoneTemplateContent $value
     */
    public function setContent(?PhoneTemplateContent $value = null): self
    {
        $this->content = $value;
        $this->_setField('content');
        return $this;
    }
}
