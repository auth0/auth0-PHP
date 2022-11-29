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
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Utility\HttpResponse;
use Auth0\SDK\Utility\PKCE;
use Auth0\SDK\Utility\Toolkit;
use Auth0\SDK\Utility\TransientStoreHandler;

/**
 * Class Auth0.
 */
final class Auth0 implements Auth0Interface
{
    public const VERSION = '8.3.8';

    /**
     * Instance of SdkConfiguration, for shared configuration across classes.
     */
    private ?SdkConfiguration $validatedConfiguration = null;

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
     * @param  array<mixed>|SdkConfiguration  $configuration  Required. Base configuration options for the SDK. See the SdkConfiguration class constructor for options.
     */
    public function __construct(
        private SdkConfiguration|array $configuration,
    ) {
    }

    public function authentication(): AuthenticationInterface
    {
        if (null === $this->authentication) {
            $this->authentication = new Authentication($this->configuration());
        }

        return $this->authentication;
    }

    public function management(): ManagementInterface
    {
        if (null === $this->management) {
            $this->management = new Management($this->configuration());
        }

        return $this->management;
    }

    public function configuration(): SdkConfiguration
    {
        if (null === $this->validatedConfiguration) {
            if (\is_array($this->configuration)) {
                return $this->validatedConfiguration = new SdkConfiguration($this->configuration);
            }

            return $this->validatedConfiguration = $this->configuration;
        }

        return $this->validatedConfiguration;
    }

    public function login(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): string {
        $this->deferStateSaving();

        $store = $this->getTransientStore(true);

        if (! $this->configuration()->usingStatefulness() || ! $store instanceof TransientStoreHandler) {
            throw ConfigurationException::requiresStatefulness('Auth0->login()');
        }

        $params ??= [];
        $state = $params['state'] ?? $store->getNonce();
        $params['nonce'] ??= $store->getNonce();
        $params['max_age'] ??= $this->configuration()->getTokenMaxAge();

        if ($this->configuration()->getUsePkce()) {
            $codeVerifier = PKCE::generateCodeVerifier(128);
            $params['code_challenge'] = PKCE::generateCodeChallenge($codeVerifier);
            $params['code_challenge_method'] = 'S256';

            $store->store('code_verifier', $codeVerifier);
        }

        $store->store('state', (string) $state);
        $store->store('nonce', (string) $params['nonce']);

        if (null !== $params['max_age']) {
            $store->store('max_age', (string) $params['max_age']);
        }

        unset($params['state']);

        $this->deferStateSaving(false);

        return $this->authentication()->getLoginLink((string) $state, $redirectUrl, $params);
    }

    public function signup(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): string {
        if (! $this->configuration()->usingStatefulness()) {
            throw ConfigurationException::requiresStatefulness('Auth0->signup()');
        }

        $params = Toolkit::merge([
            'screen_hint' => 'signup',
        ], $params);

        /** @var array<int|string|null>|null $params */

        return $this->login($redirectUrl, $params);
    }

    public function handleInvitation(
        ?string $redirectUrl = null,
        ?array $params = null,
    ): ?string {
        if (! $this->configuration()->usingStatefulness()) {
            throw ConfigurationException::requiresStatefulness('Auth0->handleInvitation()');
        }

        $invite = $this->getInvitationParameters();

        if (null !== $invite) {
            $params = Toolkit::merge([
                'invitation'   => $invite['invitation'],
                'organization' => $invite['organization'],
            ], $params);

            /** @var array<int|string|null>|null $params */

            return $this->login($redirectUrl, $params);
        }

        return null;
    }

    public function logout(
        ?string $returnUri = null,
        ?array $params = null,
    ): string {
        if (! $this->configuration()->usingStatefulness()) {
            throw ConfigurationException::requiresStatefulness('Auth0->logout()');
        }

        $this->clear();

        return $this->authentication()->getLogoutLink($returnUri, $params);
    }

