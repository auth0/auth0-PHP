<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkState;
use Auth0\SDK\Exception\ConfigurationException;

uses()->group('configuration');

test('__construct() accepts a configuration array', function(): void {
    $now = time();

    $idToken = uniqid();
    $accessToken = uniqid();
    $accessTokenScope = [uniqid()];
    $refreshToken = uniqid();
    $user = [uniqid()];
    $accessTokenExpiration = $now + 1000;

    $state = new SdkState([
        'idToken' => $idToken,
        'accessToken' => $accessToken,
        'accessTokenScope' => $accessTokenScope,
        'refreshToken' => $refreshToken,
        'user' => $user,
        'accessTokenExpiration' => $accessTokenExpiration,
    ]);

    expect($state->getIdToken())->toEqual($idToken);
    expect($state->getAccessToken())->toEqual($accessToken);
    expect($state->getAccessTokenScope())->toEqual($accessTokenScope);
    expect($state->getRefreshToken())->toEqual($refreshToken);
    expect($state->getUser())->toEqual($user);
    expect($state->getAccessTokenExpiration())->toEqual($accessTokenExpiration);
});

test('__construct() overrides arguments with configuration array', function(): void
{
    $accessToken = uniqid();

    $state = new SdkState(
        configuration: [
            'accessToken' => $accessToken,
        ],
        accessToken: 'nonsense'
    );

    expect($state->getAccessToken())->toEqual($accessToken);
});

test('__construct() does not accept invalid types from configuration array', function(): void
{
    new SdkState(
        configuration: [
            'user' => 'nonsense',
        ]
    );
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'user'));

test('IdToken methods function as expected', function(): void
{
    $state = new SdkState();
    $mock = uniqid();

    expect($state->hasIdToken())->toBeFalse();
    expect($state->getIdToken())->toBeNull();

    $state->setIdToken($mock);
    expect($state->hasIdToken())->toBeTrue();
    expect($state->getIdToken())->toEqual($mock);

    $state->setIdToken(null);
    expect($state->hasIdToken())->toBeFalse();
    expect($state->getIdToken())->toBeNull();

    $state->setIdToken($mock);
    expect($state->hasIdToken())->toBeTrue();
    expect($state->getIdToken())->toEqual($mock);

    $state->setIdToken('');
    expect($state->hasIdToken())->toBeFalse();
    expect($state->getIdToken())->toBeNull();
});

test('getIdToken() throws an assigned exception when not configured', function(): void
{
    $state = new SdkState();
    $state->getIdToken(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('AccessToken methods function as expected', function(): void
{
    $state = new SdkState();
    $mock = uniqid();

    expect($state->hasAccessToken())->toBeFalse();
    expect($state->getAccessToken())->toBeNull();

    $state->setAccessToken($mock);
    expect($state->hasAccessToken())->toBeTrue();
    expect($state->getAccessToken())->toEqual($mock);

    $state->setAccessToken(null);
    expect($state->hasAccessToken())->toBeFalse();
    expect($state->getAccessToken())->toBeNull();

    $state->setAccessToken($mock);
    expect($state->hasAccessToken())->toBeTrue();
    expect($state->getAccessToken())->toEqual($mock);

    $state->setAccessToken('');
    expect($state->hasAccessToken())->toBeFalse();
    expect($state->getAccessToken())->toBeNull();
});

test('getAccessToken() throws an assigned exception when not configured', function(): void
{
    $state = new SdkState();
    $state->getAccessToken(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('AccessTokenScope methods function as expected', function(): void
{
    $state = new SdkState();

    $mock = uniqid();

    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->setAccessTokenScope([$mock]);
    expect($state->hasAccessTokenScope())->toBeTrue();
    expect($state->getAccessTokenScope())->toEqual([$mock]);

    $state->setAccessTokenScope(null);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->setAccessTokenScope([]);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->setAccessTokenScope([$mock, null, $mock]);
    expect($state->hasAccessTokenScope())->toBeTrue();
    expect($state->getAccessTokenScope())->toEqual([$mock]);

    $state->setAccessTokenScope([null]);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->setAccessTokenScope([null, null]);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->setAccessTokenScope([$mock, null, $mock . 'x']);
    expect($state->hasAccessTokenScope())->toBeTrue();
    expect($state->getAccessTokenScope())->toEqual([$mock, $mock . 'x']);

    $state->setAccessTokenScope([null, '', null]);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->pushAccessTokenScope('');
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->pushAccessTokenScope([]);
    expect($state->hasAccessTokenScope())->toBeFalse();
    expect($state->getAccessTokenScope())->toBeNull();

    $state->pushAccessTokenScope('123');
    expect($state->hasAccessTokenScope())->toBeTrue();
    expect($state->getAccessTokenScope())->toEqual(['123']);

    $state->pushAccessTokenScope([null, 456, null, '', 'test']);
    expect($state->hasAccessTokenScope())->toBeTrue();
    expect($state->getAccessTokenScope())->toEqual(['123', '456', 'test']);
});

test('RefreshToken methods function as expected', function(): void
{
    $state = new SdkState();
    $refreshToken = uniqid();

    expect($state->hasRefreshToken())->toBeFalse();
    expect($state->getRefreshToken())->toBeNull();

    $state->setRefreshToken($refreshToken);
    expect($state->getRefreshToken())->toEqual($refreshToken);
});

test('Backchannel methods function as expected', function(): void
{
    $state = new SdkState();
    $logoutToken = uniqid();

    expect($state->hasBackchannel())->toBeFalse();
    expect($state->getBackchannel())->toBeNull();

    $state->setBackchannel('');

    expect($state->hasBackchannel())->toBeFalse();
    expect($state->getBackchannel())->toBeNull();

    $state->setBackchannel($logoutToken);
    expect($state->getBackchannel())->toEqual($logoutToken);
});

test('getRefreshToken() throws an assigned exception when not configured', function(): void
{
    $state = new SdkState();
    $state->getRefreshToken(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('User methods function as expected', function(): void
{
    $state = new SdkState();
    $user = [uniqid()];

    expect($state->hasUser())->toBeFalse();
    expect($state->getUser())->toBeNull();

    $state->setUser($user);
    expect($state->getUser())->toEqual($user);
});

test('getUser() throws an assigned exception when not configured', function(): void
{
    $state = new SdkState();
    $state->getUser(new Exception('This should be thrown'));
})->throws(Exception::class, 'This should be thrown');

test('AccessTokenExpiration methods function as expected', function(): void
{
    $state = new SdkState();

    expect($state->hasAccessTokenExpiration())->toBeFalse();
    expect($state->getAccessTokenExpiration())->toBeNull();

    $state->setAccessTokenExpiration(100);
    expect($state->getAccessTokenExpiration())->toEqual(100);
});

test('setAccessTokenExpiration() throws a ConfigurationException when a negative value is provided', function(): void
{
    $state = new SdkState();
    $state->setAccessTokenExpiration(-100);
})->throws(ConfigurationException::class, sprintf(ConfigurationException::MSG_VALIDATION_FAILED, 'accessTokenExpiration'));
