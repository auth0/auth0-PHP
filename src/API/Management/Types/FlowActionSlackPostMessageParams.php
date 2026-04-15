<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class FlowActionSlackPostMessageParams extends JsonSerializableType
{
    /**
     * @var string $connectionId
     */
    #[JsonProperty('connection_id')]
    private string $connectionId;

    /**
     * @var ?string $text
     */
    #[JsonProperty('text')]
    private ?string $text;

    /**
     * @var ?array<FlowActionSlackPostMessageParamsAttachment> $attachments
     */
    #[JsonProperty('attachments'), ArrayType([FlowActionSlackPostMessageParamsAttachment::class])]
    private ?array $attachments;

    /**
     * @param array{
     *   connectionId: string,
     *   text?: ?string,
     *   attachments?: ?array<FlowActionSlackPostMessageParamsAttachment>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->connectionId = $values['connectionId'];
        $this->text = $values['text'] ?? null;
        $this->attachments = $values['attachments'] ?? null;
    }

    /**
     * @return string
     */
    public function getConnectionId(): string
    {
        return $this->connectionId;
    }

    /**
     * @param string $value
     */
    public function setConnectionId(string $value): self
    {
        $this->connectionId = $value;
        $this->_setField('connectionId');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param ?string $value
     */
    public function setText(?string $value = null): self
    {
        $this->text = $value;
        $this->_setField('text');
        return $this;
    }

    /**
     * @return ?array<FlowActionSlackPostMessageParamsAttachment>
     */
    public function getAttachments(): ?array
    {
        return $this->attachments;
    }

    /**
     * @param ?array<FlowActionSlackPostMessageParamsAttachment> $value
     */
    public function setAttachments(?array $value = null): self
    {
        $this->attachments = $value;
        $this->_setField('attachments');
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
