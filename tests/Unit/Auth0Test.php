<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit;

use Auth0\SDK\Auth0;
use Auth0\SDK\Store\SessionStore;
use Auth0\Tests\Utilities\TokenGenerator;
use Cache\Adapter\PHPArray\ArrayCachePool;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

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
     * Default request headers.
     */
    protected static array $headers = ['content-type' => 'json'];

    /**
     * Runs after each test completes.
     */
    public function setUp(): void
    {
        parent::setUp();

        self::$baseConfig = [
            'domain' => '__test_domain__',
            'client_id' => '__test_client_id__',
            'client_secret' => '__test_client_secret__',
            'redirect_uri' => '__test_redirect_uri__',
            'store' => false,
            'transient_store' => new SessionStore(),
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
        $id_token = (new TokenGenerator())->withHs256();

        $response_body = '{"access_token":"1.2.3","id_token":"' . $id_token . '","refresh_token":"4.5.6"}';

        $mock = new MockHandler([new Response(200, self::$headers, $response_body)]);

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => true,
            'id_token_alg' => 'HS256',
            'guzzle_options' => [
                'handler' => HandlerStack::create($mock),
            ],
        ]);
        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->expectExceptionMessage('Nonce value not found in application store');
        $auth0->exchange();
    }

    /**
     * Test that the exchanges fails when there is not a stored nonce value.
     */
    public function testThatExchangeFailsWhenPkceIsEnabledAndNoCodeVerifierWasFound(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['enable_pkce' => true]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';
        $_SESSION['auth0_code_verifier'] = null;

        $this->expectException(\Auth0\SDK\Exception\CoreException::class);
        $this->expectExceptionMessage('Missing code_verifier');
        $auth0->exchange();
    }

    /**
     * Test that the exchanges succeeds when there is both and access token and an ID token present.
     */
    public function testThatExchangeSucceedsWithIdToken(): void
    {
        $id_token = (new TokenGenerator())->withHs256();
        $response_body = '{"access_token":"1.2.3","id_token":"' . $id_token . '","refresh_token":"4.5.6"}';

        $mock = new MockHandler(
            [
                new Response(200, self::$headers, $response_body),
                new Response(200, self::$headers, json_encode(['sub' => '__test_sub__'])),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => false,
            'id_token_alg' => 'HS256',
            'guzzle_options' => [
                'handler' => HandlerStack::create($mock),
            ],
        ]);

        $_GET['code'] = uniqid();
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());
        $this->assertEquals(['sub' => '__test_sub__'], $auth0->getUser());
        $this->assertEquals($id_token, $auth0->getIdToken());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the exchanges succeeds when there is only an access token.
     */
    public function testThatExchangeSucceedsWithNoIdToken(): void
    {
        $mock = new MockHandler(
            [
            // Code exchange response.
            // Respond with no ID token, access token with correct number of segments.
                new Response(200, self::$headers, '{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            // Userinfo response.
                new Response(200, self::$headers, '{"sub":"123"}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => false,
            'scope' => 'offline_access read:messages',
            'audience' => 'https://api.identifier',
            'guzzle_options' => ['handler' => HandlerStack::create($mock)],
        ]);
        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());
        $this->assertEquals(['sub' => '123'], $auth0->getUser());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
        $this->assertEquals('4.5.6', $auth0->getRefreshToken());
    }

    /**
     * Test that the exchanges succeeds when PKCE is enabled.
     */
    public function testThatExchangeSucceedsWithPkceEnabled(): void
    {
        $mock = new MockHandler(
            [
            // Code exchange response.
            // Respond with no ID token, access token with correct number of segments.
                new Response(200, self::$headers, '{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            // Userinfo response.
                new Response(200, self::$headers, '{"sub":"__test_sub__"}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => false,
            'enable_pkce' => true,
            'guzzle_options' => [
                'handler' => HandlerStack::create($mock),
            ],
        ]);
        $_GET['code'] = uniqid();
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_GET['state'] = '__test_state__';
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
        $mock = new MockHandler(
            [
            // Code exchange response.
            // Respond with no ID token, access token with correct number of segments.
                new Response(200, self::$headers, '{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
            // Userinfo response.
                new Response(200, self::$headers, '{"sub":"__test_sub__"}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => false,
            'enable_pkce' => false,
            'guzzle_options' => [
                'handler' => HandlerStack::create($mock),
            ],
        ]);
        $_GET['code'] = uniqid();
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_GET['state'] = '__test_state__';
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
        $id_token = (new TokenGenerator())->withHs256();

        $mock = new MockHandler(
            [
            // Code exchange response.
                new Response(200, self::$headers, '{"access_token":"1.2.3","id_token":"' . $id_token . '"}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'scope' => 'openid',
            'skip_userinfo' => true,
            'id_token_alg' => 'HS256',
            'guzzle_options' => ['handler' => HandlerStack::create($mock)],
        ]);
        $_GET['code'] = uniqid();
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());

        $this->assertEquals('__test_sub__', $auth0->getUser()['sub']);
        $this->assertEquals($id_token, $auth0->getIdToken());
        $this->assertEquals('1.2.3', $auth0->getAccessToken());
    }

    /**
     * Test that renewTokens fails if there is no refresh_token stored.
     */
    public function testThatRenewTokensFailsIfThereIsNoRefreshToken(): void
    {
        $mock = new MockHandler(
            [
            // Code exchange response.
                new Response(200, self::$headers, '{"access_token":"1.2.3"}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => ['handler' => HandlerStack::create($mock)],
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());

        $this->expectException(\Auth0\SDK\Exception\CoreException::class);
        $this->expectExceptionMessage("Can't renew the access token if there isn't a refresh token available");

        $auth0->renewTokens();
    }

    /**
     * Test that renewTokens fails if the API response is invalid.
     */
    public function testThatRenewTokensFailsIfNoAccessTokenReturned(): void
    {
        $mock = new MockHandler(
            [
                new Response(200, self::$headers, '{"access_token":"1.2.3","refresh_token":"2.3.4"}'),
                new Response(200, self::$headers, '{}'),
            ]
        );

        $auth0 = new Auth0(self::$baseConfig + [
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => ['handler' => HandlerStack::create($mock)],
        ]);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());

        $this->expectExceptionMessage('Token did not refresh correctly. Access token not returned.');
        $auth0->renewTokens();
    }

    /**
     * Test that renewTokens succeeds with non-empty access_token and refresh_token stored.
     */
    public function testThatRenewTokensSucceeds(): void
    {
        $id_token = (new TokenGenerator())->withHs256();
        $request_history = [];

        $mock = new MockHandler(
            [
                new Response(200, self::$headers, '{"access_token":"1.2.3","refresh_token":"2.3.4","id_token":"' . $id_token . '"}'),
                new Response(200, self::$headers, '{"access_token":"__test_access_token__","id_token":"' . $id_token . '"}'),
            ]
        );
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($request_history));

        $auth0 = new Auth0(self::$baseConfig + [
            'id_token_alg' => 'HS256',
            'skip_userinfo' => true,
            'persist_access_token' => true,
            'guzzle_options' => ['handler' => $handler],
        ]);

        $_GET['code'] = uniqid();
        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $this->assertTrue($auth0->exchange());

        $this->assertArrayNotHasKey('auth0_nonce', $_SESSION);
        $this->assertArrayNotHasKey('auth0_state', $_SESSION);

        $auth0->renewTokens(['scope' => 'openid']);

        $this->assertEquals('__test_access_token__', $auth0->getAccessToken());
        $this->assertEquals($id_token, $auth0->getIdToken());

        $renew_request = $request_history[1]['request'];
        $renew_body = json_decode((string) $renew_request->getBody(), true);
        $this->assertEquals('openid', $renew_body['scope']);
        $this->assertEquals('__test_client_secret__', $renew_body['client_secret']);
        $this->assertEquals('__test_client_id__', $renew_body['client_id']);
        $this->assertEquals('2.3.4', $renew_body['refresh_token']);
        $this->assertEquals('https://__test_domain__/oauth/token', (string) $renew_request->getUri());
    }

    /**
     * Test that get login url uses default values.
     */
    public function testThatGetLoginUrlUsesDefaultValues(): void
    {
        $auth0 = new Auth0(self::$baseConfig);

        $parsed_url = parse_url($auth0->getLoginUrl());

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

        $auth_url = $auth0->getLoginUrl($custom_params);
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

        $auth_url = $auth0->getLoginUrl($override_params);
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

        $auth_url = $auth0->getLoginUrl();

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
        $auth0 = new Auth0(self::$baseConfig + ['enable_pkce' => true]);

        $auth_url = $auth0->getLoginUrl();

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
     * Test that client secret is not decoded by default.
     */
    public function testThatClientSecretIsNotDecodedByDefault(): void
    {
        $request_history = [];
        $mock = new MockHandler(
            [
                new Response(200, ['Content-Type' => 'json'], '{"access_token":"1.2.3"}'),
            ]
        );
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($request_history));

        $custom_config = array_merge(
            self::$baseConfig,
            [
                'skip_userinfo' => true,
                'guzzle_options' => ['handler' => $handler],
            ]
        );
        $auth0 = new Auth0($custom_config);

        $_GET['code'] = uniqid();
        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $auth0->exchange();

        $request_body = $request_history[0]['request']->getBody()->getContents();
        $request_body = json_decode($request_body, true);

        $this->assertArrayHasKey('client_secret', $request_body);
        $this->assertEquals('__test_client_secret__', $request_body['client_secret']);
    }

    /**
     * Test that client secret is decoded before sending.
     */
    public function testThatClientSecretIsDecodedBeforeSending(): void
    {
        $request_history = [];
        $mock = new MockHandler(
            [
                new Response(200, ['Content-Type' => 'json'], '{"access_token":"1.2.3"}'),
            ]
        );
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($request_history));

        $_GET['code'] = uniqid();
        $custom_config = array_merge(
            self::$baseConfig,
            [
                'client_secret' => '__test_encoded_client_secret__',
                'skip_userinfo' => true,
                'guzzle_options' => ['handler' => $handler],
            ]
        );

        $auth0 = new Auth0($custom_config);

        $_GET['state'] = '__test_state__';
        $_SESSION['auth0_state'] = '__test_state__';

        $auth0->exchange();

        $request_body = $request_history[0]['request']->getBody()->getContents();
        $request_body = json_decode($request_body, true);

        $this->assertArrayHasKey('client_secret', $request_body);
        $this->assertEquals('__test_encoded_client_secret__', $request_body['client_secret']);
    }

    /**
     * Test that max age is set in login url from initial config.
     */
    public function testThatMaxAgeIsSetInLoginUrlFromInitialConfig(): void
    {
        $custom_config = self::$baseConfig;
        $custom_config['max_age'] = 1000;
        $auth0 = new Auth0($custom_config);

        $auth_url = $auth0->getLoginUrl();

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
        $custom_config = self::$baseConfig;
        $custom_config['max_age'] = 1000;
        $auth0 = new Auth0($custom_config);

        $auth_url = $auth0->getLoginUrl(['max_age' => 1001]);

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
        $custom_config = array_merge(
            self::$baseConfig,
            [
                'id_token_alg' => 'HS256',
                'persist_id_token' => true,
                'store' => new SessionStore(),
            ]
        );

        $auth0 = new Auth0($custom_config);
        $id_token = (new TokenGenerator())->withHs256();

        $_SESSION['auth0_nonce'] = '__test_nonce__';
        $_SESSION['auth0_max_age'] = 1000;
        $auth0->setIdToken($id_token);

        $this->assertEquals($id_token, $auth0->getIdToken());
        $this->assertEquals($id_token, $_SESSION['auth0_id_token']);
    }

    /**
     * Test that ID Token nonce is checked when set.
     */
    public function testThatIdTokenNonceIsCheckedWhenSet(): void
    {
        $custom_config = self::$baseConfig + ['id_token_alg' => 'HS256'];
        $auth0 = new Auth0($custom_config);
        $id_token = (new TokenGenerator())->withHs256();

        $_SESSION['auth0_nonce'] = '__invalid_nonce__';

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Nonce (nonce) claim mismatch in the token');

        $auth0->setIdToken($id_token);
    }

    /**
     * Test that ID Token auth time is checked when set.
     */
    public function testThatIdTokenAuthTimeIsCheckedWhenSet(): void
    {
        $custom_config = self::$baseConfig + ['id_token_alg' => 'HS256', 'max_age' => 10];
        $auth0 = new Auth0($custom_config);
        $id_token = (new TokenGenerator())->withHs256();

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Authentication Time (auth_time) claim in the token indicates that too much time has passed since the last end-user authentication');

        $auth0->setIdToken($id_token);
    }

    /**
     * Test that ID Token Organization is checked when set.
     */
    public function testThatIdTokenOrganizationIsCheckedWhenSet(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['id_token_alg' => 'HS256', 'organization' => '__test_organization__']);

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Organization Id (org_id) claim must be a string present in the token');

        $auth0->decode((new TokenGenerator())->withHs256());
    }

    /**
     * Test that ID Token Organization is successful when matched.
     */
    public function testThatIdTokenOrganizationSuccessWhenMatched(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['id_token_alg' => 'HS256', 'organization' => '__test_organization__']);

        $decodedToken = $auth0->decode((new TokenGenerator())->withHs256(['org_id' => '__test_organization__']));

        $this->assertArrayHasKey('org_id', $decodedToken);
        $this->assertEquals('__test_organization__', $decodedToken['org_id']);
    }

    /**
     * Test that ID Token Organization fails when mismatched.
     */
    public function testThatIdTokenOrganizationFailsWhenMismatched(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['id_token_alg' => 'HS256', 'organization' => '__test_organization__']);

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Organization Id (org_id) claim value mismatch in the token');

        $auth0->decode((new TokenGenerator())->withHs256(['org_id' => '__bad_test_organization__']));
    }

    /**
     * Test that decode ID Token options are used.
     */
    public function testThatDecodeIdTokenOptionsAreUsed(): void
    {
        $auth0 = new Auth0(self::$baseConfig + ['id_token_alg' => 'HS256']);
        $_SESSION['auth0_nonce'] = '__test_nonce__';

        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Authentication Time (auth_time) claim in the token indicates that too much time has passed');

        $auth0->decode((new TokenGenerator())->withHs256(), ['max_age' => 10]);
    }

    /**
     * Test that ID Token leeway from constructor is used.
     */
    public function testThatIdTokenLeewayFromConstructorIsUsed(): void
    {
        $custom_config = self::$baseConfig + ['id_token_leeway' => 120, 'id_token_alg' => 'HS256'];
        $auth0 = new Auth0($custom_config);

        // Set the token expiration time past the default leeway of 60 seconds.
        $id_token = (new TokenGenerator())->withHs256(['exp' => time() - 100]);

        $_SESSION['auth0_nonce'] = '__test_nonce__';

        $auth0->setIdToken($id_token);
        $this->assertEquals($id_token, $auth0->getIdToken());
    }

    /**
     * Test that cache handler can be set.
     */
    public function testThatCacheHandlerCanBeSet(): void
    {
        $cacheKey = md5('https://test.auth0.com/.well-known/jwks.json');
        $mockJwks = [
            '__test_kid__' => [
                'x5c' => ['123'],
            ],
        ];

        $pool = new ArrayCachePool();
        $pool->set($cacheKey, $mockJwks);

        $auth0 = new Auth0(
            [
                'domain' => 'test.auth0.com',
                'client_id' => uniqid(),
                'redirect_uri' => uniqid(),
                'cache_handler' => $pool,
                'transient_store' => new SessionStore(),
            ]
        );

        $cachedJwks = $pool->get($cacheKey);
        $this->assertNotEmpty($cachedJwks);
        $this->assertArrayHasKey('__test_kid__', $cachedJwks);
        $this->assertEquals($mockJwks, $cachedJwks);

        // Ignore that we can't verify using this mock cert, just that it was attempted.
        $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
        $this->expectExceptionMessage('Cannot verify signature');

        $auth0->setIdToken((new TokenGenerator())->withRs256([], null, ['kid' => '__test_kid__']));
    }
}
