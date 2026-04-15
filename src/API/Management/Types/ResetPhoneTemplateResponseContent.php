<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ResetPhoneTemplateResponseContent extends JsonSerializableType
{
    /**
     * @var string $id
     */
    #[JsonProperty('id')]
    private string $id;

    /**
     * @var ?string $channel
     */
    #[JsonProperty('channel')]
    private ?string $channel;

    /**
     * @var ?bool $customizable
     */
    #[JsonProperty('customizable')]
    private ?bool $customizable;

    /**
     * @var ?string $tenant
     */
    #[JsonProperty('tenant')]
    private ?string $tenant;

    /**
     * @var PhoneTemplateContent $content
     */
    #[JsonProperty('content')]
    private PhoneTemplateContent $content;

    /**
     * @var value-of<PhoneTemplateNotificationTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @var bool $disabled Whether the template is enabled (false) or disabled (true).
     */
    #[JsonProperty('disabled')]
    private bool $disabled;

    /**
     * @param array{
     *   id: string,
     *   content: PhoneTemplateContent,
     *   type: value-of<PhoneTemplateNotificationTypeEnum>,
     *   disabled: bool,
     *   channel?: ?string,
     *   customizable?: ?bool,
     *   tenant?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->channel = $values['channel'] ?? null;
        $this->customizable = $values['customizable'] ?? null;
        $this->tenant = $values['tenant'] ?? null;
        $this->content = $values['content'];
        $this->type = $values['type'];
        $this->disabled = $values['disabled'];
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     */
    public function setId(string $value): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getChannel(): ?string
    {
        return $this->channel;
    }

    /**
     * @param ?string $value
     */
    public function setChannel(?string $value = null): self
    {
        $this->channel = $value;
        $this->_setField('channel');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getCustomizable(): ?bool
    {
        return $this->customizable;
    }

    /**
     * @param ?bool $value
     */
    public function setCustomizable(?bool $value = null): self
    {
        $this->customizable = $value;
        $this->_setField('customizable');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param ?string $value
     */
    public function setTenant(?string $value = null): self
    {
        $this->tenant = $value;
        $this->_setField('tenant');
        return $this;
    }

    /**
     * @return PhoneTemplateContent
     */
    public function getContent(): PhoneTemplateContent
    {
        return $this->content;
    }

    /**
     * @param PhoneTemplateContent $value
     */
    public function setContent(PhoneTemplateContent $value): self
    {
        $this->content = $value;
        $this->_setField('content');
        return $this;
    }

    /**
     * @return value-of<PhoneTemplateNotificationTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<PhoneTemplateNotificationTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return bool
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $value
     */
    public function setDisabled(bool $value): self
    {
        $this->disabled = $value;
        $this->_setField('disabled');
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
