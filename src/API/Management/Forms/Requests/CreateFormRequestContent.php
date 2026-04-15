<?php

namespace Auth0\SDK\API\Management\Forms\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\FormMessages;
use Auth0\SDK\API\Management\Types\FormLanguages;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Types\FormFlow;
use Auth0\SDK\API\Management\Types\FormRouter;
use Auth0\SDK\API\Management\Types\FormStep;
use Auth0\SDK\API\Management\Core\Types\Union;
use Auth0\SDK\API\Management\Types\FormStartNode;
use Auth0\SDK\API\Management\Types\FormEndingNode;
use Auth0\SDK\API\Management\Types\FormStyle;

class CreateFormRequestContent extends JsonSerializableType
{
    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    private string $name;

    /**
     * @var ?FormMessages $messages
     */
    #[JsonProperty('messages')]
    private ?FormMessages $messages;

    /**
     * @var ?FormLanguages $languages
     */
    #[JsonProperty('languages')]
    private ?FormLanguages $languages;

    /**
     * @var ?array<string, array<string, mixed>> $translations
     */
    #[JsonProperty('translations'), ArrayType(['string' => ['string' => 'mixed']])]
    private ?array $translations;

    /**
     * @var ?array<(
     *    FormFlow
     *   |FormRouter
     *   |FormStep
     * )> $nodes
     */
    #[JsonProperty('nodes'), ArrayType([new Union(FormFlow::class, FormRouter::class, FormStep::class)])]
    private ?array $nodes;

    /**
     * @var ?FormStartNode $start
     */
    #[JsonProperty('start')]
    private ?FormStartNode $start;

    /**
     * @var ?FormEndingNode $ending
     */
    #[JsonProperty('ending')]
    private ?FormEndingNode $ending;

    /**
     * @var ?FormStyle $style
     */
    #[JsonProperty('style')]
    private ?FormStyle $style;

    /**
     * @param array{
     *   name: string,
     *   messages?: ?FormMessages,
     *   languages?: ?FormLanguages,
     *   translations?: ?array<string, array<string, mixed>>,
     *   nodes?: ?array<(
     *    FormFlow
     *   |FormRouter
     *   |FormStep
     * )>,
     *   start?: ?FormStartNode,
     *   ending?: ?FormEndingNode,
     *   style?: ?FormStyle,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->name = $values['name'];
        $this->messages = $values['messages'] ?? null;
        $this->languages = $values['languages'] ?? null;
        $this->translations = $values['translations'] ?? null;
        $this->nodes = $values['nodes'] ?? null;
        $this->start = $values['start'] ?? null;
        $this->ending = $values['ending'] ?? null;
        $this->style = $values['style'] ?? null;
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
     * @return ?FormMessages
     */
    public function getMessages(): ?FormMessages
    {
        return $this->messages;
    }

    /**
     * @param ?FormMessages $value
     */
    public function setMessages(?FormMessages $value = null): self
    {
        $this->messages = $value;
        $this->_setField('messages');
        return $this;
    }

    /**
     * @return ?FormLanguages
     */
    public function getLanguages(): ?FormLanguages
    {
        return $this->languages;
    }

    /**
     * @param ?FormLanguages $value
     */
    public function setLanguages(?FormLanguages $value = null): self
    {
        $this->languages = $value;
        $this->_setField('languages');
        return $this;
    }

    /**
     * @return ?array<string, array<string, mixed>>
     */
    public function getTranslations(): ?array
    {
        return $this->translations;
    }

    /**
     * @param ?array<string, array<string, mixed>> $value
     */
    public function setTranslations(?array $value = null): self
    {
        $this->translations = $value;
        $this->_setField('translations');
        return $this;
    }

    /**
     * @return ?array<(
     *    FormFlow
     *   |FormRouter
     *   |FormStep
     * )>
     */
    public function getNodes(): ?array
    {
        return $this->nodes;
    }

    /**
     * @param ?array<(
     *    FormFlow
     *   |FormRouter
     *   |FormStep
     * )> $value
     */
    public function setNodes(?array $value = null): self
    {
        $this->nodes = $value;
        $this->_setField('nodes');
        return $this;
    }

    /**
     * @return ?FormStartNode
     */
    public function getStart(): ?FormStartNode
    {
        return $this->start;
    }

    /**
     * @param ?FormStartNode $value
     */
    public function setStart(?FormStartNode $value = null): self
    {
        $this->start = $value;
        $this->_setField('start');
        return $this;
    }

    /**
     * @return ?FormEndingNode
     */
    public function getEnding(): ?FormEndingNode
    {
        return $this->ending;
    }

    /**
     * @param ?FormEndingNode $value
     */
    public function setEnding(?FormEndingNode $value = null): self
    {
        $this->ending = $value;
        $this->_setField('ending');
        return $this;
    }

    /**
     * @return ?FormStyle
     */
    public function getStyle(): ?FormStyle
    {
        return $this->style;
    }

    /**
     * @param ?FormStyle $value
     */
    public function setStyle(?FormStyle $value = null): self
    {
        $this->style = $value;
        $this->_setField('style');
        return $this;
    }
}
