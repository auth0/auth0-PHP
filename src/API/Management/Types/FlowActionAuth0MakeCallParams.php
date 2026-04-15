<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionAuth0MakeCallParams extends JsonSerializableType
{
    /**
     * @var ?string $from
     */
    #[JsonProperty('from')]
    private ?string $from;

    /**
     * @var string $to
     */
    #[JsonProperty('to')]
    private string $to;

    /**
     * @var string $message
     */
    #[JsonProperty('message')]
    private string $message;

    /**
     * @var ?array<string, mixed> $customVars
     */
    #[JsonProperty('custom_vars'), ArrayType(['string' => 'mixed'])]
    private ?array $customVars;

    /**
     * @param array{
     *   to: string,
     *   message: string,
     *   from?: ?string,
     *   customVars?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->from = $values['from'] ?? null;
        $this->to = $values['to'];
        $this->message = $values['message'];
        $this->customVars = $values['customVars'] ?? null;
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
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $value
     */
    public function setMessage(string $value): self
    {
        $this->message = $value;
        $this->_setField('message');
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
