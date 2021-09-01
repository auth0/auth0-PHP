<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Token\Validator;
use Auth0\Tests\Utilities\TokenGenerator;
use Auth0\Tests\Utilities\TokenGeneratorResponse;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

uses()->group('token', 'token.validator');

beforeEach(function() {
    $this->claims = [
        'sub' => uniqid(),
        'iss' => uniqid(),
        'aud' => uniqid(),
        'nonce' => uniqid(),
        'auth_time' => time() - 100,
        'exp' => time() + 1000,
        'iat' => time() - 1000,
        'azp' => uniqid()
    ];
});

test('audience() throws an exception when `aud` claim is missing', function(): void {
    unset($this->claims['aud']);
    (new Validator($this->claims))->audience(['missing']);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_AUDIENCE_CLAIM);

test('authTime() throws an exception when `auth_time` claim is missing', function(): void {
    unset($this->claims['auth_time']);
    (new Validator($this->claims))->authTime(100);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_AUTH_TIME_CLAIM);

test('authorizedParty() throws an exception when `aud` claim is missing', function(): void {
    unset($this->claims['aud']);
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_AUDIENCE_CLAIM);

test('authorizedParty() throws an exception when `azp` claim is missing', function(): void {
    $this->claims['aud'] = [uniqid(), uniqid()];
    unset($this->claims['azp']);
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_AZP_CLAIM);

test('authorizedParty() throws an exception when `azp` is not present in `aud` claims', function(): void {
    $this->claims['aud'] = [uniqid(), uniqid()];
    $this->claims['azp'] = 'mismatch';
    (new Validator($this->claims))->authorizedParty(['missing']);
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, sprintf(\Auth0\SDK\Exception\InvalidTokenException::MSG_MISMATCHED_AZP_CLAIM, 'missing', 'mismatch'));

test('expiration() throws an exception when `exp` claim is missing', function(): void {
    unset($this->claims['exp']);
    (new Validator($this->claims))->expiration();
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_EXP_CLAIM);

test('expiration() throws an exception when `exp` claim is less than present time', function(): void {
    $this->claims['exp'] = time() - 1000;
    (new Validator($this->claims))->expiration();
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('issued() throws an exception when `iat` claim is missing', function(): void {
    unset($this->claims['iat']);
    (new Validator($this->claims))->issued();
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_IAT_CLAIM);

test('issuer() throws an exception when `iss` claim is missing', function(): void {
    unset($this->claims['iss']);
    (new Validator($this->claims))->issuer(uniqid());
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_ISS_CLAIM);

test('issuer() throws an exception when `iss` claim is mismatched', function(): void {
    (new Validator($this->claims))->issuer(uniqid());
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('nonce() throws an exception when `nonce` claim is missing', function(): void {
    unset($this->claims['nonce']);
    (new Validator($this->claims))->nonce(uniqid());
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_NONCE_CLAIM);

test('nonce() throws an exception when `nonce` claim is mismatched', function(): void {
    (new Validator($this->claims))->nonce(uniqid());
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class);

test('subject() throws an exception when `sub` claim is missing', function(): void {
    unset($this->claims['sub']);
    (new Validator($this->claims))->subject();
})->throws(\Auth0\SDK\Exception\InvalidTokenException::class, \Auth0\SDK\Exception\InvalidTokenException::MSG_MISSING_SUB_CLAIM);
