<?php

namespace Auth0\SDK\API\Management\Flows\Vault\Connections\Requests;

use Auth0\SDK\API\Management\Core\Json\JsonSerializableType;
use Auth0\SDK\API\Management\Core\Json\JsonProperty;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupApiKeyWithBaseUrl;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupApiKey;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupOauthApp;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupBigqueryOauthJwt;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupSecretApiKey;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupHttpBearer;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectionHttpBasicAuthSetup;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectionHttpApiKeySetup;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectionHttpOauthClientCredentialsSetup;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupJwt;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupMailjetApiKey;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupToken;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupWebhook;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupStripeKeyPair;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupOauthCode;
use Auth0\SDK\API\Management\Types\FlowsVaultConnectioSetupTwilioApiKey;
use Auth0\SDK\API\Management\Core\Types\Union;

class UpdateFlowsVaultConnectionRequestContent extends JsonSerializableType
{
    /**
     * @var ?string $name Flows Vault Connection name.
     */
    #[JsonProperty('name')]
    private ?string $name;

    /**
     * @var (
     *    FlowsVaultConnectioSetupApiKeyWithBaseUrl
     *   |FlowsVaultConnectioSetupApiKey
     *   |FlowsVaultConnectioSetupOauthApp
     *   |FlowsVaultConnectioSetupBigqueryOauthJwt
     *   |FlowsVaultConnectioSetupSecretApiKey
     *   |FlowsVaultConnectioSetupHttpBearer
     *   |FlowsVaultConnectionHttpBasicAuthSetup
     *   |FlowsVaultConnectionHttpApiKeySetup
     *   |FlowsVaultConnectionHttpOauthClientCredentialsSetup
     *   |FlowsVaultConnectioSetupJwt
     *   |FlowsVaultConnectioSetupMailjetApiKey
     *   |FlowsVaultConnectioSetupToken
     *   |FlowsVaultConnectioSetupWebhook
     *   |FlowsVaultConnectioSetupStripeKeyPair
     *   |FlowsVaultConnectioSetupOauthCode
     *   |FlowsVaultConnectioSetupTwilioApiKey
     * )|null $setup
     */
    #[JsonProperty('setup'), Union(FlowsVaultConnectioSetupApiKeyWithBaseUrl::class, FlowsVaultConnectioSetupApiKey::class, FlowsVaultConnectioSetupOauthApp::class, FlowsVaultConnectioSetupBigqueryOauthJwt::class, FlowsVaultConnectioSetupSecretApiKey::class, FlowsVaultConnectioSetupHttpBearer::class, FlowsVaultConnectionHttpBasicAuthSetup::class, FlowsVaultConnectionHttpApiKeySetup::class, FlowsVaultConnectionHttpOauthClientCredentialsSetup::class, FlowsVaultConnectioSetupJwt::class, FlowsVaultConnectioSetupMailjetApiKey::class, FlowsVaultConnectioSetupToken::class, FlowsVaultConnectioSetupWebhook::class, FlowsVaultConnectioSetupStripeKeyPair::class, FlowsVaultConnectioSetupOauthCode::class, FlowsVaultConnectioSetupTwilioApiKey::class, 'null')]
    private FlowsVaultConnectioSetupApiKeyWithBaseUrl|FlowsVaultConnectioSetupApiKey|FlowsVaultConnectioSetupOauthApp|FlowsVaultConnectioSetupBigqueryOauthJwt|FlowsVaultConnectioSetupSecretApiKey|FlowsVaultConnectioSetupHttpBearer|FlowsVaultConnectionHttpBasicAuthSetup|FlowsVaultConnectionHttpApiKeySetup|FlowsVaultConnectionHttpOauthClientCredentialsSetup|FlowsVaultConnectioSetupJwt|FlowsVaultConnectioSetupMailjetApiKey|FlowsVaultConnectioSetupToken|FlowsVaultConnectioSetupWebhook|FlowsVaultConnectioSetupStripeKeyPair|FlowsVaultConnectioSetupOauthCode|FlowsVaultConnectioSetupTwilioApiKey|null $setup;

