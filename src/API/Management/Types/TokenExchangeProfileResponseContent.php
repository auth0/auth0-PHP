<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use DateTime;
use Auth0\SDK\API\Management\Core\Types\Date;

class TokenExchangeProfileResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $id The unique ID of the token exchange profile.
     */
    #[JsonProperty('id')]
    private ?string $id;

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
     * @var ?string $actionId The ID of the Custom Token Exchange action to execute for this profile, in order to validate the subject_token. The action must use the custom-token-exchange trigger.
     */
    #[JsonProperty('action_id')]
    private ?string $actionId;

    /**
     * @var ?value-of<TokenExchangeProfileTypeEnum> $type
     */
    #[JsonProperty('type')]
    private ?string $type;

    /**
     * @var ?DateTime $createdAt The time when this profile was created.
     */
    #[JsonProperty('created_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $createdAt;

    /**
     * @var ?DateTime $updatedAt The time when this profile was updated.
     */
    #[JsonProperty('updated_at'), Date(Date::TYPE_DATETIME)]
    private ?DateTime $updatedAt;

    /**
     * @param array{
     *   id?: ?string,
     *   name?: ?string,
     *   subjectTokenType?: ?string,
     *   actionId?: ?string,
     *   type?: ?value-of<TokenExchangeProfileTypeEnum>,
     *   createdAt?: ?DateTime,
     *   updatedAt?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->subjectTokenType = $values['subjectTokenType'] ?? null;
        $this->actionId = $values['actionId'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->updatedAt = $values['updatedAt'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param ?string $value
     */
    public function setId(?string $value = null): self
    {
        $this->id = $value;
        $this->_setField('id');
        return $this;
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

    /**
     * @return ?string
     */
    public function getActionId(): ?string
    {
        return $this->actionId;
    }

    /**
     * @param ?string $value
     */
    public function setActionId(?string $value = null): self
    {
        $this->actionId = $value;
        $this->_setField('actionId');
        return $this;
    }

    /**
     * @return ?value-of<TokenExchangeProfileTypeEnum>
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param ?value-of<TokenExchangeProfileTypeEnum> $value
     */
    public function setType(?string $value = null): self
    {
        $this->type = $value;
        $this->_setField('type');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setCreatedAt(?DateTime $value = null): self
    {
        $this->createdAt = $value;
        $this->_setField('createdAt');
        return $this;
    }

    /**
     * @return ?DateTime
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param ?DateTime $value
     */
    public function setUpdatedAt(?DateTime $value = null): self
    {
        $this->updatedAt = $value;
        $this->_setField('updatedAt');
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
