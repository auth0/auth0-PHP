<?php

declare(strict_types=1);

use Auth0\SDK\API\Authentication;
use Auth0\SDK\API\Management;
use Auth0\SDK\Auth0;
use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Contract\StoreInterface;
use Auth0\SDK\Exception\ConfigurationException;
use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Exception\StateException;
use Auth0\SDK\Token;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('auth0');

beforeEach(function(): void {
    $_GET = [];
    $_COOKIE = [];

    $this->configuration = [
        'domain' => 'test.auth0.com',
        'clientId' => '__test_client_id__',
        'cookieSecret' => uniqid(),
        'clientSecret' => '__test_client_secret__',
        'redirectUri' => '__test_redirect_uri__',
    ];
});

it('does not persist user data when configured so', function(): void {
    $auth0 = new Auth0($this->configuration + ['persistUser' => false]);
    $auth0->setUser(['sub' => '__test_user__']);

    $auth0 = new Auth0($this->configuration + ['persistUser' => false]);
    expect($auth0->getUser())->toBeNull();
});


it('uses the configured session storage handler', function(): void {
    $storeMock = new class () implements StoreInterface {
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

    $auth0 = new Auth0($this->configuration + ['sessionStorage' => $storeMock]);
    $auth0->setUser(['sub' => '__test_user__']);

    $auth0 = new Auth0($this->configuration + ['sessionStorage' => $storeMock]);
    expect($auth0->getUser())->toEqual(['__test_custom_store__user__']);
});

test('authentication() returns an instance of the Authentication class', function(): void {
    $auth0 = new Auth0($this->configuration);
    expect($auth0->authentication())->toBeInstanceOf(Authentication::class);
});

test('management() returns an instance of the Management class', function(): void {
    $auth0 = new Auth0($this->configuration);
    expect($auth0->management())->toBeInstanceOf(Management::class);
});

test('configuration() returns the same instance of the SdkConfiguration class that was provided at instantiation', function(): void {
    $configuration = new SdkConfiguration($this->configuration);
    $auth0 = new Auth0($configuration);

    expect($auth0->configuration())
        ->toBeInstanceOf(SdkConfiguration::class)
        ->toEqual($configuration);
});

test('getLoginLink() returns expected default value', function(): void {
    $auth0 = new Auth0($this->configuration);

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('scope=openid%20profile%20email')
            ->toContain('response_type=code')
            ->toContain('redirect_uri=__test_redirect_uri__')
            ->toContain('client_id=' . $this->configuration['clientId']);
});

test('getLoginLink() returns expected value when supplying parameters', function(): void {
    $auth0 = new Auth0($this->configuration);

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
        ->host->toEqual($this->configuration['domain'])
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
    $auth0 = new Auth0($this->configuration);

    $params = [
        'scope' => uniqid(),
        'response_type' => uniqid(),
        'response_mode' => 'form_post',
    ];

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid(), null, $params));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('scope=' . $params['scope'])
            ->toContain('response_type=' . $params['response_type'])
            ->toContain('response_mode=form_post')
            ->toContain('redirect_uri=__test_redirect_uri__')
            ->toContain('client_id=' . $this->configuration['clientId']);
});

