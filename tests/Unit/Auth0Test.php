<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Store\MemoryStore;

uses()->group('auth0');

beforeEach(function(): void {
    $_GET = [];
    $_COOKIE = [];

    $this->configuration = [
        'domain' => '__test_domain__',
        'clientId' => '__test_client_id__',
        'cookieSecret' => uniqid(),
        'clientSecret' => '__test_client_secret__',
        'redirectUri' => '__test_redirect_uri__',
    ];
});

it('does not persist user data when configured so', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['persistUser' => false]);
    $auth0->setUser(['sub' => '__test_user__']);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['persistUser' => false]);
    expect($auth0->getUser())->toBeNull();
});


it('uses the configured session storage handler', function(): void {
    $storeMock = new class () implements \Auth0\SDK\Contract\StoreInterface {
        /**
         * Example of an empty store.
         *
         * @param string $key     An example key.
         * @param mixed  $default An example default value.
         *
         * @return mixed
         */
        public function get(
            string $key,
            $default = null
        ) {
            $response = '__test_custom_store__' . $key . '__';

            if ($key === 'user' || $key === 'accessTokenScope') {
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

        public function purge(): void
        {
        }

        public function defer(
            bool $deferring = false
        ): void
        {
        }
    };

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['sessionStorage' => $storeMock]);
    $auth0->setUser(['sub' => '__test_user__']);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['sessionStorage' => $storeMock]);
    expect($auth0->getUser())->toEqual(['__test_custom_store__user__']);
});

test('authentication() returns an instance of the Authentication class', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    expect($auth0->authentication())->toBeInstanceOf(\Auth0\SDK\API\Authentication::class);
});

test('management() returns an instance of the Management class', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    expect($auth0->management())->toBeInstanceOf(\Auth0\SDK\API\Management::class);
});

test('configuration() returns the same instance of the SdkConfiguration class that was provided at instantiation', function(): void {
    $configuration = new SdkConfiguration($this->configuration);
    $auth0 = new \Auth0\SDK\Auth0($configuration);

    expect($auth0->configuration())
        ->toBeInstanceOf(\Auth0\SDK\Configuration\SdkConfiguration::class)
        ->toEqual($configuration);
});

test('getLoginLink() returns expected default value', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('scope=openid%20profile%20email')
            ->toContain('response_type=code')
            ->toContain('redirect_uri=__test_redirect_uri__')
            ->toContain('client_id=' . $this->configuration['clientId']);
});

test('getLoginLink() returns expected value when supplying parameters', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $params = [
        'connection' => uniqid(),
        'prompt' => uniqid(),
        'audience' => uniqid(),
        'state' => uniqid(),
        'invitation' => uniqid(),
    ];

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid(), null, $params));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('scope=openid%20profile%20email')
            ->toContain('response_type=code')
            ->toContain('prompt=' . $params['prompt'])
            ->toContain('state=' . $params['state'])
            ->toContain('invitation=' . $params['invitation'])
            ->toContain('audience=' . $params['audience'])
            ->toContain('connection=' . $params['connection'])
            ->toContain('redirect_uri=__test_redirect_uri__')
            ->toContain('client_id=' . $this->configuration['clientId']);
});

test('getLoginLink() returns expected value when overriding defaults', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $params = [
        'scope' => uniqid(),
        'response_type' => uniqid(),
        'response_mode' => 'form_post',
    ];

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid(), null, $params));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('scope=' . $params['scope'])
            ->toContain('response_type=' . $params['response_type'])
            ->toContain('response_mode=form_post')
            ->toContain('redirect_uri=__test_redirect_uri__')
            ->toContain('client_id=' . $this->configuration['clientId']);
});

test('getLoginLink() assigns a nonce and state', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid(), null, ['nonce' => uniqid()]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('state=')
            ->toContain('nonce=');
});

test('login() assigns a challenge and challenge method when PKCE is enabled', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $url = parse_url($auth0->login(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('code_challenge=')
            ->toContain('code_challenge_method=S256');
});

test('login() assigns `max_age` from default values', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenMaxAge' => 1000,
    ]);

    $url = parse_url($auth0->login(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('max_age=1000');
});

test('login() assigns `max_age` from overridden values', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenMaxAge' => 1000,
    ]);

    $url = parse_url($auth0->login(uniqid(), [
        'max_age' => 1001,
    ]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('max_age=1001');
});

test('signup() returns a url with a `screen_hint` parameter', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $url = parse_url($auth0->signup(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('screen_hint=signup');
});

test('handleInvitation() creates a valid login url', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';
    $_GET['organization'] = '__test_organization__';
    $_GET['organization_name'] = '__test_organization_name__';

    $url = parse_url($auth0->handleInvitation());

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/authorize')
        ->query
            ->toContain('invitation=__test_invitation__')
            ->toContain('organization=__test_organization__');
});

