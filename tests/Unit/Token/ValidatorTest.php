<?php

declare(strict_types=1);

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Token\Validator;

uses()->group('token', 'token.validator');

beforeEach(function() {
    $this->claims = [
        'sub' => uniqid(),
        'sid' => uniqid(),
        'iss' => uniqid(),
        'sid' => uniqid(),
        'aud' => uniqid(),
        'nonce' => uniqid(),
        'auth_time' => time() - 100,
        'exp' => time() + 1000,
        'iat' => time() - 1000,
        'azp' => uniqid(),
    ];
});

test('audience() throws an exception when `aud` claim is missing', function(): void {
    unset($this->claims['aud']);
    (new Validator($this->claims))->audience(['missing']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_AUDIENCE_CLAIM);

test('authTime() throws an exception when `auth_time` claim is missing', function(): void {
    unset($this->claims['auth_time']);
    (new Validator($this->claims))->authTime(100);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_AUTH_TIME_CLAIM);

test('authTime() throws an exception when `auth_time` claim has passed', function(): void {
    $then = time() - 1000;
    $now = $then + 2000;

    $this->claims['auth_time'] = $then;
    (new Validator($this->claims))->authTime(0, 0, $now);
})->throws(InvalidTokenException::class);

test('authorizedParty() throws an exception when `aud` claim is missing', function(): void {
    unset($this->claims['aud']);
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_AUDIENCE_CLAIM);

test('authorizedParty() throws an exception when `azp` claim is missing', function(): void {
    $this->claims['aud'] = [uniqid(), uniqid()];
    unset($this->claims['azp']);
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_AZP_CLAIM);

test('authorizedParty() throws an exception when `azp` is not present in `aud` claims', function(): void {
    $this->claims['aud'] = [uniqid(), uniqid()];
    $this->claims['azp'] = 'mismatch';
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_MISMATCHED_AZP_CLAIM, 'missing', 'mismatch'));

test('expiration() throws an exception when `exp` claim is missing', function(): void {
    unset($this->claims['exp']);
    (new Validator($this->claims))->expiration();
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_EXP_CLAIM);

test('expiration() throws an exception when `exp` claim is less than present time', function(): void {
    $this->claims['exp'] = time() - 1000;
    (new Validator($this->claims))->expiration();
})->throws(InvalidTokenException::class);

test('identifier() throws an exception when `sid` claim is missing', function(): void {
    unset($this->claims['sid']);
    (new Validator($this->claims))->identifier();
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_SID_CLAIM);

test('issued() throws an exception when `iat` claim is missing', function(): void {
    unset($this->claims['iat']);
    (new Validator($this->claims))->issued();
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_IAT_CLAIM);

test('issuer() throws an exception when `iss` claim is missing', function(): void {
    unset($this->claims['iss']);
    (new Validator($this->claims))->issuer(uniqid());
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_ISS_CLAIM);

test('issuer() throws an exception when `iss` claim is mismatched', function(): void {
    (new Validator($this->claims))->issuer(uniqid());
})->throws(InvalidTokenException::class);

test('nonce() throws an exception when `nonce` claim is missing', function(): void {
    unset($this->claims['nonce']);
    (new Validator($this->claims))->nonce(uniqid());
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_NONCE_CLAIM);

test('nonce() throws an exception when `nonce` claim is mismatched', function(): void {
    (new Validator($this->claims))->nonce(uniqid());
})->throws(InvalidTokenException::class);

test('subject() throws an exception when `sub` claim is missing', function(): void {
    unset($this->claims['sub']);
    (new Validator($this->claims))->subject();
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_SUB_CLAIM);

test('organization() throws an exception when a `org_id` claim is expected but not found', function(): void {
    (new Validator($this->claims))->organization(['org_123']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_MISSING);

test('organization() throws an exception when a `org_name` claim is expected but not found', function(): void {
    (new Validator($this->claims))->organization(['organizationTesting123']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_MISSING);

test('organization() does not throw an exception when wildcard organizations are configured', function(): void {
    $this->claims['org_id'] = uniqid();
    $validator = (new Validator($this->claims))->organization(['*']);
    expect($validator)->toBeInstanceOf(Validator::class);
});

test('organization() throws an exception when either a `org_id` claim is an unexpected type', function(): void {
    $this->claims['org_id'] = true;
    (new Validator($this->claims))->organization(['org_123']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_BAD);

test('organization() throws an exception when either a `org_name` claim is an unexpected type', function(): void {
    $this->claims['org_name'] = true;
    (new Validator($this->claims))->organization(['organizationTesting123']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_BAD);

test('organization() throws an exception when an unexpected `org_id` claim is encountered', function(): void {
    $this->claims['org_id'] = uniqid();
    (new Validator($this->claims))->organization([]);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_UNEXPECTED);

test('organization() throws an exception when an unexpected `org_name` claim is encountered', function(): void {
    $this->claims['org_name'] = uniqid();
    (new Validator($this->claims))->organization([]);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_ORGANIZATION_CLAIM_UNEXPECTED);

test('organization() does not throw an exception when there are no organization claims and no allowlist configured', function(): void {
    $validator = (new Validator($this->claims))->organization([]);
    expect($validator)->toBeInstanceOf(Validator::class);
});

test('identifier() returns a valid `sid` claim', function(): void {
    $validator = (new Validator($this->claims))->identifier();
    expect($validator)->toBeInstanceOf(Validator::class);
});

test('events() throws an exception when `events` claim is missing', function(): void {
    unset($this->claims['events']);
    (new Validator($this->claims))->events(['missing']);
})->throws(InvalidTokenException::class, InvalidTokenException::MSG_MISSING_EVENTS_CLAIM);

test('events() throws an exception when `events` claim is malformed', function(): void {
    $this->claims['events'] = [
        // 'http://schemas.openid.net/event/backchannel-logout' => 'not an array',
    ];

    (new Validator($this->claims))->events(['http://schemas.openid.net/event/backchannel-logout']);
})->throws(InvalidTokenException::class, sprintf(InvalidTokenException::MSG_MISMATCHED_EVENTS_CLAIM, 'http://schemas.openid.net/event/backchannel-logout', ''));
