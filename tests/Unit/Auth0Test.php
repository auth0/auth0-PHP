<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit;

use Auth0\SDK\Auth0;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Store\SessionStore;
use Auth0\SDK\Utility\Shortcut;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\TokenGenerator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

/**
 * Class Auth0Test.
 */
class Auth0Test extends TestCase
{
    /**
     * Basic Auth0 class config options.
     */
    public static array $baseConfig;

    /**
     * Runs before each test begins.
     */
    public function setUp(): void
    {
        parent::setUp();

        self::$baseConfig = [
            'domain' => '__test_domain__',
            'clientId' => '__test_client_id__',
            'clientSecret' => '__test_client_secret__',
            'redirectUri' => '__test_redirect_uri__',
            'transientStorage' => new SessionStore(),
        ];

        if (! session_id()) {
            session_start();
        }
    }

    /**
     * Runs after each test completes.
     */
    public function tearDown(): void
    {
        parent::tearDown();
        $_GET = [];
        $_SESSION = [];
    }

    /**
     * Test that the exchange call returns false before making any HTTP calls if no code is present.
     */
    public function testThatExchangeReturnsFalseIfNoCodePresent(): void
    {
        $auth0 = new Auth0(self::$baseConfig);
        $this->assertFalse($auth0->exchange());
    }

