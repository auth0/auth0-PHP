<?php

namespace Auth0\SDK\API\Management\Types;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Core\Types\ArrayType;

/**
 * An auth transaction.
 */
class EventStreamCloudEventContextTransaction extends JsonSerializableType
{
    /**
     * @var array<string> $acrValues acr_values in the request.
     */
    #[JsonProperty('acr_values'), ArrayType(['string'])]
    private array $acrValues;

    /**
     * @var string $locale The locale used for this transaction.
     */
    #[JsonProperty('locale')]
    private string $locale;

    /**
     * @var ?string $loginHint Hint about the login identifier the user might use in this transaction.
     */
    #[JsonProperty('login_hint')]
    private ?string $loginHint;

    /**
     * @var ?array<string> $prompt Instructions indicating whether the user may be prompted for re-authentication and consent.
     */
    #[JsonProperty('prompt'), ArrayType(['string'])]
    private ?array $prompt;

    /**
     * @var ?value-of<EventStreamCloudEventContextTransactionProtocolEnum> $protocol
     */
    #[JsonProperty('protocol')]
    private ?string $protocol;

    /**
     * @var ?string $redirectUri The URL to which the client will be redirected when the transaction completes.
     */
    #[JsonProperty('redirect_uri')]
    private ?string $redirectUri;

    /**
     * @var array<string> $requestedScopes The scopes requested.
     */
    #[JsonProperty('requested_scopes'), ArrayType(['string'])]
    private array $requestedScopes;

    /**
     * @var ?value-of<EventStreamCloudEventContextTransactionResponseModeEnum> $responseMode
     */
    #[JsonProperty('response_mode')]
    private ?string $responseMode;

    /**
     * @var ?array<value-of<EventStreamCloudEventContextTransactionResponseTypeItemEnum>> $responseType The kind of credential issued by this transaction.
     */
    #[JsonProperty('response_type'), ArrayType(['string'])]
    private ?array $responseType;

    /**
     * @var ?string $state The OAuth state parameter for this transaction.
     */
    #[JsonProperty('state')]
    private ?string $state;

    /**
     * @var array<string> $uiLocales The ui_locales requested for this transaction.
     */
    #[JsonProperty('ui_locales'), ArrayType(['string'])]
    private array $uiLocales;

    /**
     * @param array{
     *   acrValues: array<string>,
     *   locale: string,
     *   requestedScopes: array<string>,
     *   uiLocales: array<string>,
     *   loginHint?: ?string,
     *   prompt?: ?array<string>,
     *   protocol?: ?value-of<EventStreamCloudEventContextTransactionProtocolEnum>,
     *   redirectUri?: ?string,
     *   responseMode?: ?value-of<EventStreamCloudEventContextTransactionResponseModeEnum>,
     *   responseType?: ?array<value-of<EventStreamCloudEventContextTransactionResponseTypeItemEnum>>,
     *   state?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->acrValues = $values['acrValues'];
        $this->locale = $values['locale'];
        $this->loginHint = $values['loginHint'] ?? null;
        $this->prompt = $values['prompt'] ?? null;
        $this->protocol = $values['protocol'] ?? null;
        $this->redirectUri = $values['redirectUri'] ?? null;
        $this->requestedScopes = $values['requestedScopes'];
        $this->responseMode = $values['responseMode'] ?? null;
        $this->responseType = $values['responseType'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->uiLocales = $values['uiLocales'];
    }

    /**
     * @return array<string>
     */
    public function getAcrValues(): array
    {
        return $this->acrValues;
    }

    /**
     * @param array<string> $value
     */
    public function setAcrValues(array $value): self
    {
        $this->acrValues = $value;
        $this->_setField('acrValues');
        return $this;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * @param string $value
     */
    public function setLocale(string $value): self
    {
        $this->locale = $value;
        $this->_setField('locale');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getLoginHint(): ?string
    {
        return $this->loginHint;
    }

    /**
     * @param ?string $value
     */
    public function setLoginHint(?string $value = null): self
    {
        $this->loginHint = $value;
        $this->_setField('loginHint');
        return $this;
    }

    /**
     * @return ?array<string>
     */
    public function getPrompt(): ?array
    {
        return $this->prompt;
    }

    /**
     * @param ?array<string> $value
     */
    public function setPrompt(?array $value = null): self
    {
        $this->prompt = $value;
        $this->_setField('prompt');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventContextTransactionProtocolEnum>
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    /**
     * @param ?value-of<EventStreamCloudEventContextTransactionProtocolEnum> $value
     */
    public function setProtocol(?string $value = null): self
    {
        $this->protocol = $value;
        $this->_setField('protocol');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getRedirectUri(): ?string
    {
        return $this->redirectUri;
    }

    /**
     * @param ?string $value
     */
    public function setRedirectUri(?string $value = null): self
    {
        $this->redirectUri = $value;
        $this->_setField('redirectUri');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getRequestedScopes(): array
    {
        return $this->requestedScopes;
    }

    /**
     * @param array<string> $value
     */
    public function setRequestedScopes(array $value): self
    {
        $this->requestedScopes = $value;
        $this->_setField('requestedScopes');
        return $this;
    }

    /**
     * @return ?value-of<EventStreamCloudEventContextTransactionResponseModeEnum>
     */
    public function getResponseMode(): ?string
    {
        return $this->responseMode;
    }

    /**
     * @param ?value-of<EventStreamCloudEventContextTransactionResponseModeEnum> $value
     */
    public function setResponseMode(?string $value = null): self
    {
        $this->responseMode = $value;
        $this->_setField('responseMode');
        return $this;
    }

    /**
     * @return ?array<value-of<EventStreamCloudEventContextTransactionResponseTypeItemEnum>>
     */
    public function getResponseType(): ?array
    {
        return $this->responseType;
    }

    /**
     * @param ?array<value-of<EventStreamCloudEventContextTransactionResponseTypeItemEnum>> $value
     */
    public function setResponseType(?array $value = null): self
    {
        $this->responseType = $value;
        $this->_setField('responseType');
        return $this;
    }

    /**
     * @return ?string
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param ?string $value
     */
    public function setState(?string $value = null): self
    {
        $this->state = $value;
        $this->_setField('state');
        return $this;
    }

    /**
     * @return array<string>
     */
    public function getUiLocales(): array
    {
        return $this->uiLocales;
    }

    /**
     * @param array<string> $value
     */
    public function setUiLocales(array $value): self
    {
        $this->uiLocales = $value;
        $this->_setField('uiLocales');
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
