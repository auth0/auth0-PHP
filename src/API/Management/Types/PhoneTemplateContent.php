<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PhoneTemplateContent extends JsonSerializableType
{
    /**
     * @var ?string $syntax
     */
    #[JsonProperty('syntax')]
    private ?string $syntax;

    /**
     * @var ?string $from Default phone number to be used as 'from' when sending a phone notification
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var ?PhoneTemplateBody $body
     */
    #[JsonProperty('body')]
    private ?PhoneTemplateBody $body;

    /**
     * @param array{
     *   syntax?: ?string,
     *   from?: ?string,
     *   body?: ?PhoneTemplateBody,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->syntax = $values['syntax'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->body = $values['body'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getSyntax(): ?string
    {
        return $this->syntax;
    }

    /**
     * @param ?string $value
     */
    public function setSyntax(?string $value = null): self
    {
        $this->syntax = $value;
        $this->_setField('syntax');
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
     * @return ?PhoneTemplateBody
     */
    public function getBody(): ?PhoneTemplateBody
    {
        return $this->body;
    }

    /**
     * @param ?PhoneTemplateBody $value
     */
    public function setBody(?PhoneTemplateBody $value = null): self
    {
        $this->body = $value;
        $this->_setField('body');
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
