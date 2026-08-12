<?php

namespace Auth0\SDK\API\Management\TokenExchangeProfiles\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\TokenExchangeProfileTypeEnum;

class CreateTokenExchangeProfileRequestContent extends JsonSerializableType
{
    /**
     * @var string $name Friendly name of this profile.
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var string $subjectTokenType Subject token type for this profile. When receiving a token exchange request on the Authentication API, the corresponding token exchange profile with a matching subject_token_type will be executed. This must be a URI.
     */
    #[JsonProperty('subject_token_type')]
    private string $subjectTokenType;

    /**
     * @var string $actionId The ID of the Custom Token Exchange action to execute for this profile, in order to validate the subject_token. The action must use the custom-token-exchange trigger.
     */
    #[JsonProperty('action_id')]
    private string $actionId;

    /**
     * @var value-of<TokenExchangeProfileTypeEnum> $type
     */
    #[JsonProperty('type')]
    private string $type;

    /**
     * @param array{
     *   name: string,
     *   subjectTokenType: string,
     *   actionId: string,
     *   type: value-of<TokenExchangeProfileTypeEnum>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->subjectTokenType = $values['subjectTokenType'];
        $this->actionId = $values['actionId'];
        $this->type = $values['type'];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $value
     */
    public function setName(string $value): self
    {
        $this->name = $value;
        $this->_setField('name');
        return $this;
    }

    /**
     * @return string
     */
    public function getSubjectTokenType(): string
    {
        return $this->subjectTokenType;
    }

    /**
     * @param string $value
     */
    public function setSubjectTokenType(string $value): self
    {
        $this->subjectTokenType = $value;
        $this->_setField('subjectTokenType');
        return $this;
    }

    /**
     * @return string
     */
    public function getActionId(): string
    {
        return $this->actionId;
    }

    /**
     * @param string $value
     */
    public function setActionId(string $value): self
    {
        $this->actionId = $value;
        $this->_setField('actionId');
        return $this;
    }

    /**
     * @return value-of<TokenExchangeProfileTypeEnum>
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param value-of<TokenExchangeProfileTypeEnum> $value
     */
    public function setType(string $value): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }
}
