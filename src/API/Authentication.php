<?php

declare(strict_types=1);

namespace Auth0\SDK\API;

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\API\AuthenticationInterface;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Authentication.
 */
final class Authentication implements AuthenticationInterface
{
    /**
     * Instance of Auth0\SDK\API\Utility\HttpClient.
     */
    private ?HttpClient $httpClient = null;

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private ?SdkConfiguration $validatedConfiguration = null;

    /**
     * Authentication constructor.
     *
     * @param  array<mixed>|SdkConfiguration  $configuration  Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     *
     * @throws \Auth0\SDK\Exception\ConfigurationException when an invalidation `configuration` is provided
     *
     * @psalm-suppress DocblockTypeContradiction
     */
    public function __construct(
        private SdkConfiguration|array $configuration,
    ) {
        $this->getConfiguration();
    }

    public function getConfiguration(): SdkConfiguration
    {
        if (null === $this->validatedConfiguration) {
            if (\is_array($this->configuration)) {
                return $this->validatedConfiguration = new SdkConfiguration($this->configuration);
            }

            return $this->validatedConfiguration = $this->configuration;
        }

        return $this->validatedConfiguration;
    }

    public function getHttpClient(): HttpClient
    {
        if (null !== $this->httpClient) {
            return $this->httpClient;
        }

        return $this->httpClient = new HttpClient($this->getConfiguration(), HttpClient::CONTEXT_AUTHENTICATION_CLIENT);
    }

