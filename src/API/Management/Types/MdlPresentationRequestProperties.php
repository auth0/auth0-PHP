<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class MdlPresentationRequestProperties extends JsonSerializableType
{
    /**
     * @var MdlPresentationProperties $orgIso1801351
     */
    #[JsonProperty('org.iso.18013.5.1')]
    private MdlPresentationProperties $orgIso1801351;

    /**
     * @param array{
     *   orgIso1801351: MdlPresentationProperties,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->orgIso1801351 = $values['orgIso1801351'];
    }

    /**
     * @return MdlPresentationProperties
     */
    public function getOrgIso1801351(): MdlPresentationProperties
    {
        return $this->orgIso1801351;
    }

    /**
     * @param MdlPresentationProperties $value
     */
    public function setOrgIso1801351(MdlPresentationProperties $value): self
    {
        $this->orgIso1801351 = $value;
        $this->_setField('orgIso1801351');
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
