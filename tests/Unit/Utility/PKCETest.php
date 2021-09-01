<?php

declare(strict_types=1);

use Auth0\SDK\Utility\PKCE;

uses()->group('utility', 'utility.pkce');

test('generateCodeVerifier() throws an exception when an invalid length is used', function(): void {
    PKCE::generateCodeVerifier(10);
})->throws(\Auth0\SDK\Exception\ArgumentException::class, \Auth0\SDK\Exception\ArgumentException::MSG_PKCE_CODE_VERIFIER_LENGTH);

test('generateCodeVerifier() generates a value of an expected length', function(): void {
    $code_verifier = PKCE::generateCodeVerifier(43);

    $this->assertNotEmpty($code_verifier);
    expect(mb_strlen($code_verifier))->toEqual(43);
});

test('generateCodeChallenge() generates an expected value', function(): void {
    $codeVerifier = 'Q6D5aiJHs6QdEILJoCz5pFw3Wmi9UiP8ovQbvlgd3Gc';

    $code_challenge = PKCE::generateCodeChallenge($codeVerifier);

    $this->assertNotEmpty($code_challenge);
    expect($code_challenge)->toEqual('f3X4JO4FpNodO254hdZAMCYKE4fzFn8ezYlLUr5qjH4');
});