    public function clear(
        bool $transient = true,
    ): self {
        if ($this->configuration()->usingStatefulness()) {
            $this->deferStateSaving();

            // Delete all data in the session storage medium.
            if ($this->configuration()->hasSessionStorage()) {
                $this->configuration()->getSessionStorage()->purge();
            }

            // Delete all data in the transient storage medium.
            if ($this->configuration()->hasTransientStorage() && $transient) {
                $this->configuration()->getTransientStorage()->purge();
            }

            // If state saving had been deferred, disable it and force a update to persistent storage.
            $this->deferStateSaving(false);
        }

        // Reset the internal state.
        $this->getState(true);

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
        ?int $tokenType = null,
    ): TokenInterface {
        $store = $this->getTransientStore();

        $tokenType ??= Token::TYPE_ID_TOKEN;
        $tokenNonce ??= $store?->getOnce('nonce') ?? null;
        $tokenMaxAge ??= $store?->getOnce('max_age') ?? null;
        $tokenIssuer = null;

        // If pulled from transient storage, $tokenMaxAge might be a string.
        if (null !== $tokenMaxAge) {
            $tokenMaxAge = (int) $tokenMaxAge;
        }

        $token = new Token($this->configuration(), $token, $tokenType);

        $token->
            verify()->
            validate(
                $tokenIssuer,
                $tokenAudience,
                $tokenOrganization,
                $tokenNonce,
                $tokenMaxAge,
                $tokenLeeway,
                $tokenNow,
            );

        // Ensure transient-stored values are cleared, even if overriding values were passed to the  method.
        if ($this->configuration()->usingStatefulness() && $store instanceof TransientStoreHandler) {
            $store->delete('max_age');
            $store->delete('nonce');
        }

        return $token;
    }

