<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class FormEndingNode extends JsonSerializableType
{
    /**
     * @var ?FormEndingNodeRedirection $redirection
     */
    #[JsonProperty('redirection')]
    private ?FormEndingNodeRedirection $redirection;

    /**
     * @var ?FormEndingNodeAfterSubmit $afterSubmit
     */
    #[JsonProperty('after_submit')]
    private ?FormEndingNodeAfterSubmit $afterSubmit;

    /**
     * @var ?FormNodeCoordinates $coordinates
     */
    #[JsonProperty('coordinates')]
    private ?FormNodeCoordinates $coordinates;

    /**
     * @var ?bool $resumeFlow
     */
    #[JsonProperty('resume_flow')]
    private ?bool $resumeFlow;

    /**
     * @param array{
     *   redirection?: ?FormEndingNodeRedirection,
     *   afterSubmit?: ?FormEndingNodeAfterSubmit,
     *   coordinates?: ?FormNodeCoordinates,
     *   resumeFlow?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->redirection = $values['redirection'] ?? null;
        $this->afterSubmit = $values['afterSubmit'] ?? null;
        $this->coordinates = $values['coordinates'] ?? null;
        $this->resumeFlow = $values['resumeFlow'] ?? null;
    }

    /**
     * @return ?FormEndingNodeRedirection
     */
    public function getRedirection(): ?FormEndingNodeRedirection
    {
        return $this->redirection;
    }

    /**
     * @param ?FormEndingNodeRedirection $value
     */
    public function setRedirection(?FormEndingNodeRedirection $value = null): self
    {
        $this->redirection = $value;
        $this->_setField('redirection');
        return $this;
    }

    /**
     * @return ?FormEndingNodeAfterSubmit
     */
    public function getAfterSubmit(): ?FormEndingNodeAfterSubmit
    {
        return $this->afterSubmit;
    }

    /**
     * @param ?FormEndingNodeAfterSubmit $value
     */
    public function setAfterSubmit(?FormEndingNodeAfterSubmit $value = null): self
    {
        $this->afterSubmit = $value;
        $this->_setField('afterSubmit');
        return $this;
    }

    /**
     * @return ?FormNodeCoordinates
     */
    public function getCoordinates(): ?FormNodeCoordinates
    {
        return $this->coordinates;
    }

    /**
     * @param ?FormNodeCoordinates $value
     */
    public function setCoordinates(?FormNodeCoordinates $value = null): self
    {
        $this->coordinates = $value;
        $this->_setField('coordinates');
        return $this;
    }

    /**
     * @return ?bool
     */
    public function getResumeFlow(): ?bool
    {
        return $this->resumeFlow;
    }

    /**
     * @param ?bool $value
     */
    public function setResumeFlow(?bool $value = null): self
    {
        $this->resumeFlow = $value;
        $this->_setField('resumeFlow');
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