    /**
     * Test that the exchanges fails when there is not a stored nonce value.
     */
    public function testThatExchangeFailsWithNoStoredNonce(): void
    {
        $token = (new TokenGenerator())->withHs256();

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $httpClient = $auth0->authentication()->getHttpClient();
        $httpClient->mockResponse(HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6"}'));

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->expectException(\Auth0\SDK\Exception\StateException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_MISSING_NONCE);
        $auth0->exchange();
    }

    /**
     * Test that the exchanges fails when there is not a stored nonce value.
     */
    public function testThatExchangeFailsWhenPkceIsEnabledAndNoCodeVerifierWasFound(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = null;

        $this->expectException(\Auth0\SDK\Exception\StateException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_MISSING_CODE_VERIFIER);
        $auth0->exchange();
    }

    /**
     * Test that the exchanges succeeds when there is both and access token and an ID token present.
     */
    public function testThatExchangeSucceedsWithIdToken(): void
    {
        $token = (new TokenGenerator())->withHs256();

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6"}'),
            HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());
        $this->assertArrayHasKey('sub', $auth0->getUser());
        $this->assertEquals('__test_sub__', $auth0->getUser()['sub']);
        $this->assertEquals($token, $auth0->getIdToken());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the exchanges succeeds when there is only an access token.
     */
    public function testThatExchangeSucceedsWithNoIdToken(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            HttpResponseGenerator::create('{"sub":"123"}')
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());
        $this->assertArrayHasKey('sub', $auth0->getUser());
        $this->assertEquals('123', $auth0->getUser()['sub']);
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the exchanges succeeds when PKCE is enabled.
     */
    public function testThatExchangeSucceedsWithPkceEnabled(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());
        $this->assertEquals(['sub' => '__test_sub__'], $auth0->getUser());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the exchanges succeeds when PKCE is disabled.
     */
    public function testThatExchangeSucceedsWithoutPkceEnabled(): void
    {
        $auth0 = new Auth0(self::$baseConfig + [
            'usePkce' => false,
        ]);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());
        $this->assertEquals(['sub' => '__test_sub__'], $auth0->getUser());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the skip_userinfo config option uses the ID token instead of calling /userinfo.
     */
    public function testThatExchangeSkipsUserinfo(): void
    {
        $token = (new TokenGenerator())->withHs256();

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '"}'),
            HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());
        $this->assertEquals('__test_sub__', $auth0->getUser()['sub']);
        $this->assertEquals($token, $auth0->getIdToken());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
    }

    /**
     * Test that renew() fails if there is no refresh_token stored.
     */
    public function testThatRenewTokensFailsIfThereIsNoRefreshToken(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3"}'),
            HttpResponseGenerator::create('{}')
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());

        $this->expectException(\Auth0\SDK\Exception\StateException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN);

        $auth0->renew();
    }

    /**
     * Test that renew() fails if the API response is invalid.
     */
    public function testThatRenewTokensFailsIfNoAccessTokenReturned(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4"}'),
            HttpResponseGenerator::create('{}'),
            HttpResponseGenerator::create('{}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());

        $this->expectException(\Auth0\SDK\Exception\StateException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN);

        $auth0->renew();
    }

    /**
     * Test that renew() succeeds with non-empty access_token and refresh_token stored.
     */
    public function testThatRenewTokensSucceeds(): void
    {
        $token = (new TokenGenerator())->withHs256();

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $httpClient = $auth0->authentication()->getHttpClient();

        $httpClient->mockResponses([
            HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4","id_token":"' . $token . '"}'),
            HttpResponseGenerator::create('{"access_token":"__test_access_token__","id_token":"' . $token . '"}'),
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = '__test_code_verifier__';

        $this->assertTrue($auth0->exchange());

        $this->assertArrayNotHasKey('auth0_nonce', $_SESSION);
        $this->assertArrayNotHasKey('auth0_state', $_SESSION);

        $auth0->renew(['scope' => 'openid']);
        $request = $httpClient->getLastRequest()->getLastRequest();
        parse_str($request->getBody()->__toString(), $requestBody);

        $this->assertEquals('__test_access_token__', $auth0->getAccessToken());
        $this->assertEquals($token, $auth0->getIdToken());

        $this->assertEquals('openid', $requestBody['scope']);
        $this->assertEquals('__test_client_secret__', $requestBody['client_secret']);
        $this->assertEquals('__test_client_id__', $requestBody['client_id']);
        $this->assertEquals('2.3.4', $requestBody['refresh_token']);
        $this->assertEquals('https://__test_domain__/oauth/token', $request->getUri()->__toString());
    }

    /**
     * Test that get login url uses default values.
     */
    public function testThatGetLoginUrlUsesDefaultValues(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $parsed_url = parse_url($auth0->authentication()->getLoginLink());

        $this->assertEquals('https', $parsed_url['scheme']);
        $this->assertEquals('__test_domain__', $parsed_url['host']);
        $this->assertEquals('/authorize', $parsed_url['path']);

        $url_query = explode('&', $parsed_url['query']);

        $this->assertContains('scope=openid%20profile%20email', $url_query);
        $this->assertContains('response_type=code', $url_query);
        $this->assertContains('redirect_uri=__test_redirect_uri__', $url_query);
        $this->assertContains('client_id=__test_client_id__', $url_query);
    }

    /**
     * Test that get login url adds values.
     */
    public function testThatGetLoginUrlAddsValues(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $custom_params = [
            'connection' => '__test_connection__',
            'prompt' => 'none',
            'audience' => '__test_audience__',
            'state' => '__test_state__',
            'invitation' => '__test_invitation__',
        ];

        $auth_url = $auth0->authentication()->getLoginLink($custom_params);
        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertContains('redirect_uri=__test_redirect_uri__', $url_query);
        $this->assertContains('client_id=__test_client_id__', $url_query);
        $this->assertContains('connection=__test_connection__', $url_query);
        $this->assertContains('prompt=none', $url_query);
        $this->assertContains('audience=__test_audience__', $url_query);
        $this->assertContains('state=__test_state__', $url_query);
        $this->assertContains('invitation=__test_invitation__', $url_query);
    }

    /**
     * Test that get login url overrides default values.
     */
    public function testThatGetLoginUrlOverridesDefaultValues(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $override_params = [
            'scope' => 'openid profile email',
            'response_type' => 'id_token',
            'response_mode' => 'form_post',
        ];

        $auth_url = $auth0->authentication()->getLoginLink($override_params);
        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertContains('scope=openid%20profile%20email', $url_query);
        $this->assertContains('response_type=id_token', $url_query);
        $this->assertContains('response_mode=form_post', $url_query);
        $this->assertContains('redirect_uri=__test_redirect_uri__', $url_query);
        $this->assertContains('client_id=__test_client_id__', $url_query);
    }

    /**
     * Test that get login url generates state and nonce.
     */
    public function testThatGetLoginUrlGeneratesStateAndNonce(): void
    {
        $custom_config = self::$baseConfig;

        $auth0 = new Auth0($custom_config);

        $auth_url = $auth0->authentication()->getLoginLink();

        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertArrayHasKey('auth0_state', $_SESSION);
        $this->assertContains('state=' . $_SESSION['auth0_state'], $url_query);
        $this->assertArrayHasKey('auth0_nonce', $_SESSION);
        $this->assertContains('nonce=' . $_SESSION['auth0_nonce'], $url_query);
    }

    /**
     * Test that get login url generates challenge and challenge method when PKCE is enabled.
     */
    public function testThatGetLoginUrlGeneratesChallengeAndChallengeMethodWhenPkceIsEnabled(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $auth_url = $auth0->authentication()->getLoginLink();

        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertArrayHasKey('auth0_code_verifier', $_SESSION);
        $this->assertStringContainsString('code_challenge=', $parsed_url_query);
        $this->assertContains('code_challenge_method=S256', $url_query);
    }

    /**
     * Test that invitation parameters are extracted.
     */
    public function testThatInvitationParametersAreExtracted(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $_GET['invitation'] = '__test_invitation__';
        $_GET['organization'] = '__test_organization__';
        $_GET['organization_name'] = '__test_organization_name__';

        $extracted = $auth0->getInvitationParameters();

        $this->assertIsObject($extracted, 'Invitation parameters were not extracted from the $_GET (environment variable seeded with query parameters during a GET request) successfully.');

        $this->assertObjectHasAttribute('invitation', $extracted);
        $this->assertObjectHasAttribute('organization', $extracted);
        $this->assertObjectHasAttribute('organizationName', $extracted);

        $this->assertEquals($extracted->invitation, '__test_invitation__');
        $this->assertEquals($extracted->organization, '__test_organization__');
        $this->assertEquals($extracted->organizationName, '__test_organization_name__');
    }

    /**
     * Test that invitation parameters aren't extracted when incomplete..
     */
    public function testThatInvitationParametersArentExtractedWhenIncomplete(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $_GET['invitation'] = '__test_invitation__';

        $extracted = $auth0->getInvitationParameters();

        $this->assertIsNotObject($extracted);
    }

    /**
     * Test that max age is set in login url from initial config.
     */
    public function testThatMaxAgeIsSetInLoginUrlFromInitialConfig(): void
    {
        $auth0 = new Auth0(self::$baseConfig + [
            'tokenMaxAge' => 1000,
        ]);

        $auth_url = $auth0->authentication()->getLoginLink();

        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertContains('max_age=1000', $url_query);
        $this->assertArrayHasKey('auth0_max_age', $_SESSION);
        $this->assertEquals(1000, $_SESSION['auth0_max_age']);
    }

    /**
     * Test that max age is overridden in login url.
     */
    public function testThatMaxAgeIsOverriddenInLoginUrl(): void
    {
        $auth0 = new Auth0(self::$baseConfig + [
            'tokenMaxAge' => 1000,
        ]);

        $auth_url = $auth0->authentication()->getLoginLink([
            'max_age' => 1001,
        ]);

        $parsed_url_query = parse_url($auth_url, PHP_URL_QUERY);
        $url_query = explode('&', $parsed_url_query);

        $this->assertContains('max_age=1001', $url_query);
        $this->assertArrayHasKey('auth0_max_age', $_SESSION);
        $this->assertEquals('1001', $_SESSION['auth0_max_age']);
    }

    /**
     * Test that ID Token is persisted when set.
     */
    public function testThatIdTokenIsPersistedWhenSet(): void
    {
        $token = (new TokenGenerator())->withHs256();
        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_max_age'] = 1000;

        $auth0->setIdToken($token);

        $this->assertEquals($token, $auth0->getIdToken());
        $this->assertEquals($token, $_SESSION['auth0_idToken']);
    }

    /**
     * Test that ID Token nonce is checked when set.
     */
    public function testThatIdTokenNonceIsCheckedWhenSet(): void
    {
        $token = (new TokenGenerator())->withHs256();
        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
        ]);

        $_SESSION['auth0_nonce'] = '__invalid_nonce__';

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_NONCE_CLAIM, '__invalid_nonce__', '__test_nonce__'));

        $auth0->setIdToken($token);
    }

    /**
     * Test that ID Token auth time is checked when set.
     */
    public function testThatIdTokenAuthTimeIsCheckedWhenSet(): void
    {
        $now = time();
        $maxAge = 10;
        $drift = 100;

        $token = (new TokenGenerator())->withHs256([
            'auth_time' => $now - $drift,
        ]);

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
            'tokenMaxAge' => $maxAge,
            'tokenLeeway' => 0,
        ]);

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_AUTH_TIME_CLAIM, time(), $now - $drift + $maxAge));

        $auth0->decode($token, null, null, null, null, null, $now);
    }

    /**
     * Test that ID Token Organization is checked when set.
     */
    public function testThatIdTokenOrganizationIsCheckedWhenSet(): void
    {
        $token = (new TokenGenerator())->withHs256();
        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
            'organization' => ['org8675309'],
        ]);

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ORG_ID_CLAIM);

        $auth0->setIdToken($token);
    }

    /**
     * Test that ID Token Organization is successful when matched.
     */
    public function testThatIdTokenOrganizationSuccessWhenMatched(): void
    {
        $orgId = 'org8675309';

        $token = (new TokenGenerator())->withHs256([
            'org_id' => $orgId,
        ]);

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
            'organization' => [$orgId],
        ]);

        $decoded = $auth0->decode($token);

        $this->assertEquals($orgId, $decoded->getOrganization());
    }

    /**
     * Test that ID Token Organization fails when mismatched.
     */
    public function testThatIdTokenOrganizationFailsWhenMismatched(): void
    {
        $expectedOrgId = uniqid();
        $tokenOrgId = uniqid();

        $token = (new TokenGenerator())->withHs256([
            'org_id' => $tokenOrgId,
        ]);

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
            'organization' => [$expectedOrgId],
        ]);

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_ORG_ID_CLAIM, $expectedOrgId, $tokenOrgId));

        $auth0->setIdToken($token);
    }

    /**
     * Test that ID Token leeway from constructor is used.
     */
    public function testThatIdTokenLeewayFromConstructorIsUsed(): void
    {
        $token = (new TokenGenerator())->withHs256([
            'exp' => time() - 100,
        ]);

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenAlgorithm' => 'HS256',
            'tokenLeeway' => 120,
        ]);

        $auth0->setIdToken($token);
        $this->assertEquals($token, $auth0->getIdToken());
    }

    /**
     * Test that cache handler can be set.
     */
    public function testThatCacheHandlerCanBeSet(): void
    {
        $cacheKey = hash('sha256', 'https://test.auth0.com/.well-known/jwks.json');
        $mockJwks = [
            '__test_kid__' => [
                'x5c' => ['123'],
            ],
        ];

        $pool = new ArrayAdapter();
        $item = $pool->getItem($cacheKey);
        $item->set($mockJwks);
        $pool->save($item);

        $auth0 = new Auth0(self::$baseConfig + [
            'tokenCache' => $pool,
        ]);

        $cachedJwks = $pool->getItem($cacheKey)->get();
        $this->assertNotEmpty($cachedJwks);
        $this->assertArrayHasKey('__test_kid__', $cachedJwks);
        $this->assertEquals($mockJwks, $cachedJwks);

        // Ignore that we can't verify using this mock cert, just that it was attempted.
        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Cannot verify signature');

        $auth0->setIdToken((new TokenGenerator())->withRs256([], null, ['kid' => '__test_kid__']));
    }

    /**
     * Test that passed in store interface is used.
     */
    public function testThatPassedInStoreInterfaceIsUsed(): void
    {
        $storeMock = new class () implements StoreInterface {
            /**
             * Example of an empty store.
             *
             * @param string      $key     An example key.
             * @param string|null $default An example default value.
             *
             * @return mixed
             */
            public function get(
                string $key,
                ?string $default = null
            ) {
                $response = '__test_custom_store__' . $key . '__';

                if ($key === 'user') {
                    return [ $response ];
                }

                return $response;
            }

            public function set(
                string $key,
                $value
            ): void {
            }

            public function delete(
                string $key
            ): void {
            }
        };

        $auth0 = new Auth0(self::$baseConfig + ['sessionStorage' => $storeMock]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['sessionStorage' => $storeMock]);
        $this->assertEquals(['__test_custom_store__user__'], $auth0->getUser());
    }

    /**
     * Test that session store is used as default.
     */
    public function testThatSessionStoreIsUsedAsDefault(): void
    {
        $auth0 = new Auth0(self::$baseConfig);
        $auth0->setUser(['sub' => '__test_user__']);

        $this->assertEquals($_SESSION['auth0_user'], $auth0->getUser());
    }

    /**
     * Test that cookie store is used as default transient.
     */
    public function testThatCookieStoreIsUsedAsDefaultTransient(): void
    {
        $config = self::$baseConfig;
        unset($config['transientStorage']);
        $auth0 = new Auth0(Shortcut::filterArray($config));
        $auth0->authentication()->getLoginLink(['nonce' => '__test_cookie_nonce__']);

        $this->assertEquals('__test_cookie_nonce__', $_COOKIE['auth0_nonce']);
    }

    /**
     * Test that transient can be set to another store interface.
     */
    public function testThatTransientCanBeSetToAnotherStoreInterface(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['transientStorage' => new SessionStore()]);
        $auth0->authentication()->getLoginLink(['nonce' => '__test_session_nonce__']);

        $this->assertEquals('__test_session_nonce__', $_SESSION['auth0_nonce']);
    }

    /**
     * Test that no user persistence uses empty store.
     */
    public function testThatNoUserPersistenceWorks(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['persistUser' => false]);
        $auth0->setUser(['sub' => '__test_user__']);

        $auth0 = new Auth0(self::$baseConfig + ['persistUser' => false]);
        $this->assertNull($auth0->getUser());
    }
}
