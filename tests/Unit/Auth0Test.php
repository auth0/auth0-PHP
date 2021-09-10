<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;

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
    expect($cachedJwks)->toEqual($mockJwks);

    $auth0->decode((new \Auth0\Tests\Utilities\TokenGenerator())->withRs256([], null, ['kid' => '__test_kid__']));
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_BAD_SIGNATURE);

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

    $auth0->decode($token, null, null, null, null, null, $now);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

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

    $auth0->decode($token, null, null, null, null, null, $now);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

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

    expect($decoded->getOrganization())->toEqual($orgId);
});

test('decode() throws an exception when `org_id` claim does not exist, but an `organization` is configured', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();

    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => ['org8675309'],
    ]);

    $auth0->decode($token);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ORG_ID_CLAIM);

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

    $auth0->decode($token);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('exchange() throws an exception if no code is present', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_MISSING_CODE);

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

    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_MISSING_NONCE);

test('exchange() throws an exception if no code verified was found', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_MISSING_CODE_VERIFIER);

test('exchange() throws an exception if no state was found', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_INVALID_STATE);

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

    expect($auth0->exchange())->toBeTrue();
    $this->assertArrayHasKey('sub', $auth0->getUser());
    expect($auth0->getUser()['sub'])->toEqual('__test_sub__');
    expect($auth0->getIdToken())->toEqual($token);
    expect($auth0->getAccessToken())->toEqual('1.2.3');
    expect($auth0->getAccessTokenScope())->toEqual(['test:part1','test:part2','test:part3']);
    expect($auth0->getAccessTokenExpiration())->toBeGreaterThan(time());
    expect($auth0->getRefreshToken())->toEqual('4.5.6');
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

    expect($auth0->exchange())->toBeTrue();
    $this->assertArrayHasKey('sub', $auth0->getUser());
    expect($auth0->getUser()['sub'])->toEqual('123');
    expect($auth0->getAccessToken())->toEqual('1.2.3');
    expect($auth0->getRefreshToken())->toEqual('4.5.6');
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

    expect($auth0->exchange())->toBeTrue();
    expect($auth0->getUser())->toEqual(['sub' => '__test_sub__']);
    expect($auth0->getAccessToken())->toEqual('1.2.3');
    expect($auth0->getRefreshToken())->toEqual('4.5.6');
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

    expect($auth0->exchange())->toBeTrue();
    expect($auth0->getUser()['sub'])->toEqual('__test_sub__');
    expect($auth0->getIdToken())->toEqual($token);
    expect($auth0->getAccessToken())->toEqual('1.2.3');
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

    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_FAILED_CODE_EXCHANGE);

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

    $auth0->exchange();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_BAD_ACCESS_TOKEN);

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

    expect($auth0->exchange())->toBeTrue();

    $auth0->renew();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN);

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

    expect($auth0->exchange())->toBeTrue();

    $auth0->renew();
})->throws(\Auth0\SDK\Exception\StateException::class, \Auth0\SDK\Exception\StateException::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN);

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

    expect($auth0->exchange())->toBeTrue();

    $auth0->renew(['scope' => 'openid']);
    $request = $httpClient->getLastRequest()->getLastRequest();
    parse_str($request->getBody()->__toString(), $requestBody);

    expect($auth0->getAccessToken())->toEqual('__test_access_token__');
    expect($auth0->getIdToken())->toEqual($token);

    expect($requestBody['scope'])->toEqual('openid');
    expect($requestBody['client_secret'])->toEqual('__test_client_secret__');
    expect($requestBody['client_id'])->toEqual('__test_client_id__');
    expect($requestBody['refresh_token'])->toEqual('2.3.4');
    expect($request->getUri()->__toString())->toEqual('https://__test_domain__/oauth/token');
});

test('getCredentials() returns null when a session is not available', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);
    expect($auth0->getCredentials())->toBeNull();
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

    expect($auth0->exchange())->toBeTrue();

    $credentials = $auth0->getCredentials();

    expect($credentials)->toBeObject();

    $this->assertObjectHasAttribute('user', $credentials);
    $this->assertObjectHasAttribute('idToken', $credentials);
    $this->assertObjectHasAttribute('accessToken', $credentials);
    $this->assertObjectHasAttribute('accessTokenScope', $credentials);
    $this->assertObjectHasAttribute('accessTokenExpiration', $credentials);
    $this->assertObjectHasAttribute('accessTokenExpired', $credentials);
    $this->assertObjectHasAttribute('refreshToken', $credentials);

    expect($credentials->user)->toBeArray();
});

test('setIdToken() properly stores data', function(): void {
    $token = (new \Auth0\Tests\Utilities\TokenGenerator())->withHs256();
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');

    $auth0->setIdToken($token);

    expect($auth0->getIdToken())->toEqual($token);
    expect($auth0->configuration()->getSessionStorage()->get('idToken'))->toEqual($token);
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
    expect($auth0->getIdToken())->toEqual($token);
});

test('getRequestParameter() retrieves from $_POST when `responseMode` is configured to `form_post`', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration + ['responseMode' => 'form_post']);

    $_GET['test'] = uniqid();
    $_POST['test'] = uniqid();

    $extracted = $auth0->getRequestParameter('test');

    expect($extracted)->toEqual($_POST['test']);
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

    expect('__test_invitation__')->toEqual($extracted->invitation);
    expect('__test_organization__')->toEqual($extracted->organization);
    expect('__test_organization_name__')->toEqual($extracted->organizationName);
});

test('getInvitationParameters() does not return invalid request parameters', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';

    $this->assertIsNotObject($auth0->getInvitationParameters());
});

test('getExchangeParameters() returns request parameters when valid', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $extracted = $auth0->getExchangeParameters();

    $this->assertIsObject($extracted, 'Invitation parameters were not extracted from the $_GET (environment variable seeded with query parameters during a GET request) successfully.');

    $this->assertObjectHasAttribute('code', $extracted);
    $this->assertObjectHasAttribute('state', $extracted);

    expect($extracted->code)->toEqual($_GET['code']);
    expect($extracted->state)->toEqual($_GET['state']);
});

test('getExchangeParameters() does not return invalid request parameters', function(): void {
    $auth0 = new \Auth0\SDK\Auth0($this->configuration);

    $_GET['code'] = 123;

    $this->assertIsNotObject($auth0->getExchangeParameters());
});
