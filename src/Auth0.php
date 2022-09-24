<?php

declare(strict_types=1);

namespace Auth0\SDK;

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Configuration\SdkState;
use Auth0\SDK\Contract\API\AuthenticationInterface;
use Auth0\SDK\Contract\API\ManagementInterface;
use Auth0\SDK\Contract\Auth0Interface;
use Auth0\SDK\Contract\TokenInterface;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\SDK\Utility\PKCE;
use Auth0\SDK\Utility\Toolkit;
use Auth0\SDK\Utility\TransientStoreHandler;

/**
 * Class Auth0.
 */
final class Auth0 implements Auth0Interface
{
    public const VERSION = '8.3.1';

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private SdkConfiguration $configuration;

    /**
     * Instance of SdkState, for shared state across classes.
     */
    private ?SdkState $state = null;

    /**
     * Instance of TransientStoreHandler for storing ephemeral data.
     */
    private ?TransientStoreHandler $transient = null;

    /**
     * Authentication Client.
     */
    private ?Authentication $authentication = null;

    /**
     * Authentication Client.
     */
    private ?Management $management = null;

    /**
     * Auth0 Constructor.
     *
     * @param SdkConfiguration|array<mixed> $configuration Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     */
    public function __construct(
        $configuration
    ) {
        // If we're passed an array, construct a new SdkConfiguration from that structure.
        if (is_array($configuration)) {
            $configuration = new SdkConfiguration($configuration);
        }

        // Store the configuration internally.
        $this->configuration = $configuration;
    }

    public function authentication(): AuthenticationInterface
    {
        if ($this->authentication === null) {
            $this->authentication = new Authentication($this->configuration);
        }

        return $this->authentication;
    }

    public function management(): ManagementInterface
    {
        if ($this->management === null) {
            $this->management = new Management($this->configuration);
        }

        return $this->management;
    }

    public function configuration(): SdkConfiguration
    {
        return $this->configuration;
    }

    public function login(
        ?string $redirectUrl = null,
        ?array $params = null
    ): string {
        $this->deferStateSaving();

        $params = $params ?? [];
        $state = $params['state'] ?? $this->getTransientStore()->issue('state');
        $params['nonce'] = $params['nonce'] ?? $this->getTransientStore()->issue('nonce');
        $params['max_age'] = $params['max_age'] ?? $this->configuration()->getTokenMaxAge();

        unset($params['state']);

        if ($this->configuration()->getUsePkce()) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            $params['code_challenge_method'] = 'S256';
            $this->getTransientStore()->store('code_verifier', $codeVerifier);
        }

        if ($params['max_age'] !== null) {
            $this->getTransientStore()->store('max_age', (string) $params['max_age']);
        }

        $this->deferStateSaving(false);

