<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\Utility;

use Auth0\SDK\Utility\PKCE;
use PHPUnit\Framework\TestCase;

/**
 * Class PKCETest.
 */
class PKCETest extends TestCase
{
    public function testThatGenerateCodeVerifierThrowsExceptionWhenLengthIsInvalid(): void
    {
        $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
        $this->expectExceptionMessage(\Auth0\SDK\Exception\ArgumentException::MSG_PKCE_CODE_VERIFIER_LENGTH);
        PKCE::generateCodeVerifier(10);
    }

    public function testThatGenerateCodeVerifierGenerateExpectedValue(): void
    {
        $code_verifier = PKCE::generateCodeVerifier(43);
        $this->assertNotEmpty($code_verifier);
        $this->assertSame(43, mb_strlen($code_verifier));
    }

    public function testThanGenerateCodeChallengeGenerateExpectedValue(): void
    {
        $codeVerifier = 'Q6D5aiJHs6QdEILJoCz5pFw3Wmi9UiP8ovQbvlgd3Gc';
        $code_challenge = PKCE::generateCodeChallenge($codeVerifier);
        $this->assertNotEmpty($code_challenge);
        $this->assertSame('f3X4JO4FpNodO254hdZAMCYKE4fzFn8ezYlLUr5qjH4', $code_challenge);
    }
}