    /**
     * @param array{
     *   name?: ?string,
     *   setup?: (
     *    FlowsVaultConnectioSetupApiKeyWithBaseUrl
     *   |FlowsVaultConnectioSetupApiKey
     *   |FlowsVaultConnectioSetupOauthApp
     *   |FlowsVaultConnectioSetupBigqueryOauthJwt
     *   |FlowsVaultConnectioSetupSecretApiKey
     *   |FlowsVaultConnectioSetupHttpBearer
     *   |FlowsVaultConnectionHttpBasicAuthSetup
     *   |FlowsVaultConnectionHttpApiKeySetup
     *   |FlowsVaultConnectionHttpOauthClientCredentialsSetup
     *   |FlowsVaultConnectioSetupJwt
     *   |FlowsVaultConnectioSetupMailjetApiKey
     *   |FlowsVaultConnectioSetupToken
     *   |FlowsVaultConnectioSetupWebhook
     *   |FlowsVaultConnectioSetupStripeKeyPair
     *   |FlowsVaultConnectioSetupOauthCode
     *   |FlowsVaultConnectioSetupTwilioApiKey
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->name = $values['name'] ?? null;
        $this->setup = $values['setup'] ?? null;
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
     * @return (
     *    FlowsVaultConnectioSetupApiKeyWithBaseUrl
     *   |FlowsVaultConnectioSetupApiKey
     *   |FlowsVaultConnectioSetupOauthApp
     *   |FlowsVaultConnectioSetupBigqueryOauthJwt
     *   |FlowsVaultConnectioSetupSecretApiKey
     *   |FlowsVaultConnectioSetupHttpBearer
     *   |FlowsVaultConnectionHttpBasicAuthSetup
     *   |FlowsVaultConnectionHttpApiKeySetup
     *   |FlowsVaultConnectionHttpOauthClientCredentialsSetup
     *   |FlowsVaultConnectioSetupJwt
     *   |FlowsVaultConnectioSetupMailjetApiKey
     *   |FlowsVaultConnectioSetupToken
     *   |FlowsVaultConnectioSetupWebhook
     *   |FlowsVaultConnectioSetupStripeKeyPair
     *   |FlowsVaultConnectioSetupOauthCode
     *   |FlowsVaultConnectioSetupTwilioApiKey
     * )|null
     */
    public function getSetup(): FlowsVaultConnectioSetupApiKeyWithBaseUrl|FlowsVaultConnectioSetupApiKey|FlowsVaultConnectioSetupOauthApp|FlowsVaultConnectioSetupBigqueryOauthJwt|FlowsVaultConnectioSetupSecretApiKey|FlowsVaultConnectioSetupHttpBearer|FlowsVaultConnectionHttpBasicAuthSetup|FlowsVaultConnectionHttpApiKeySetup|FlowsVaultConnectionHttpOauthClientCredentialsSetup|FlowsVaultConnectioSetupJwt|FlowsVaultConnectioSetupMailjetApiKey|FlowsVaultConnectioSetupToken|FlowsVaultConnectioSetupWebhook|FlowsVaultConnectioSetupStripeKeyPair|FlowsVaultConnectioSetupOauthCode|FlowsVaultConnectioSetupTwilioApiKey|null
    {
        return $this->setup;
    }

    /**
     * @param (
     *    FlowsVaultConnectioSetupApiKeyWithBaseUrl
     *   |FlowsVaultConnectioSetupApiKey
     *   |FlowsVaultConnectioSetupOauthApp
     *   |FlowsVaultConnectioSetupBigqueryOauthJwt
     *   |FlowsVaultConnectioSetupSecretApiKey
     *   |FlowsVaultConnectioSetupHttpBearer
     *   |FlowsVaultConnectionHttpBasicAuthSetup
     *   |FlowsVaultConnectionHttpApiKeySetup
     *   |FlowsVaultConnectionHttpOauthClientCredentialsSetup
     *   |FlowsVaultConnectioSetupJwt
     *   |FlowsVaultConnectioSetupMailjetApiKey
     *   |FlowsVaultConnectioSetupToken
     *   |FlowsVaultConnectioSetupWebhook
     *   |FlowsVaultConnectioSetupStripeKeyPair
     *   |FlowsVaultConnectioSetupOauthCode
     *   |FlowsVaultConnectioSetupTwilioApiKey
     * )|null $value
     */
    public function setSetup(FlowsVaultConnectioSetupApiKeyWithBaseUrl|FlowsVaultConnectioSetupApiKey|FlowsVaultConnectioSetupOauthApp|FlowsVaultConnectioSetupBigqueryOauthJwt|FlowsVaultConnectioSetupSecretApiKey|FlowsVaultConnectioSetupHttpBearer|FlowsVaultConnectionHttpBasicAuthSetup|FlowsVaultConnectionHttpApiKeySetup|FlowsVaultConnectionHttpOauthClientCredentialsSetup|FlowsVaultConnectioSetupJwt|FlowsVaultConnectioSetupMailjetApiKey|FlowsVaultConnectioSetupToken|FlowsVaultConnectioSetupWebhook|FlowsVaultConnectioSetupStripeKeyPair|FlowsVaultConnectioSetupOauthCode|FlowsVaultConnectioSetupTwilioApiKey|null $value = null): self
    {
        $this->setup = $value;
        $this->_setField('setup');
        return $this;
    }
}
