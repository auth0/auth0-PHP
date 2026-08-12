<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionAuth0SendEmailParams extends JsonSerializableType
{
    /**
     * @var ?FlowActionAuth0SendEmailParamsFrom $from
     */
    #[JsonProperty('from')]
    private ?FlowActionAuth0SendEmailParamsFrom $from;

    /**
     * @var string $to
     */
    #[JsonProperty('to')]
    private string $to;

    /**
     * @var string $subject
     */
    #[JsonProperty('subject')]
    private string $subject;

    /**
     * @var string $body
     */
    #[JsonProperty('body')]
    private string $body;

    /**
     * @var ?array<string, mixed> $customVars
     */
    #[JsonProperty('custom_vars'), ArrayType(['string' => 'mixed'])]
    private ?array $customVars;

    /**
     * @param array{
     *   to: string,
     *   subject: string,
     *   body: string,
     *   from?: ?FlowActionAuth0SendEmailParamsFrom,
     *   customVars?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->from = $values['from'] ?? null;
        $this->to = $values['to'];
        $this->subject = $values['subject'];
        $this->body = $values['body'];
        $this->customVars = $values['customVars'] ?? null;
    }

    /**
     * @return ?FlowActionAuth0SendEmailParamsFrom
     */
    public function getFrom(): ?FlowActionAuth0SendEmailParamsFrom
    {
        return $this->from;
    }

    /**
     * @param ?FlowActionAuth0SendEmailParamsFrom $value
     */
    public function setFrom(?FlowActionAuth0SendEmailParamsFrom $value = null): self
    {
        $this->from = $value;
        $this->_setField('from');
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @param string $value
     */
    public function setTo(string $value): self
    {
        $this->to = $value;
        $this->_setField('to');
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $value
     */
    public function setSubject(string $value): self
    {
        $this->subject = $value;
        $this->_setField('subject');
        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $value
     */
    public function setBody(string $value): self
    {
        $this->body = $value;
        $this->_setField('body');
        return $this;
    }

    /**
     * @return ?array<string, mixed>
     */
    public function getCustomVars(): ?array
    {
        return $this->customVars;
    }

    /**
     * @param ?array<string, mixed> $value
     */
    public function setCustomVars(?array $value = null): self
    {
        $this->customVars = $value;
        $this->_setField('customVars');
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
