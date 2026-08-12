<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

/**
 * A simplified presentation request
 */
class MdlPresentationRequest extends JsonSerializableType
{
    /**
     * @var MdlPresentationRequestProperties $orgIso1801351MDl
     */
    #[JsonProperty('org.iso.18013.5.1.mDL')]
    private MdlPresentationRequestProperties $orgIso1801351MDl;

    /**
     * @param array{
     *   orgIso1801351MDl: MdlPresentationRequestProperties,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->orgIso1801351MDl = $values['orgIso1801351MDl'];
    }

    /**
     * @return MdlPresentationRequestProperties
     */
    public function getOrgIso1801351MDl(): MdlPresentationRequestProperties
    {
        return $this->orgIso1801351MDl;
    }

    /**
     * @param MdlPresentationRequestProperties $value
     */
    public function setOrgIso1801351MDl(MdlPresentationRequestProperties $value): self
    {
        $this->orgIso1801351MDl = $value;
        $this->_setField('orgIso1801351MDl');
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