        return $this->authentication()->getLoginLink((string) $state, $redirectUrl, $params);
    }

    public function signup(
        ?string $redirectUrl = null,
        ?array $params = null
    ): string {
        $params = Toolkit::merge([
            'screen_hint' => 'signup',
        ], $params);

        /** @var array<int|string|null>|null $params */

        return $this->login($redirectUrl, $params);
    }

    public function handleInvitation(
        ?string $redirectUrl = null,
        ?array $params = null
    ): ?string {
        $invite = $this->getInvitationParameters();

        if ($invite !== null) {
            $params = Toolkit::merge([
                'invitation' => $invite['invitation'],
                'organization' => $invite['organization'],
            ], $params);

            /** @var array<int|string|null>|null $params */

            return $this->login($redirectUrl, $params);
        }

        return null;
    }

    public function logout(
        ?string $returnUri = null,
        ?array $params = null
    ): string {
        $this->clear();

        return $this->authentication()->getLogoutLink($returnUri, $params);
    }

    public function clear(
        bool $transient = true
    ): self {
        $this->deferStateSaving();

        // Delete all data in the session storage medium.
        if ($this->configuration()->hasSessionStorage()) {
            $this->configuration->getSessionStorage()->purge();
        }

        // Delete all data in the transient storage medium.
        if ($this->configuration()->hasTransientStorage() && $transient) {
            $this->configuration->getTransientStorage()->purge();
        }

        // If state saving had been deferred, disable it and force a update to persistent storage.
        $this->deferStateSaving(false);

        // Reset the internal state.
        $this->getState()->reset();

        return $this;
    }

    public function decode(
        string $token,
        ?array $tokenAudience = null,
        ?array $tokenOrganization = null,
        ?string $tokenNonce = null,
        ?int $tokenMaxAge = null,
        ?int $tokenLeeway = null,
        ?int $tokenNow = null,
        ?int $tokenType = null
    ): TokenInterface {
        $tokenType = $tokenType ?? Token::TYPE_ID_TOKEN;
        $tokenNonce = $tokenNonce ?? $this->getTransientStore()->getOnce('nonce') ?? null;
        $tokenMaxAge = $tokenMaxAge ?? $this->getTransientStore()->getOnce('max_age') ?? null;
        $tokenIssuer = null;

        $token = new Token($this->configuration, $token, $tokenType);
        $token->verify();

        // If pulled from transient storage, $tokenMaxAge might be a string.
        if ($tokenMaxAge !== null) {
            $tokenMaxAge = (int) $tokenMaxAge;
        }

        $token->validate(
            $tokenIssuer,
            $tokenAudience,
            $tokenOrganization,
            $tokenNonce,
            $tokenMaxAge,
            $tokenLeeway,
            $tokenNow
        );

        // Ensure transient-stored values are cleared, even if overriding values were passed to the  method.
        $this->getTransientStore()->delete('max_age');
        $this->getTransientStore()->delete('nonce');

        return $token;
    }

    public function exchange(
        ?string $redirectUri = null,
        ?string $code = null,
        ?string $state = null
    ): bool {
        [$redirectUri, $code, $state] = Toolkit::filter([$redirectUri, $code, $state])->string()->trim();

        $code = $code ?? $this->getRequestParameter('code');
        $state = $state ?? $this->getRequestParameter('state');
        $codeVerifier = null;
        $user = null;

        $this->clear(false);
        $this->deferStateSaving();

        if ($code === null) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::missingCode();
        }

        if ($state === null || ! $this->getTransientStore()->verify('state', $state)) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::invalidState();
        }

        if ($this->configuration()->getUsePkce()) {
            $codeVerifier = $this->getTransientStore()->getOnce('code_verifier');

            if ($codeVerifier === null) {
                $this->clear();
                throw \Auth0\SDK\Exception\StateException::missingCodeVerifier();
            }
        }

        $response = $this->authentication()->codeExchange($code, $redirectUri, $codeVerifier);

        if (! HttpResponse::wasSuccessful($response)) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::failedCodeExchange();
        }

        $response = HttpResponse::decodeContent($response);

        /** @var array{access_token?: string, scope?: string, refresh_token?: string, id_token?: string, expires_in?: int|string} $response */

        if (! isset($response['access_token']) || trim($response['access_token']) === '') {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::badAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['scope'])) {
            $this->setAccessTokenScope(explode(' ', $response['scope']));
        }

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['id_token'])) {
            if (! $this->getTransientStore()->isset('nonce')) {
                $this->clear();
                throw \Auth0\SDK\Exception\StateException::missingNonce();
            }

            $this->setIdToken($response['id_token']);
            $user = $this->decode($response['id_token'])->toArray();
        }

        if (isset($response['expires_in']) && is_numeric($response['expires_in'])) {
            $expiresIn = time() + (int) $response['expires_in'];
            $this->setAccessTokenExpiration($expiresIn);
        }

        if ($user === null || $this->configuration()->getQueryUserInfo()) {
            $response = $this->authentication()->userInfo($response['access_token']);

            if (HttpResponse::wasSuccessful($response)) {
                $user = HttpResponse::decodeContent($response);
            }
        }

        /** @var array<array<mixed>|int|string>|null $user */

        $this->setUser($user ?? []);
        $this->deferStateSaving(false);

        return true;
    }

    public function renew(
        ?array $params = null
    ): self {
        $this->deferStateSaving();
        $refreshToken = $this->getState()->getRefreshToken();

        if ($refreshToken === null) {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::failedRenewTokenMissingRefreshToken();
        }

        $response = $this->authentication()->refreshToken($refreshToken, $params);
        $response = HttpResponse::decodeContent($response);

        /** @var array{access_token?: string, scope?: string, refresh_token?: string, id_token?: string, expires_in?: int|string} $response */

        if (! isset($response['access_token']) || trim($response['access_token']) === '') {
            $this->clear();
            throw \Auth0\SDK\Exception\StateException::failedRenewTokenMissingAccessToken();
        }

        $this->setAccessToken($response['access_token']);

        if (isset($response['expires_in']) && is_numeric($response['expires_in'])) {
            $expiresIn = time() + (int) $response['expires_in'];
            $this->setAccessTokenExpiration($expiresIn);
        }

        if (isset($response['id_token'])) {
            $this->setIdToken($response['id_token']);
        }

        if (isset($response['refresh_token'])) {
            $this->setRefreshToken($response['refresh_token']);
        }

        if (isset($response['scope'])) {
            $this->setAccessTokenScope(explode(' ', $response['scope']));
        }

        $this->deferStateSaving(false);

        return $this;
    }

    public function getCredentials(): ?object
    {
        $user = $this->getState()->getUser();

        if ($user === null) {
            return null;
        }

        $idToken = $this->getState()->getIdToken();
        $accessToken = $this->getState()->getAccessToken();
        $accessTokenScope = $this->getState()->getAccessTokenScope();
        $accessTokenExpiration = (int) $this->getState()->getAccessTokenExpiration();
        $accessTokenExpired = time() >= $accessTokenExpiration;
        $refreshToken = $this->getState()->getRefreshToken();

        return (object) [
            'user' => $user,
            'idToken' => $idToken,
            'accessToken' => $accessToken,
            'accessTokenScope' => $accessTokenScope ?? [],
            'accessTokenExpiration' => $accessTokenExpiration,
            'accessTokenExpired' => $accessTokenExpired,
            'refreshToken' => $refreshToken,
        ];
    }

    public function getIdToken(): ?string
    {
        return $this->getState()->getIdToken();
    }

    public function getUser(): ?array
    {
        return $this->getState()->getUser();
    }

    public function getAccessToken(): ?string
    {
        return $this->getState()->getAccessToken();
    }

    public function getRefreshToken(): ?string
    {
        return $this->getState()->getRefreshToken();
    }

    public function getAccessTokenScope(): ?array
    {
        return $this->getState()->getAccessTokenScope();
    }

    public function getAccessTokenExpiration(): ?int
    {
        return $this->getState()->getAccessTokenExpiration();
    }

    public function getBearerToken(
        ?array $get = null,
        ?array $post = null,
        ?array $server = null,
        ?array $haystack = null,
        ?array $needles = null
    ): ?TokenInterface {
        if ($get !== null && count($get) >= 1 && count($_GET) >= 1) {
            foreach ($get as $parameterName) {
                if (isset($_GET[$parameterName]) && is_string($_GET[$parameterName])) {
                    $candidate = $this->processBearerToken($_GET[$parameterName]);

                    if ($candidate !== null) {
                        return $candidate;
                    }
                }
            }
        }

        if ($post !== null && count($post) >= 1 && count($_POST) >= 1) {
            foreach ($post as $parameterName) {
                if (isset($_POST[$parameterName]) && is_string($_POST[$parameterName])) {
                    $candidate = $this->processBearerToken($_POST[$parameterName]);

                    if ($candidate !== null) {
                        return $candidate;
                    }
                }
            }
        }

        if ($server !== null && count($server) >= 1 && count($_SERVER) >= 1) {
            foreach ($server as $parameterName) {
                if (isset($_SERVER[$parameterName]) && is_string($_SERVER[$parameterName])) {
                    $candidate = $this->processBearerToken($_SERVER[$parameterName]);

                    if ($candidate !== null) {
                        return $candidate;
                    }
                }
            }
        }

        if ($needles !== null && $haystack !== null && count($needles) >= 1 && count($haystack) >= 1) {
            foreach ($needles as $needle) {
                if (isset($haystack[$needle])) {
                    $candidate = $this->processBearerToken($haystack[$needle]);

                    if ($candidate !== null) {
                        return $candidate;
                    }
                }
            }
        }

        return null;
    }

    public function setIdToken(
        string $idToken
    ): self {
        $this->getState()->setIdToken($idToken);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistIdToken()) {
            $this->configuration()->getSessionStorage()->set('idToken', $idToken);
        }

        return $this;
    }

    public function setUser(
        array $user
    ): self {
        $this->getState()->setUser($user);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistUser()) {
            $this->configuration()->getSessionStorage()->set('user', $user);
        }

        return $this;
    }

    public function setAccessToken(
        string $accessToken
    ): self {
        $this->getState()->setAccessToken($accessToken);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessToken', $accessToken);
        }

        return $this;
    }

    public function setRefreshToken(
        string $refreshToken
    ): self {
        $this->getState()->setRefreshToken($refreshToken);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistRefreshToken()) {
            $this->configuration()->getSessionStorage()->set('refreshToken', $refreshToken);
        }

        return $this;
    }

    public function setAccessTokenScope(
        array $accessTokenScope
    ): self {
        $this->getState()->setAccessTokenScope($accessTokenScope);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessTokenScope', $accessTokenScope);
        }

        return $this;
    }

    public function setAccessTokenExpiration(
        int $accessTokenExpiration
    ): self {
        $this->getState()->setAccessTokenExpiration($accessTokenExpiration);

        if ($this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessTokenExpiration', $accessTokenExpiration);
        }

        return $this;
    }

    public function getRequestParameter(
        string $parameterName,
        int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        array $filterOptions = []
    ): ?string {
        $responseMode = $this->configuration()->getResponseMode();

        if ($responseMode === 'query' && isset($_GET[$parameterName])) {
            return filter_var(trim((string) $_GET[$parameterName]), $filter, $filterOptions);
        }

        if ($responseMode === 'form_post' && isset($_POST[$parameterName])) {
            return filter_var(trim((string) $_POST[$parameterName]), $filter, $filterOptions);
        }

        return null;
    }

    public function getExchangeParameters(): ?object
    {
        $code = $this->getRequestParameter('code');
        $state = $this->getRequestParameter('state');

        if ($code !== null && $state !== null) {
            return (object) [
                'code' => $code,
                'state' => $state,
            ];
        }

        return null;
    }

    public function getInvitationParameters(): ?array
    {
        $invite = $this->getRequestParameter('invitation');
        $orgId = $this->getRequestParameter('organization');
        $orgName = $this->getRequestParameter('organization_name');

        if ($invite !== null && $orgId !== null && $orgName !== null) {
            return [
                'invitation' => $invite,
                'organization' => $orgId,
                'organizationName' => $orgName,
            ];
        }

        return null;
    }

    /**
     * Create a transient storage handler using the configured transientStorage medium.
     */
    private function getTransientStore(): TransientStoreHandler
    {
        if ($this->transient === null) {
            $this->transient = new TransientStoreHandler($this->configuration()->getTransientStorage());
        }

        return $this->transient;
    }

    /**
     * Retrieve state from session storage and configure SDK state.
     */
    private function getState(): SdkState
    {
        if ($this->state === null) {
            $state = [];

            if ($this->configuration()->hasSessionStorage()) {
                if ($this->configuration()->getPersistUser()) {
                    $state['user'] = $this->configuration()->getSessionStorage()->get('user');
                }

                if ($this->configuration()->getPersistIdToken()) {
                    $state['idToken'] = $this->configuration()->getSessionStorage()->get('idToken');
                }

                if ($this->configuration()->getPersistAccessToken()) {
                    $state['accessToken'] = $this->configuration()->getSessionStorage()->get('accessToken');
                    $state['accessTokenScope'] = $this->configuration()->getSessionStorage()->get('accessTokenScope');

                    $expires = $this->configuration()->getSessionStorage()->get('accessTokenExpiration');

                    /** @var int|string|null $expires */

                    if ($expires !== null) {
                        $state['accessTokenExpiration'] = (int) $expires;
                    }
                }

                if ($this->configuration()->getPersistRefreshToken()) {
                    $state['refreshToken'] = $this->configuration()->getSessionStorage()->get('refreshToken');
                }
            }

            $this->state = new SdkState($state);
        }

        return $this->state;
    }

    /**
     * Defer saving transient or session states to destination medium.
     * Improves performance during large blocks of changes.
     *
     * @param bool $deferring Whether to defer persisting the storage state.
     */
    private function deferStateSaving(
        bool $deferring = true
    ): self {
        if ($this->configuration()->hasSessionStorage()) {
            $this->configuration()->getSessionStorage()->defer($deferring);
        }

        if ($this->configuration()->hasTransientStorage()) {
            $this->configuration()->getTransientStorage()->defer($deferring);
        }

        return $this;
    }

    private function processBearerToken(
        string $token
    ): ?TokenInterface {
        $token = trim($token);
        $token = substr($token, 0, 7) === 'Bearer ' ? trim(substr($token, 7)) : $token;

        if (strlen($token) >= 1) {
            try {
                return $this->decode($token, null, null, null, null, null, null, \Auth0\SDK\Token::TYPE_TOKEN);
            } catch (\Auth0\SDK\Exception\InvalidTokenException $exception) {
                return null;
            }
        }

        return null;
    }
}
