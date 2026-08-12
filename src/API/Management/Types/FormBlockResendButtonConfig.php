<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormBlockResendButtonConfig extends JsonSerializableType
{
    /**
     * @var string $activeText
     */
    #[JsonProperty('active_text')]
    private string $activeText;

    /**
     * @var string $buttonText
     */
    #[JsonProperty('button_text')]
    private string $buttonText;

    /**
     * @var string $waitingText
     */
    #[JsonProperty('waiting_text')]
    private string $waitingText;

    /**
     * @var ?value-of<FormBlockResendButtonConfigTextAlignmentEnum> $textAlignment
     */
    #[JsonProperty('text_alignment')]
    private ?string $textAlignment;

    /**
     * @var string $flowId
     */
    #[JsonProperty('flow_id')]
    private string $flowId;

    /**
     * @var ?float $maxAttempts
     */
    #[JsonProperty('max_attempts')]
    private ?float $maxAttempts;

    /**
     * @var ?float $waitingTime
     */
    #[JsonProperty('waiting_time')]
    private ?float $waitingTime;

    /**
     * @param array{
     *   activeText: string,
     *   buttonText: string,
     *   waitingText: string,
     *   flowId: string,
     *   textAlignment?: ?value-of<FormBlockResendButtonConfigTextAlignmentEnum>,
     *   maxAttempts?: ?float,
     *   waitingTime?: ?float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->activeText = $values['activeText'];
        $this->buttonText = $values['buttonText'];
        $this->waitingText = $values['waitingText'];
        $this->textAlignment = $values['textAlignment'] ?? null;
        $this->flowId = $values['flowId'];
        $this->maxAttempts = $values['maxAttempts'] ?? null;
        $this->waitingTime = $values['waitingTime'] ?? null;
    }

    /**
     * @return string
     */
    public function getActiveText(): string
    {
        return $this->activeText;
    }

    /**
     * @param string $value
     */
    public function setActiveText(string $value): self
    {
        $this->activeText = $value;
        $this->_setField('activeText');
        return $this;
    }

    /**
     * @return string
     */
    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    /**
     * @param string $value
     */
    public function setButtonText(string $value): self
    {
        $this->buttonText = $value;
        $this->_setField('buttonText');
        return $this;
    }

    /**
     * @return string
     */
    public function getWaitingText(): string
    {
        return $this->waitingText;
    }

    /**
     * @param string $value
     */
    public function setWaitingText(string $value): self
    {
        $this->waitingText = $value;
        $this->_setField('waitingText');
        return $this;
    }

    /**
     * @return ?value-of<FormBlockResendButtonConfigTextAlignmentEnum>
     */
    public function getTextAlignment(): ?string
    {
        return $this->textAlignment;
    }

    /**
     * @param ?value-of<FormBlockResendButtonConfigTextAlignmentEnum> $value
     */
    public function setTextAlignment(?string $value = null): self
    {
        $this->textAlignment = $value;
        $this->_setField('textAlignment');
        return $this;
    }

    /**
     * @return string
     */
    public function getFlowId(): string
    {
        return $this->flowId;
    }

    /**
     * @param string $value
     */
    public function setFlowId(string $value): self
    {
        $this->flowId = $value;
        $this->_setField('flowId');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getMaxAttempts(): ?float
    {
        return $this->maxAttempts;
    }

    /**
     * @param ?float $value
     */
    public function setMaxAttempts(?float $value = null): self
    {
        $this->maxAttempts = $value;
        $this->_setField('maxAttempts');
        return $this;
    }

    /**
     * @return ?float
     */
    public function getWaitingTime(): ?float
    {
        return $this->waitingTime;
    }

    /**
     * @param ?float $value
     */
    public function setWaitingTime(?float $value = null): self
    {
        $this->waitingTime = $value;
        $this->_setField('waitingTime');
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
