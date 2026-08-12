<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * Email template configuration
 */
class ConnectionEmailEmail extends JsonSerializableType
{
    /**
     * @var ?string $body
     */
    #[JsonProperty('body')]
    private ?string $body;

    /**
     * @var ?string $from
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var ?string $subject
     */
    #[JsonProperty('subject')]
    private ?string $subject;

    /**
     * @var ?value-of<ConnectionEmailEmailSyntax> $syntax Email template syntax type
     */
    #[JsonProperty('syntax')]
    private ?string $syntax;

    /**
     * @param array{
     *   body?: ?string,
     *   from?: ?string,
     *   subject?: ?string,
     *   syntax?: ?value-of<ConnectionEmailEmailSyntax>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->body = $values['body'] ?? null;
        $this->from = $values['from'] ?? null;
        $this->subject = $values['subject'] ?? null;
        $this->syntax = $values['syntax'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param ?string $value
     */
    public function setBody(?string $value = null): self
    {
        $this->body = $value;
        $this->_setField('body');
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
     * @return ?string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param ?string $value
     */
    public function setSubject(?string $value = null): self
    {
        $this->subject = $value;
        $this->_setField('subject');
        return $this;
    }

    /**
     * @return ?value-of<ConnectionEmailEmailSyntax>
     */
    public function getSyntax(): ?string
    {
        return $this->syntax;
    }

    /**
     * @param ?value-of<ConnectionEmailEmailSyntax> $value
     */
    public function setSyntax(?string $value = null): self
    {
        $this->syntax = $value;
        $this->_setField('syntax');
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
