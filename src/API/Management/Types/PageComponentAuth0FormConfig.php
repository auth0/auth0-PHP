<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class PageComponentAuth0FormConfig extends JsonSerializableType
{
    /**
     * @var string $formId The identifier of the form you want to render.
     */
    #[JsonProperty('form_id')]
    private string $formId;

    /**
     * @var string $completionMessage Toast message displayed after successful form submission.
     */
    #[JsonProperty('completion_message')]
    private string $completionMessage;

    /**
     * @param array{
     *   formId: string,
     *   completionMessage: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->formId = $values['formId'];
        $this->completionMessage = $values['completionMessage'];
    }

    /**
     * @return string
     */
    public function getFormId(): string
    {
        return $this->formId;
    }

    /**
     * @param string $value
     */
    public function setFormId(string $value): self
    {
        $this->formId = $value;
        $this->_setField('formId');
        return $this;
    }

    /**
     * @return string
     */
    public function getCompletionMessage(): string
    {
        return $this->completionMessage;
    }

    /**
     * @param string $value
     */
    public function setCompletionMessage(string $value): self
    {
        $this->completionMessage = $value;
        $this->_setField('completionMessage');
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