    public function exchange(
        ?string $redirectUri = null,
        ?string $code = null,
        ?string $state = null,
    ): bool {
        $store = $this->getTransientStore();

        if (! $this->configuration()->usingStatefulness() || ! $store instanceof TransientStoreHandler) {
            throw ConfigurationException::requiresStatefulness('Auth0->exchange()');
        }

        [$redirectUri, $code, $state] = Toolkit::filter([$redirectUri, $code, $state])->string()->trim();

        $code ??= $this->getRequestParameter('code');
        $state ??= $this->getRequestParameter('state');
        $pkce = $store->getOnce('code_verifier');
        $nonce = $store->isset('nonce');
        $verified = (null !== $state ? $store->verify('state', $state) : false);

        $user = null;

        $this->clear(false);
        $this->deferStateSaving();

        if (null === $code) {
            $this->clear();

            throw \Auth0\SDK\Exception\StateException::missingCode();
        }

        if (null === $state || ! $verified) {
            $this->clear();

            throw \Auth0\SDK\Exception\StateException::invalidState();
        }

        if (null === $pkce && $this->configuration()->getUsePkce()) {
            $this->clear();

            throw \Auth0\SDK\Exception\StateException::missingCodeVerifier();
        }

        $response = $this->authentication()->codeExchange($code, $redirectUri, $pkce);

        if (! HttpResponse::wasSuccessful($response)) {
            $this->clear();

            throw \Auth0\SDK\Exception\StateException::failedCodeExchange();
        }

        $response = HttpResponse::decodeContent($response);

        /** @var array{access_token?: string, scope?: string, refresh_token?: string, id_token?: string, expires_in?: int|string} $response */
        if (isset($response['id_token'])) {
            if (! $nonce) {
                $this->clear();

                throw \Auth0\SDK\Exception\StateException::missingNonce();
            }

            try {
                $user = $this->decode($response['id_token'])->toArray();
                $this->setIdToken($response['id_token']);
            } catch (\Throwable $tokenException) {
                $this->clear();

                throw $tokenException;
            }
        }

        if (! isset($response['access_token']) || '' === trim($response['access_token'])) {
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

        if (isset($response['expires_in']) && is_numeric($response['expires_in'])) {
            $expiresIn = time() + (int) $response['expires_in'];
            $this->setAccessTokenExpiration($expiresIn);
        }

        if (null === $user || $this->configuration()->getQueryUserInfo()) {
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
        ?array $params = null,
    ): self {
        $this->deferStateSaving();
        $refreshToken = $this->getState()->getRefreshToken();

        if (null === $refreshToken) {
            $this->clear();

            throw \Auth0\SDK\Exception\StateException::failedRenewTokenMissingRefreshToken();
        }

        $response = $this->authentication()->refreshToken($refreshToken, $params);
        $response = HttpResponse::decodeContent($response);

        /** @var array{access_token?: string, scope?: string, refresh_token?: string, id_token?: string, expires_in?: int|string} $response */
        if (! isset($response['access_token']) || '' === trim($response['access_token'])) {
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

        if (null === $user) {
            return null;
        }

        $idToken = $this->getState()->getIdToken();
        $accessToken = $this->getState()->getAccessToken();
        $accessTokenScope = $this->getState()->getAccessTokenScope();
        $accessTokenExpiration = (int) $this->getState()->getAccessTokenExpiration();
        $accessTokenExpired = time() >= $accessTokenExpiration;
        $refreshToken = $this->getState()->getRefreshToken();

        return (object) [
            'user'                  => $user,
            'idToken'               => $idToken,
            'accessToken'           => $accessToken,
            'accessTokenScope'      => $accessTokenScope ?? [],
            'accessTokenExpiration' => $accessTokenExpiration,
            'accessTokenExpired'    => $accessTokenExpired,
            'refreshToken'          => $refreshToken,
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
        ?array $needles = null,
    ): ?TokenInterface {
        if (null !== $get && \count($get) >= 1 && \count($_GET) >= 1) {
            foreach ($get as $parameterName) {
                if (isset($_GET[$parameterName]) && \is_string($_GET[$parameterName])) {
                    $candidate = $this->processBearerToken($_GET[$parameterName]);

                    if (null !== $candidate) {
                        return $candidate;
                    }
                }
            }
        }

        if (null !== $post && \count($post) >= 1 && \count($_POST) >= 1) {
            foreach ($post as $parameterName) {
                if (isset($_POST[$parameterName]) && \is_string($_POST[$parameterName])) {
                    $candidate = $this->processBearerToken($_POST[$parameterName]);

                    if (null !== $candidate) {
                        return $candidate;
                    }
                }
            }
        }

        if (null !== $server && \count($server) >= 1 && \count($_SERVER) >= 1) {
            foreach ($server as $parameterName) {
                if (isset($_SERVER[$parameterName]) && \is_string($_SERVER[$parameterName])) {
                    $candidate = $this->processBearerToken($_SERVER[$parameterName]);

                    if (null !== $candidate) {
                        return $candidate;
                    }
                }
            }
        }

        if (null !== $needles && null !== $haystack && \count($needles) >= 1 && \count($haystack) >= 1) {
            foreach ($needles as $needle) {
                if (isset($haystack[$needle])) {
                    $candidate = $this->processBearerToken($haystack[$needle]);

                    if (null !== $candidate) {
                        return $candidate;
                    }
                }
            }
        }

        return null;
    }

    public function setIdToken(
        string $idToken,
    ): self {
        $this->getState()->setIdToken($idToken);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistIdToken()) {
            $this->configuration()->getSessionStorage()->set('idToken', $idToken);
        }

        return $this;
    }

    public function setUser(
        array $user,
    ): self {
        $this->getState()->setUser($user);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistUser()) {
            $this->configuration()->getSessionStorage()->set('user', $user);
        }

        return $this;
    }

    public function setAccessToken(
        string $accessToken,
    ): self {
        $this->getState()->setAccessToken($accessToken);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessToken', $accessToken);
        }

        return $this;
    }

    public function setRefreshToken(
        string $refreshToken,
    ): self {
        $this->getState()->setRefreshToken($refreshToken);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistRefreshToken()) {
            $this->configuration()->getSessionStorage()->set('refreshToken', $refreshToken);
        }

        return $this;
    }