test('handleInvitation() returns null if organization invite parameters are not present in query', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    expect($auth0->handleInvitation())->toBeNull();
});

test('logout() returns a a valid logout url', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $returnUrl = uniqid();
    $randomParam = random_int(PHP_INT_MIN, PHP_INT_MAX);

    $url = parse_url($auth0->logout($returnUrl, [
        'rand' => $randomParam,
    ]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual('__test_domain__')
        ->path->toEqual('/v2/logout')
        ->query
            ->toContain('returnTo=' . $returnUrl)
            ->toContain('client_id=' . $this->configuration['clientId'])
            ->toContain('rand=' . $randomParam);
});

test('decode() uses the configured cache handler', function(): void {
    $cacheKey = hash('sha256', 'https://test.auth0.com/.well-known/jwks.json');
    $mockJwks = [
        '__test_kid__' => [
            'x5c' => ['123'],
        ],
    ];

    $pool = new \Symfony\Component\Cache\Adapter\ArrayAdapter();
    $item = $pool->getItem($cacheKey);
    $item->set($mockJwks);
    $pool->save($item);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenCache' => $pool,
    ]);

    $cachedJwks = $pool->getItem($cacheKey)->get();
    $this->assertNotEmpty($cachedJwks);
    $this->assertArrayHasKey('__test_kid__', $cachedJwks);
    $this->assertEquals($mockJwks, $cachedJwks);

    // Ignore that we can't verify using this mock cert, just that it was attempted.
    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage('Cannot verify signature');

    $auth0->decode((new \Auth0\Tests\Utilities\TokenGenerator())->withRs256([], null, ['kid' => '__test_kid__']));
});

test('decode() compares `auth_time` against `tokenMaxAge` configuration', function(): void {
    $now = time();
    $maxAge = 10;
    $drift = 100;

    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256([
        'auth_time' => $now - $drift,
    ]);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenMaxAge' => $maxAge,
        'tokenLeeway' => 0,
    ]);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_AUTH_TIME_CLAIM, time(), $now - $drift + $maxAge));

    $auth0->decode($token, null, null, null, null, null, $now);
});

test('decode() converts a string `max_age` value from transient storage into an int', function(): void {
    $now = time();
    $maxAge = 10;
    $drift = 100;

    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256([
        'auth_time' => $now - $drift,
    ]);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenLeeway' => 0,
    ]);

    $storage = $auth0->configuration()->getTransientStorage();
    $storage->set('max_age', '10');

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_AUTH_TIME_CLAIM, time(), $now - $drift + $maxAge));

    $auth0->decode($token, null, null, null, null, null, $now);
});

test('decode() compares `org_id` against `organization` configuration', function(): void {
    $orgId = 'org8675309';

    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256([
        'org_id' => $orgId,
    ]);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => [$orgId],
    ]);

    $decoded = $auth0->decode($token);

    $this->assertEquals($orgId, $decoded->getOrganization());
});

test('decode() throws an exception when `org_id` claim does not exist, but an `organization` is configured', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => ['org8675309'],
    ]);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ORG_ID_CLAIM);

    $auth0->decode($token);
});

test('decode() throws an exception when `org_id` does not match `organization` configuration', function(): void {
    $expectedOrgId = uniqid();
    $tokenOrgId = uniqid();

    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256([
        'org_id' => $tokenOrgId,
    ]);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => [$expectedOrgId],
    ]);

    $this->expectException(\Auth0\SDK\Exception\InvalidTokenException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_ORG_ID_CLAIM, $expectedOrgId, $tokenOrgId));

    $auth0->decode($token);
});

test('exchange() returns false if no code is present', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    $this->assertFalse($auth0->exchange());
});

test('exchange() returns false if no nonce is stored', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();
    $httpClient->mockResponse(\Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6"}'));

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier', '__test_code_verifier__');

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_MISSING_NONCE);

    $auth0->exchange();
});

test('exchange() throws an exception if no code verified was found', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_MISSING_CODE_VERIFIER);

    $auth0->exchange();
});

test('exchange() throws an exception if no state was found', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->exchange();
});

test('exchange() succeeds with a valid id token', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6","scope":"test:part1 test:part2 test:part3","expires_in":300}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());
    $this->assertArrayHasKey('sub', $auth0->getUser());
    $this->assertEquals('__test_sub__', $auth0->getUser()['sub']);
    $this->assertEquals($token, $auth0->getIdToken());
    $this->assertEquals('1.2.3', $auth0->getAccessToken());
    $this->assertEquals(['test:part1','test:part2','test:part3'], $auth0->getAccessTokenScope());
    $this->assertGreaterThan(time(), $auth0->getAccessTokenExpiration());
    $this->assertEquals('4.5.6', $auth0->getRefreshToken());
});

