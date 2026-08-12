<?php

namespace Auth0\SDK\API\Management\TokenExchangeProfiles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class UpdateTokenExchangeProfileRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name Friendly name of this profile.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var ?string $subjectTokenType Subject token type for this profile. When receiving a token exchange request on the Authentication API, the corresponding token exchange profile with a matching subject_token_type will be executed. This must be a URI.
     */
    #[JsonProperty('subject_token_type')]
    private ?string $subjectTokenType;

    /**
     * @param array{
     *   name?: ?string,
     *   subjectTokenType?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->subjectTokenType = $values['subjectTokenType'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param ?string $value
     */
    public function setName(?string $value = null): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getSubjectTokenType(): ?string
    {
        return $this->subjectTokenType;
    }

    /**
     * @param ?string $value
     */
    public function setSubjectTokenType(?string $value = null): self
    {
        $this->subjectTokenType = $value;
        $this->_setField('subjectTokenType');
        return $this;
    }
}
