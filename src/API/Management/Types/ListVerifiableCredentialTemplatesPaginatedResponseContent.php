<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

class ListVerifiableCredentialTemplatesPaginatedResponseContent extends JsonSerializableType
{
    /**
     * @var ?string $next Opaque identifier for use with the <i>from</i> query parameter for the next page of results.<br/>This identifier is valid for 24 hours.
     */
    #[JsonProperty('next')]
    private ?string $next;

    /**
     * @var ?array<VerifiableCredentialTemplateResponse> $templates
     */
    #[JsonProperty('templates'), ArrayType([VerifiableCredentialTemplateResponse::class])]
    private ?array $templates;

    /**
     * @param array{
     *   next?: ?string,
     *   templates?: ?array<VerifiableCredentialTemplateResponse>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->next = $values['next'] ?? null;
        $this->templates = $values['templates'] ?? null;
    }

    /**
     * @return ?string
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @param ?string $value
     */
    public function setNext(?string $value = null): self
    {
        $this->next = $value;
        $this->_setField('next');
        return $this;
    }

    /**
     * @return ?array<VerifiableCredentialTemplateResponse>
     */
    public function getTemplates(): ?array
    {
        return $this->templates;
    }

    /**
     * @param ?array<VerifiableCredentialTemplateResponse> $value
     */
    public function setTemplates(?array $value = null): self
    {
        $this->templates = $value;
        $this->_setField('templates');
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