    public function setAccessTokenScope(
        array $accessTokenScope,
    ): self {
        $this->getState()->setAccessTokenScope($accessTokenScope);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessTokenScope', $accessTokenScope);
        }

        return $this;
    }

    public function setAccessTokenExpiration(
        int $accessTokenExpiration,
    ): self {
        $this->getState()->setAccessTokenExpiration($accessTokenExpiration);

        if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage() && $this->configuration()->getPersistAccessToken()) {
            $this->configuration()->getSessionStorage()->set('accessTokenExpiration', $accessTokenExpiration);
        }

        return $this;
    }

    public function getRequestParameter(
        string $parameterName,
        int $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        array $filterOptions = [],
    ): ?string {
        $responseMode = $this->configuration()->getResponseMode();

        // @phpstan-ignore-next-line
        if (isset($_GET) && [] !== $_GET && ('query' === $responseMode && isset($_GET[$parameterName]) && \is_string($_GET[$parameterName]))) {
            return filter_var(trim($_GET[$parameterName]), $filter, $filterOptions);
        }

        // @phpstan-ignore-next-line
        if (isset($_POST) && [] !== $_POST && ('form_post' === $responseMode && isset($_POST[$parameterName]) && \is_string($_POST[$parameterName]))) {
            return filter_var(trim($_POST[$parameterName]), $filter, $filterOptions);
        }

        return null;
    }

    public function getExchangeParameters(): ?object
    {
        $code = $this->getRequestParameter('code');
        $state = $this->getRequestParameter('state');

        if (null !== $code && null !== $state) {
            return (object) [
                'code'  => $code,
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

        if (null !== $invite && null !== $orgId && null !== $orgName) {
            return [
                'invitation'       => $invite,
                'organization'     => $orgId,
                'organizationName' => $orgName,
            ];
        }

        return null;
    }

    /**
     * Create a transient storage handler using the configured transientStorage medium.
     */
    private function getTransientStore(bool $reset = false): ?TransientStoreHandler
    {
        if ((null === $this->transient || $reset) && ($this->configuration()->usingStatefulness() && null !== $this->configuration()->getTransientStorage())) {
            $this->transient = new TransientStoreHandler($this->configuration()->getTransientStorage());
        }

        return $this->transient;
    }

    /**
     * Retrieve state from session storage and configure SDK state.
     */
    private function getState(bool $reset = false): SdkState
    {
        if (null === $this->state || $reset) {
            $state = [];

            if ($this->configuration()->usingStatefulness() && $this->configuration()->hasSessionStorage()) {
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
                    if (null !== $expires) {
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
     * @param  bool  $deferring  whether to defer persisting the storage state
     */
    private function deferStateSaving(
        bool $deferring = true,
    ): self {
        if ($this->configuration()->usingStatefulness()) {
            if ($this->configuration()->hasSessionStorage()) {
                $this->configuration()->getSessionStorage()->defer($deferring);
            }

            if ($this->configuration()->hasTransientStorage()) {
                $this->configuration()->getTransientStorage()->defer($deferring);
            }
        }

        return $this;
    }

    private function processBearerToken(
        string $token,
    ): ?TokenInterface {
        $token = trim($token);
        $token = 'Bearer ' === mb_substr($token, 0, 7) ? trim(mb_substr($token, 7)) : $token;

        if ('' !== $token) {
            try {
                return $this->decode($token, null, null, null, null, null, null, \Auth0\SDK\Token::TYPE_TOKEN);
            } catch (\Auth0\SDK\Exception\InvalidTokenException $exception) {
                return null;
            }
        }

        return null;
    }
}
