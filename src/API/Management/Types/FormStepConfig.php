<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;
use Auth0\SDK\API\Management\Core\Types\Union;

class FormStepConfig extends JsonSerializableType
{
    /**
     * @var ?array<(
     *    FormBlockDivider
     *   |FormBlockHtml
     *   |FormBlockImage
     *   |FormBlockJumpButton
     *   |FormBlockResendButton
     *   |FormBlockNextButton
     *   |FormBlockPreviousButton
     *   |FormBlockRichText
     *   |FormWidgetAuth0VerifiableCredentials
     *   |FormWidgetGMapsAddress
     *   |FormWidgetRecaptcha
     *   |FormFieldBoolean
     *   |FormFieldCards
     *   |FormFieldChoice
     *   |FormFieldCustom
     *   |FormFieldDate
     *   |FormFieldDropdown
     *   |FormFieldEmail
     *   |FormFieldFile
     *   |FormFieldLegal
     *   |FormFieldNumber
     *   |FormFieldPassword
     *   |FormFieldPayment
     *   |FormFieldSocial
     *   |FormFieldTel
     *   |FormFieldText
     *   |FormFieldUrl
     * )> $components
     */
    #[JsonProperty('components'), ArrayType([new Union(FormBlockDivider::class, FormBlockHtml::class, FormBlockImage::class, FormBlockJumpButton::class, FormBlockResendButton::class, FormBlockNextButton::class, FormBlockPreviousButton::class, FormBlockRichText::class, FormWidgetAuth0VerifiableCredentials::class, FormWidgetGMapsAddress::class, FormWidgetRecaptcha::class, FormFieldBoolean::class, FormFieldCards::class, FormFieldChoice::class, FormFieldCustom::class, FormFieldDate::class, FormFieldDropdown::class, FormFieldEmail::class, FormFieldFile::class, FormFieldLegal::class, FormFieldNumber::class, FormFieldPassword::class, FormFieldPayment::class, FormFieldSocial::class, FormFieldTel::class, FormFieldText::class, FormFieldUrl::class)])]
    private ?array $components;

    /**
     * @var (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $nextNode
     */
    #[JsonProperty('next_node'), Union('string', 'null')]
    private string|null $nextNode;

    /**
     * @param array{
     *   components?: ?array<(
     *    FormBlockDivider
     *   |FormBlockHtml
     *   |FormBlockImage
     *   |FormBlockJumpButton
     *   |FormBlockResendButton
     *   |FormBlockNextButton
     *   |FormBlockPreviousButton
     *   |FormBlockRichText
     *   |FormWidgetAuth0VerifiableCredentials
     *   |FormWidgetGMapsAddress
     *   |FormWidgetRecaptcha
     *   |FormFieldBoolean
     *   |FormFieldCards
     *   |FormFieldChoice
     *   |FormFieldCustom
     *   |FormFieldDate
     *   |FormFieldDropdown
     *   |FormFieldEmail
     *   |FormFieldFile
     *   |FormFieldLegal
     *   |FormFieldNumber
     *   |FormFieldPassword
     *   |FormFieldPayment
     *   |FormFieldSocial
     *   |FormFieldTel
     *   |FormFieldText
     *   |FormFieldUrl
     * )>,
     *   nextNode?: (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->components = $values['components'] ?? null;
        $this->nextNode = $values['nextNode'] ?? null;
    }

    /**
     * @return ?array<(
     *    FormBlockDivider
     *   |FormBlockHtml
     *   |FormBlockImage
     *   |FormBlockJumpButton
     *   |FormBlockResendButton
     *   |FormBlockNextButton
     *   |FormBlockPreviousButton
     *   |FormBlockRichText
     *   |FormWidgetAuth0VerifiableCredentials
     *   |FormWidgetGMapsAddress
     *   |FormWidgetRecaptcha
     *   |FormFieldBoolean
     *   |FormFieldCards
     *   |FormFieldChoice
     *   |FormFieldCustom
     *   |FormFieldDate
     *   |FormFieldDropdown
     *   |FormFieldEmail
     *   |FormFieldFile
     *   |FormFieldLegal
     *   |FormFieldNumber
     *   |FormFieldPassword
     *   |FormFieldPayment
     *   |FormFieldSocial
     *   |FormFieldTel
     *   |FormFieldText
     *   |FormFieldUrl
     * )>
     */
    public function getComponents(): ?array
    {
        return $this->components;
    }

    /**
     * @param ?array<(
     *    FormBlockDivider
     *   |FormBlockHtml
     *   |FormBlockImage
     *   |FormBlockJumpButton
     *   |FormBlockResendButton
     *   |FormBlockNextButton
     *   |FormBlockPreviousButton
     *   |FormBlockRichText
     *   |FormWidgetAuth0VerifiableCredentials
     *   |FormWidgetGMapsAddress
     *   |FormWidgetRecaptcha
     *   |FormFieldBoolean
     *   |FormFieldCards
     *   |FormFieldChoice
     *   |FormFieldCustom
     *   |FormFieldDate
     *   |FormFieldDropdown
     *   |FormFieldEmail
     *   |FormFieldFile
     *   |FormFieldLegal
     *   |FormFieldNumber
     *   |FormFieldPassword
     *   |FormFieldPayment
     *   |FormFieldSocial
     *   |FormFieldTel
     *   |FormFieldText
     *   |FormFieldUrl
     * )> $value
     */
    public function setComponents(?array $value = null): self
    {
        $this->components = $value;
        $this->_setField('components');
        return $this;
    }

    /**
     * @return (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null
     */
    public function getNextNode(): string|null
    {
        return $this->nextNode;
    }

    /**
     * @param (
     *    string
     *   |value-of<FormEndingNodeId>
     * )|null $value
     */
    public function setNextNode(string|null $value = null): self
    {
        $this->nextNode = $value;
        $this->_setField('nextNode');
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
