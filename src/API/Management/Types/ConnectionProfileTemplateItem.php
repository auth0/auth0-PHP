<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;

class ConnectionProfileTemplateItem extends JsonSerializableType
{
    /**
     * @var ?string $id The id of the template.
     */
    #[JsonProperty('id')]
    private ?string $id;

    /**
     * @var ?string $displayName The user-friendly name of the template displayed in the UI.
     */
    #[JsonProperty('display_name')]
    private ?string $displayName;

    /**
     * @var ?ConnectionProfileTemplate $template
     */
    #[JsonProperty('template')]
    private ?ConnectionProfileTemplate $template;

    /**
     * @param array{
     *   id?: ?string,
     *   displayName?: ?string,
     *   template?: ?ConnectionProfileTemplate,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->displayName = $values['displayName'] ?? null;
        $this->template = $values['template'] ?? null;
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
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }

    /**
     * @param ?string $value
     */
    public function setDisplayName(?string $value = null): self
    {
        $this->displayName = $value;
        $this->_setField('displayName');
        return $this;
    }

    /**
     * @return ?ConnectionProfileTemplate
     */
    public function getTemplate(): ?ConnectionProfileTemplate
    {
        return $this->template;
    }

    /**
     * @param ?ConnectionProfileTemplate $value
     */
    public function setTemplate(?ConnectionProfileTemplate $value = null): self
    {
        $this->template = $value;
        $this->_setField('template');
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