test('getLoginLink() assigns a nonce and state', function(): void {
    $auth0 = new Auth0($this->configuration);

    $url = parse_url($auth0->authentication()->getLoginLink(uniqid(), null, ['nonce' => uniqid()]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('state=')
            ->toContain('nonce=');
});

test('login() throws a ConfigurationException if the SDK is not configured with a stateful strategy', function(): void {
    $auth0 = new Auth0(array_merge($this->configuration, [
        'audience' => [uniqid()],
        'strategy' => SdkConfiguration::STRATEGY_API
    ]));
    $auth0->login();
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_SESSION_REQUIRED, 'Auth0->login()'));

test('login() assigns a challenge and challenge method when PKCE is enabled', function(): void {
    $auth0 = new Auth0($this->configuration);

    $url = parse_url($auth0->login(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('code_challenge=')
            ->toContain('code_challenge_method=S256');
});

test('login() assigns `max_age` from default values', function(): void {
    $auth0 = new Auth0($this->configuration + [
        'tokenMaxAge' => 1000,
    ]);

    $url = parse_url($auth0->login(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('max_age=1000');
});

test('login() assigns `max_age` from overridden values', function(): void {
    $auth0 = new Auth0($this->configuration + [
        'tokenMaxAge' => 1000,
    ]);

    $url = parse_url($auth0->login(uniqid(), [
        'max_age' => 1001,
    ]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('max_age=1001');
});

test('signup() throws a ConfigurationException if the SDK is not configured with a stateful strategy', function(): void {
    $auth0 = new Auth0(array_merge($this->configuration, [
        'audience' => [uniqid()],
        'strategy' => SdkConfiguration::STRATEGY_API
    ]));
    $auth0->signup();
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_SESSION_REQUIRED, 'Auth0->signup()'));

test('signup() returns a url with a `screen_hint` parameter', function(): void {
    $auth0 = new Auth0($this->configuration);

    $url = parse_url($auth0->signup(uniqid()));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('screen_hint=signup');
});

test('handleInvitation() throws a ConfigurationException if the SDK is not configured with a stateful strategy', function(): void {
    $auth0 = new Auth0(array_merge($this->configuration, [
        'audience' => [uniqid()],
        'strategy' => SdkConfiguration::STRATEGY_API
    ]));
    $auth0->handleInvitation();
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_SESSION_REQUIRED, 'Auth0->handleInvitation()'));

test('handleInvitation() creates a valid login url', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';
    $_GET['organization'] = '__test_organization__';
    $_GET['organization_name'] = '__test_organization_name__';

    $url = parse_url($auth0->handleInvitation());

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/authorize')
        ->query
            ->toContain('invitation=__test_invitation__')
            ->toContain('organization=__test_organization__');
});

test('handleInvitation() returns null if organization invite parameters are not present in query', function(): void {
    $auth0 = new Auth0($this->configuration);

    expect($auth0->handleInvitation())->toBeNull();
});

test('logout() throws a ConfigurationException if the SDK is not configured with a stateful strategy', function(): void {
    $auth0 = new Auth0(array_merge($this->configuration, [
        'audience' => [uniqid()],
        'strategy' => SdkConfiguration::STRATEGY_API
    ]));
    $auth0->logout();
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_SESSION_REQUIRED, 'Auth0->logout()'));

test('logout() returns a a valid logout url', function(): void {
    $auth0 = new Auth0($this->configuration);

    $returnUrl = uniqid();
    $randomParam = random_int(PHP_INT_MIN, PHP_INT_MAX);

    $url = parse_url($auth0->logout($returnUrl, [
        'rand' => $randomParam,
    ]));

    expect($url)
        ->scheme->toEqual('https')
        ->host->toEqual($this->configuration['domain'])
        ->path->toEqual('/v2/logout')
        ->query
            ->toContain('returnTo=' . $returnUrl)
            ->toContain('client_id=' . $this->configuration['clientId'])
            ->toContain('rand=' . $randomParam);
});

test('decode() uses the configured cache handler', function(): void {
    $cacheKey = hash('sha256', $this->configuration['domain'] . '/.well-known/jwks.json');
    $mockJwks = [
        '__test_kid__' => [
            'x5c' => ['123'],
        ],
    ];

    $pool = new ArrayAdapter();
    $item = $pool->getItem($cacheKey);
    $item->set($mockJwks);
    $pool->save($item);

    $auth0 = new Auth0($this->configuration + [
        'tokenCache' => $pool,
    ]);

    $cachedJwks = $pool->getItem($cacheKey)->get();
    $this->assertNotEmpty($cachedJwks);
    $this->assertArrayHasKey('__test_kid__', $cachedJwks);
    expect($cachedJwks)->toEqual($mockJwks);

    $auth0->decode((new TokenGenerator())->withRs256([], null, ['kid' => '__test_kid__']));
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_BAD_SIGNATURE);

test('decode() compares `auth_time` against `tokenMaxAge` configuration', function(): void {
    $now = time();
    $maxAge = 10;
    $drift = 100;

    $token = (new TokenGenerator())->withHs256([
        'auth_time' => $now - $drift,
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenMaxAge' => $maxAge,
        'tokenLeeway' => 0,
    ]);

    $auth0->decode($token, null, null, null, null, null, $now);
})->throws(InvalidTokenException::class);

test('decode() converts a string `max_age` value from transient storage into an int', function(): void {
    $now = time();
    $maxAge = 10;
    $drift = 100;

    $token = (new TokenGenerator())->withHs256([
        'auth_time' => $now - $drift,
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenLeeway' => 0,
    ]);

    $storage = $auth0->configuration()->getTransientStorage();
    $storage->set('max_age', '10');

    $auth0->decode($token, null, null, null, null, null, $now);
})->throws(InvalidTokenException::class);

test('decode() compares `org_id` against `organization` configuration', function(): void {
    $orgId = 'org8675309';

    $token = (new TokenGenerator())->withHs256([
        'org_id' => $orgId,
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => [$orgId],
    ]);

    $decoded = $auth0->decode($token);

    expect($decoded->getOrganization())->toEqual($orgId);
});

test('decode() throws an exception when `org_id` claim does not exist, but an `organization` is configured', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => ['org8675309'],
    ]);

    $auth0->decode($token);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_ORG_ID_CLAIM);

test('decode() throws an exception when `org_id` does not match `organization` configuration', function(): void {
    $expectedOrgId = uniqid();
    $tokenOrgId = uniqid();

    $token = (new TokenGenerator())->withHs256([
        'org_id' => $tokenOrgId,
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'organization' => [$expectedOrgId],
    ]);

    $auth0->decode($token);
})->throws(InvalidTokenException::class);

test('decode() can be used with access tokens', function (): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $decoded = $auth0->decode($token,
        null,
        null,
        null,
        null,
        null,
        null,
        Token::TYPE_TOKEN,
    );

    expect($decoded->getAudience())->toContain('__test_client_id__');
});

test('exchange() throws a ConfigurationException if the SDK is not configured with a stateful strategy', function(): void {
    $auth0 = new Auth0(array_merge($this->configuration, [
        'audience' => [uniqid()],
        'strategy' => SdkConfiguration::STRATEGY_API
    ]));
    $auth0->exchange();
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_SESSION_REQUIRED, 'Auth0->exchange()'));

test('exchange() throws an exception if no code is present', function(): void {
    $auth0 = new Auth0($this->configuration);
    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_MISSING_CODE);

test('exchange() returns false if no nonce is stored', function(): void {
    $token = (new TokenGenerator())->withHs256();

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();
    $httpClient->mockResponse(HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6"}'));

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier', '__test_code_verifier__');

    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_MISSING_NONCE);

test('exchange() throws an exception if no code verified was found', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_MISSING_CODE_VERIFIER);

test('exchange() throws an exception if no state was found', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['code'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('code_verifier',  null);

    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_INVALID_STATE);

test('exchange() throws an exception with a bad id token', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"BAD' . $token . '","refresh_token":"4.5.6","scope":"test:part1 test:part2 test:part3","expires_in":300}'),
        HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    $auth0->exchange();
})->throws(InvalidTokenException::class);

test('exchange() succeeds with a valid id token', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6","scope":"test:part1 test:part2 test:part3","expires_in":300}'),
        HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
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
    $auth0 = new Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
        HttpResponseGenerator::create('{"sub":"123"}')
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
    $auth0 = new Auth0($this->configuration + [
        'usePkce' => false,
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"4.5.6"}'),
        HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
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
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '"}'),
        HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
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
    $auth0 = new Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"error": "Something happened.}', 500)
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('state', $_GET['state']);
    $auth0->configuration()->getTransientStorage()->set('nonce',  uniqid());
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  uniqid());

    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_FAILED_CODE_EXCHANGE);

test('exchange() throws an exception when an access token is not returned from code exchange', function(): void {
    $auth0 = new Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{}')
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $auth0->configuration()->getTransientStorage()->set('state', $_GET['state']);
    $auth0->configuration()->getTransientStorage()->set('nonce',  uniqid());
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  uniqid());

    $auth0->exchange();
})->throws(StateException::class, StateException::MSG_BAD_ACCESS_TOKEN);

test('renew() throws an exception if there is no refresh token available', function(): void {
    $auth0 = new Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3"}'),
        HttpResponseGenerator::create('{}')
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    expect($auth0->exchange())->toBeTrue();

    $auth0->renew();
})->throws(StateException::class, StateException::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN);

test('renew() throws an exception if no access token is returned', function(): void {
    $auth0 = new Auth0($this->configuration);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4"}'),
        HttpResponseGenerator::create('{}'),
        HttpResponseGenerator::create('{}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    expect($auth0->exchange())->toBeTrue();

    $auth0->renew();
})->throws(StateException::class, StateException::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN);

test('renew() succeeds under expected and valid conditions', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","refresh_token":"2.3.4","id_token":"' . $token . '"}'),
        HttpResponseGenerator::create('{"access_token":"__test_access_token__","id_token":"' . $token . '","expires_in":"123","refresh_token":"5.6.7","scope":"test1 test2 test3"}'),
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
    expect($auth0->getAccessTokenExpiration())->toBeGreaterThanOrEqual(time() + 123);
    expect($auth0->getRefreshToken())->toEqual('5.6.7');
    expect($auth0->getAccessTokenScope())->toEqual(['test1', 'test2', 'test3']);

    expect($requestBody['scope'])->toEqual('openid');
    expect($requestBody['client_secret'])->toEqual('__test_client_secret__');
    expect($requestBody['client_id'])->toEqual('__test_client_id__');
    expect($requestBody['refresh_token'])->toEqual('2.3.4');
    expect($request->getUri()->__toString())->toEqual('https://' . $this->configuration['domain'] . '/oauth/token');
});

test('getCredentials() returns null when a session is not available', function(): void {
    $auth0 = new Auth0($this->configuration);
    expect($auth0->getCredentials())->toBeNull();
});

test('getCredentials() returns the expected object structure when a session is available', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'iss' => 'https://' . $this->configuration['domain'] . '/'
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $httpClient = $auth0->authentication()->getHttpClient();

    $httpClient->mockResponses([
        HttpResponseGenerator::create('{"access_token":"1.2.3","id_token":"' . $token . '","refresh_token":"4.5.6","scope":"test:part1,test:part2,test:part3","expires_in":300}'),
        HttpResponseGenerator::create('{"sub":"__test_sub__"}'),
    ]);

    $_GET['code'] = uniqid();
    $_GET['state'] = '__test_state__';

    $auth0->configuration()->getTransientStorage()->set('state', '__test_state__');
    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');
    $auth0->configuration()->getTransientStorage()->set('code_verifier',  '__test_code_verifier__');

    expect($auth0->exchange())->toBeTrue();

    $credentials = $auth0->getCredentials();

    expect($credentials)
        ->toBeObject()
        ->toHaveProperties(['user', 'idToken', 'accessToken', 'accessTokenScope', 'accessTokenExpiration', 'accessTokenExpired', 'refreshToken']);

    expect($credentials->user)->toBeArray();
});

test('setIdToken() properly stores data', function(): void {
    $token = (new TokenGenerator())->withHs256();
    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
    ]);

    $auth0->configuration()->getTransientStorage()->set('nonce',  '__test_nonce__');

    $auth0->setIdToken($token);

    expect($auth0->getIdToken())->toEqual($token);
    expect($auth0->configuration()->getSessionStorage()->get('idToken'))->toEqual($token);
});

test('setIdToken() uses `tokenLeeway` configuration', function(): void {
    $token = (new TokenGenerator())->withHs256([
        'exp' => time() - 100,
    ]);

    $auth0 = new Auth0($this->configuration + [
        'tokenAlgorithm' => 'HS256',
        'tokenLeeway' => 120,
    ]);

    $auth0->setIdToken($token);
    expect($auth0->getIdToken())->toEqual($token);
});

test('getRequestParameter() retrieves from $_POST when `responseMode` is configured to `form_post`', function(): void {
    $auth0 = new Auth0($this->configuration + ['responseMode' => 'form_post']);

    $_GET['test'] = uniqid();
    $_POST['test'] = uniqid();

    $extracted = $auth0->getRequestParameter('test');

    expect($extracted)->toEqual($_POST['test']);
    $this->assertNotEquals($_GET['test'], $extracted);
});

test('getInvitationParameters() returns request parameters when valid', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';
    $_GET['organization'] = '__test_organization__';
    $_GET['organization_name'] = '__test_organization_name__';

    $extracted = $auth0->getInvitationParameters();

    expect($extracted)
        ->toBeArray()
        ->toHaveKey('invitation')
        ->toHaveKey('organization')
        ->toHaveKey('organizationName');

    expect('__test_invitation__')->toEqual($extracted['invitation']);
    expect('__test_organization__')->toEqual($extracted['organization']);
    expect('__test_organization_name__')->toEqual($extracted['organizationName']);
});

test('getInvitationParameters() does not return invalid request parameters', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['invitation'] = '__test_invitation__';

    $this->assertIsNotObject($auth0->getInvitationParameters());
});