test('exchange() succeeds with no id token', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"sub":"123"}')
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());
    $this->assertArrayHasKey('sub', $auth0->getUser());
    $this->assertEquals('123', $auth0->getUser()['sub']);
    $this->assertEquals('1.2.3', $auth0->getAccessToken());
    $this->assertEquals('4.5.6', $auth0->getRefreshToken());
});

test('exchange() succeeds with PKCE disabled', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'usePkce' => false,
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');

    $this->assertTrue($auth0->exchange());
    $this->assertEquals(['sub' => '__test_sub__'], $auth0->getUser());
    $this->assertEquals('1.2.3', $auth0->getAccessToken());
    $this->assertEquals('4.5.6', $auth0->getRefreshToken());
});

test('exchange() skips hitting userinfo endpoint', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());
    $this->assertEquals('__test_sub__', $auth0->getUser()['sub']);
    $this->assertEquals($token, $auth0->getIdToken());
    $this->assertEquals('1.2.3', $auth0->getAccessToken());
});

test('exchange() throws an exception when code exchange fails', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"error": "Something happened.}', 500)
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('state', $_GET['state']);
    $auth0->configuration()->getTransientStorage()->set('nonce',  uniqid());
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  uniqid());

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_FAILED_CODE_EXCHANGE);

    $auth0->exchange();
});

test('exchange() throws an exception when an access token is not returned from code exchange', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{}')
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('state', $_GET['state']);
    $auth0->configuration()->getTransientStorage()->set('nonce',  uniqid());
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  uniqid());

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_BAD_ACCESS_TOKEN);

    $auth0->exchange();
});

test('renew() throws an exception if there is no refresh token available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{}')
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN);

    $auth0->renew();
});

test('renew() throws an exception if no access token is returned', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN);

    $auth0->renew();
});

test('renew() succeeds under expected and valid conditions', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4","id_token":"' . $token . '"}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"__test_access_token__","id_token":"' . $token . '"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());

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
});

test('getCredentials() returns null when a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    $this->assertNull($auth0->getCredentials());
});

test('getCredentials() returns the expected object structure when a session is available', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6","scope":"test:part1,test:part2,test:part3","expires_in":300}'),
        \Auth0\Tests\Utilities\HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $this->assertTrue($auth0->exchange());

    $credentials = $auth0->getCredentials();

    $this->assertIsObject($credentials);

    $this->assertObjectHasAttribute('user', $credentials);
    $this->assertObjectHasAttribute('idToken', $credentials);
    $this->assertObjectHasAttribute('accessToken', $credentials);
    $this->assertObjectHasAttribute('accessTokenScope', $credentials);
    $this->assertObjectHasAttribute('accessTokenExpiration', $credentials);
    $this->assertObjectHasAttribute('accessTokenExpired', $credentials);
    $this->assertObjectHasAttribute('refreshToken', $credentials);

    $this->assertIsArray($credentials->user);
});

test('getIdToken() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getIdToken();
});

test('getUser() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getUser();
});

test('getRefreshToken() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getRefreshToken();
});

test('getAccessToken() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getAccessToken();
});

test('getAccessTokenScope() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getAccessTokenScope();
});

test('getAccessTokenExpiration() performs an exchange if a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $this->expectException(\Auth0\SDK\Exception\StateException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

    $auth0->getAccessTokenExpiration();
});

test('setIdToken() properly stores data', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');

    $auth0->setIdToken($token);

    $this->assertEquals($token, $auth0->getIdToken());
    $this->assertEquals($token, $auth0->configuration()->getSessionStorage()->get('idToken'));
});

test('setIdToken() uses `tokenLeeway` configuration', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256([
        'exp' => time() - 100,
    ]);

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenLeeway' => 120,
    ]);

    $auth0->setIdToken($token);
    $this->assertEquals($token, $auth0->getIdToken());
});

test('getRequestParameter() retrieves from $_POST when `responseMode` is configured to `form_post`', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['responseMode' => 'form_post']);

    $_GET['test'] = uniqid();
    $_POST['test'] = uniqid();

    $extracted = $auth0->getRequestParameter('test');

    $this->assertEquals($_POST['test'], $extracted);
    $this->assertNotEquals($_GET['test'], $extracted);
});

test('getInvitationParameters() returns request parameters when valid', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

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
});

test('getInvitationParameters() does not return invalid request parameters', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';

    $this->assertIsNotObject($auth0->getInvitationParameters());
});
