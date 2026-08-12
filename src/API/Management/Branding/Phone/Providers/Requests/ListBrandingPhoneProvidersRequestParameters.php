<?php

namespace Auth0\SDK\API\Management\Branding\Phone\Providers\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;

class ListBrandingPhoneProvidersRequestParameters extends JsonSerializableType
{
    /**
     * @var ?bool $disabled Whether the provider is enabled (false) or disabled (true).
     */
    private ?bool $disabled;

    /**
     * @param array{
     *   disabled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->disabled = $values['disabled'] ?? null;
    }

    /**
     * @return ?bool
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param ?bool $value
     */
    public function setDisabled(?bool $value = null): self
    {
        $this->disabled = $value;
        $this->_setField('disabled');
        return $this;
    }
}