test('getExchangeParameters() returns request parameters when valid', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['code'] = uniqid();
    $_GET['state'] = uniqid();

    $extracted = $auth0->getExchangeParameters();

    expect($extracted)
        ->toBeObject()
        ->toHaveProperty('code', $_GET['code'])
        ->toHaveProperty('state', $_GET['state']);
});

test('getExchangeParameters() does not return invalid request parameters', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['code'] = 123;

    $this->assertIsNotObject($auth0->getExchangeParameters());
});


test('getBearerToken() checks $_GET for specified value', function(): void {
    $auth0 = new Auth0($this->configuration);

    $_GET['token'] = 123;

    $this->assertIsNotObject($auth0->getExchangeParameters());
});

test('getBearerToken() successfully finds a candidate token in $_GET', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();
    $_GET[$testParameterName] = $candidate->token;

    $auth0 = new Auth0(array_merge($this->configuration, [
        'domain' => 'https://domain.test',
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertIsObject($auth0->getBearerToken(
        [
            $testParameterName
        ],
    ));
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() successfully finds a candidate token in $_POST', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();
    $_POST[$testParameterName] = $candidate->token;

    $auth0 = new Auth0(array_merge($this->configuration, [
        'domain' => 'https://domain.test',
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertIsObject($auth0->getBearerToken(
        null,
        [
            $testParameterName
        ],
    ));
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() successfully finds a candidate token in $_SERVER', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();
    $_SERVER[$testParameterName] = 'Bearer ' . $candidate->token;

    $auth0 = new Auth0(array_merge($this->configuration, [
        'domain' => 'https://domain.test',
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertIsObject($auth0->getBearerToken(
        null,
        null,
        [
            $testParameterName
        ],
    ));
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() successfully finds a candidate token needle in a haystack', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();

    $auth0 = new Auth0(array_merge($this->configuration, [
        'domain' => 'https://domain.test',
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertIsObject($auth0->getBearerToken(
        null,
        null,
        null,
        [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            $testParameterName => 'Bearer ' . $candidate->token,
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ],
        [
            uniqid(),
            $testParameterName,
            uniqid(),
            uniqid(),
            uniqid()
        ],
    ));
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() correctly returns null when there are no candidates', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();

    $_GET[uniqid()] = $candidate->token;
    $_POST[uniqid()] = $candidate->token;
    $_SERVER[uniqid()] = $candidate->token;

    $auth0 = new Auth0(array_merge($this->configuration, [
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertEquals($auth0->getBearerToken(
        null,
        null,
        null,
        [
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => 'Bearer ' . $candidate->token,
            uniqid() => uniqid(),
            uniqid() => uniqid(),
            uniqid() => uniqid(),
        ],
        [
            uniqid(),
            $testParameterName,
            uniqid(),
            uniqid(),
            uniqid()
        ],
    ), null);
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() correctly returns null when the candidate value is empty', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();

    $auth0 = new Auth0(array_merge($this->configuration, [
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertEquals($auth0->getBearerToken(
        null,
        null,
        null,
        [
            $testParameterName => '',
        ],
        [
            $testParameterName
        ]
    ), null);
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);

test('getBearerToken() correctly silently handles token validation exceptions', function(
    TokenGeneratorResponse $candidate
): void {
    $testParameterName = uniqid();

    $_GET[$testParameterName] = $candidate->token;

    $auth0 = new Auth0(array_merge($this->configuration, [
        'tokenJwksUri' => $candidate->jwks,
        'tokenCache' => $candidate->cached
    ]));

    $this->assertEquals($auth0->getBearerToken(
        [$testParameterName],
    ), null);
})->with(['mocked rs256 bearer token' => [
    fn() => TokenGenerator::create(TokenGenerator::TOKEN_ACCESS, TokenGenerator::ALG_RS256)
]]);
