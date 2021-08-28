<?php

declare(strict_types=1);

use Auth0\SDK\Utility\PKCE;

uses()->group('pkce', 'utility', 'utility.pkce');

test('generateCodeVerifier() throws an exception when an invalid length is used', function(): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(\Auth0\SDK\Exception\ArgumentException::MSG_PKCE_CODE_VERIFIER_LENGTH);

    PKCE::generateCodeVerifier(10);
});

test('generateCodeVerifier() generates a value of an expected length', function(): void {
    $code_verifier = PKCE::generateCodeVerifier(43);

    $this->assertNotEmpty($code_verifier);
    $this->assertEquals(43, mb_strlen($code_verifier));
});

test('generateCodeChallenge() generates an expected value', function(): void {
    $codeVerifier = 'Q6D5aiJHs6QdEILJoCz5pFw3Wmi9UiP8ovQbvlgd3Gc';

    $code_challenge = PKCE::generateCodeChallenge($codeVerifier);

    $this->assertNotEmpty($code_challenge);
    $this->assertEquals('f3X4JO4FpNodO254hdZAMCYKE4fzFn8ezYlLUr5qjH4', $code_challenge);
});