    public function getSamlpLink(
        ?string $clientId = null,
        ?string $connection = null,
    ): string {
        [$clientId, $connection] = Toolkit::filter([$clientId, $connection])->string()->trim();

        /** @var string $clientId */
        [$clientId] = Toolkit::filter([
            [$clientId, $this->getConfiguration()->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        /** @var array<string> $query */
        $query = Toolkit::filter([
            ['connection' => $connection],
        ])->array()->trim()[0];

        return sprintf(
            '%s/samlp/%s?%s',
            $this->getConfiguration()->formatDomain(),
            $clientId,
            http_build_query($query, '', '&', PHP_QUERY_RFC3986),
        );
    }

    public function getSamlpMetadataLink(
        ?string $clientId = null,
    ): string {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();

        /** @var string $clientId */
        [$clientId] = Toolkit::filter([
            [$clientId, $this->getConfiguration()->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        return sprintf(
            '%s/samlp/metadata/%s',
            $this->getConfiguration()->formatDomain(),
            $clientId,
        );
    }

    public function getWsfedLink(
        ?string $clientId = null,
        ?array $params = null,
    ): string {
        [$clientId] = Toolkit::filter([$clientId])->string()->trim();

        /** @var array<string> $params */
        [$params] = Toolkit::filter([$params])->array()->trim();

        /** @var string $clientId */
        [$clientId] = Toolkit::filter([
            [$clientId, $this->getConfiguration()->getClientId()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresClientId());

        return sprintf(
            '%s/wsfed/%s?%s',
            $this->getConfiguration()->formatDomain(),
            $clientId,
            http_build_query($params, '', '&', PHP_QUERY_RFC3986),
        );
    }

    public function getWsfedMetadataLink(): string
    {
        return sprintf(
            '%s/wsfed/FederationMetadata/2007-06/FederationMetadata.xml',
            $this->getConfiguration()->formatDomain(),
        );
    }

    public function getLoginLink(
        string $state,
        ?string $redirectUri = null,
        ?array $params = null,
    ): string {
        [$state, $redirectUri] = Toolkit::filter([$state, $redirectUri])->string()->trim();

        /** @var array<int|string> $params */
        [$params] = Toolkit::filter([$params])->array()->trim();

        Toolkit::assert([
            [$state, \Auth0\SDK\Exception\ArgumentException::missing('state')],
        ])->isString();

        [$redirectUri] = Toolkit::filter([
            [$redirectUri, isset($params['redirect_uri']) ? (string) $params['redirect_uri'] : null, $this->getConfiguration()->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        return sprintf(
            '%s/authorize?%s',
            $this->getConfiguration()->formatDomain(),
            http_build_query(Toolkit::merge([
                'state'         => $state,
                'client_id'     => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'audience'      => $this->getConfiguration()->defaultAudience(),
                'organization'  => $this->getConfiguration()->defaultOrganization(),
                'redirect_uri'  => $redirectUri,
                'scope'         => $this->getConfiguration()->formatScope(),
                'response_mode' => $this->getConfiguration()->getResponseMode(),
                'response_type' => $this->getConfiguration()->getResponseType(),
            ], $params), '', '&', PHP_QUERY_RFC3986),
        );
    }

    public function getLogoutLink(
        ?string $returnTo = null,
        ?array $params = null,
    ): string {
        [$returnTo] = Toolkit::filter([$returnTo])->string()->trim();

        /** @var array<int|string> $params */
        [$params] = Toolkit::filter([$params])->array()->trim();

        /** @var string $returnTo */
        [$returnTo] = Toolkit::filter([
            [$returnTo, isset($params['returnTo']) ? (string) $params['returnTo'] : null, $this->getConfiguration()->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        return sprintf(
            '%s/v2/logout?%s',
            $this->getConfiguration()->formatDomain(),
            http_build_query(Toolkit::merge([
                'returnTo'  => $returnTo,
                'client_id' => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
            ], $params), '', '&', PHP_QUERY_RFC3986),
        );
    }

    public function passwordlessStart(
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        /** @var array<mixed> $body */
        /** @var array<int|string> $headers */

        return $this->getHttpClient()->
            method('post')->
            addPath('passwordless', 'start')->
            withBody((object) Toolkit::merge([
                'client_id'     => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'client_secret' => $this->getConfiguration()->getClientSecret(\Auth0\SDK\Exception\ConfigurationException::requiresClientSecret()),
            ], $body))->
            withHeaders($headers)->
            call();
    }

    public function emailPasswordlessStart(
        string $email,
        string $type,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$email, $type] = Toolkit::filter([$email, $type])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
        ])->isEmail();

        Toolkit::assert([
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        /** @var array{scope: ?string} $params */
        if ((! isset($params['scope']) || '' === $params['scope']) && $this->getConfiguration()->hasScope()) {
            $params['scope'] = $this->getConfiguration()->formatScope() ?? '';
        }

        $body = Toolkit::filter([
            [
                'email'      => $email,
                'connection' => 'email',
                'send'       => $type,
                'authParams' => $params,
            ],
        ])->array()->trim()[0];

        /** @var array{authParams: ?array<string>} $body */
        if (null !== $body['authParams']) {
            $body['authParams'] = (object) $body['authParams'];
        }

        /** @var array<mixed> $body */
        /** @var array<int|string> $headers */

        return $this->passwordlessStart($body, $headers);
    }

    public function smsPasswordlessStart(
        string $phoneNumber,
        ?array $headers = null,
    ): ResponseInterface {
        [$phoneNumber] = Toolkit::filter([$phoneNumber])->string()->trim();
        [$headers] = Toolkit::filter([$headers])->array()->trim();

        Toolkit::assert([
            [$phoneNumber, \Auth0\SDK\Exception\ArgumentException::missing('phoneNumber')],
        ])->isString();

        $body = Toolkit::filter([
            [
                'phone_number' => $phoneNumber,
                'connection'   => 'sms',
            ],
        ])->array()->trim()[0];

        /** @var array<mixed> $body */
        /** @var array<int|string> $headers */

        return $this->passwordlessStart($body, $headers);
    }

    public function userInfo(
        string $accessToken,
    ): ResponseInterface {
        [$accessToken] = Toolkit::filter([$accessToken])->string()->trim();

        Toolkit::assert([
            [$accessToken, \Auth0\SDK\Exception\ArgumentException::missing('accessToken')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('userinfo')->
            withHeader('Authorization', 'Bearer ' . ($accessToken ?? ''))->
            call();
    }

    public function oauthToken(
        string $grantType,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$grantType] = Toolkit::filter([$grantType])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$grantType, \Auth0\SDK\Exception\ArgumentException::missing('grantType')],
        ])->isString();

        /** @var array<bool|int|string> $params */
        $parameters = Toolkit::merge([
            'grant_type'    => $grantType,
            'client_id'     => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
            'client_secret' => $this->getConfiguration()->getClientSecret(\Auth0\SDK\Exception\ConfigurationException::requiresClientSecret()),
        ], $params);

        /** @var array<bool|int|string> $parameters */
        /** @var array<int|string> $headers */

        return $this->getHttpClient()->
            method('post')->
            addPath('oauth', 'token')->
            withHeaders($headers)->
            withFormParams($parameters)->
            call();
    }

    public function codeExchange(
        string $code,
        ?string $redirectUri = null,
        ?string $codeVerifier = null,
    ): ResponseInterface {
        [$code, $redirectUri, $codeVerifier] = Toolkit::filter([$code, $redirectUri, $codeVerifier])->string()->trim();

        Toolkit::assert([
            [$code, \Auth0\SDK\Exception\ArgumentException::missing('code')],
        ])->isString();

        [$redirectUri] = Toolkit::filter([
            [$redirectUri, $this->getConfiguration()->getRedirectUri()],
        ])->array()->first(\Auth0\SDK\Exception\ConfigurationException::requiresRedirectUri());

        $params = Toolkit::filter([
            [
                'redirect_uri'  => $redirectUri,
                'code'          => $code,
                'code_verifier' => $codeVerifier,
            ],
        ])->array()->trim()[0];

        /** @var array<int|string|null> $params */

        return $this->oauthToken('authorization_code', $params);
    }

    public function login(
        string $username,
        string $password,
        string $realm,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$username, $password, $realm] = Toolkit::filter([$username, $password, $realm])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$username, \Auth0\SDK\Exception\ArgumentException::missing('username')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
            [$realm, \Auth0\SDK\Exception\ArgumentException::missing('realm')],
        ])->isString();

        /** @var array<int|string|null> $params */
        $parameters = Toolkit::merge([
            'username' => $username,
            'password' => $password,
            'realm'    => $realm,
        ], $params);

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string> $headers */

        return $this->oauthToken('http://auth0.com/oauth/grant-type/password-realm', $parameters, $headers);
    }

    public function loginWithDefaultDirectory(
        string $username,
        string $password,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$username, $password] = Toolkit::filter([$username, $password])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$username, \Auth0\SDK\Exception\ArgumentException::missing('username')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
        ])->isString();

        /** @var array<int|string|null> $params */
        $parameters = Toolkit::merge([
            'username' => $username,
            'password' => $password,
        ], $params);

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string> $headers */

        return $this->oauthToken('password', $parameters, $headers);
    }

    public function clientCredentials(
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        /** @var array<int|string|null> $params */
        $parameters = Toolkit::merge([
            'audience' => $this->getConfiguration()->defaultAudience(),
        ], $params);

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string> $headers */

        return $this->oauthToken('client_credentials', $parameters, $headers);
    }

    public function refreshToken(
        string $refreshToken,
        ?array $params = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$refreshToken] = Toolkit::filter([$refreshToken])->string()->trim();
        [$params, $headers] = Toolkit::filter([$params, $headers])->array()->trim();

        Toolkit::assert([
            [$refreshToken, \Auth0\SDK\Exception\ArgumentException::missing('refreshToken')],
        ])->isString();

        /** @var array<int|string|null> $params */
        $parameters = Toolkit::merge([
            'refresh_token' => $refreshToken,
        ], $params);

        /** @var array<int|string|null> $parameters */
        /** @var array<int|string> $headers */

        return $this->oauthToken('refresh_token', $parameters, $headers);
    }

    public function dbConnectionsSignup(
        string $email,
        string $password,
        string $connection,
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$email, $password, $connection] = Toolkit::filter([$email, $password, $connection])->string()->trim();
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
            [$password, \Auth0\SDK\Exception\ArgumentException::missing('password')],
            [$connection, \Auth0\SDK\Exception\ArgumentException::missing('connection')],
        ])->isString();

        /** @var array<mixed> $body */
        /** @var array<int|string> $headers */

        return $this->getHttpClient()->
            method('post')->
            addPath('dbconnections', 'signup')->
            withBody(Toolkit::merge([
                'client_id'  => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'email'      => $email,
                'password'   => $password,
                'connection' => $connection,
            ], $body))->
            withHeaders($headers)->
            call();
    }

    public function dbConnectionsChangePassword(
        string $email,
        string $connection,
        ?array $body = null,
        ?array $headers = null,
    ): ResponseInterface {
        [$email, $connection] = Toolkit::filter([$email, $connection])->string()->trim();
        [$body, $headers] = Toolkit::filter([$body, $headers])->array()->trim();

        Toolkit::assert([
            [$email, \Auth0\SDK\Exception\ArgumentException::missing('email')],
            [$connection, \Auth0\SDK\Exception\ArgumentException::missing('connection')],
        ])->isString();

        /** @var array<mixed> $body */
        /** @var array<int|string> $headers */

        return $this->getHttpClient()->
            method('post')->
            addPath('dbconnections', 'change_password')->
            withBody(Toolkit::merge([
                'client_id'  => $this->getConfiguration()->getClientId(\Auth0\SDK\Exception\ConfigurationException::requiresClientId()),
                'email'      => $email,
                'connection' => $connection,
            ], $body))->
            withHeaders($headers)->
            call();
    }
}
