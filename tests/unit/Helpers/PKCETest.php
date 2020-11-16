<?php
namespace Auth0\Tests\unit\Helpers;

use Auth0\SDK\Helpers\PKCE;
use PHPUnit\Framework\TestCase;

/**
 * Class PKCETest
 *
 * @package Auth0\Tests\unit\Helpers
 */
class PKCETest extends TestCase
{
    public function testThatGenerateCodeVerifierThrowsExceptionWhenLengthIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Code verifier must be created with a minimum length of 43 characters and a maximum length of 128 characters.');
        PKCE::generateCodeVerifier(10);
    }

    public function testThatGenerateCodeVerifierGenerateExpectedValue()
	{
		$code_verifier = PKCE::generateCodeVerifier(43);
		$this->assertNotEmpty($code_verifier);
		$this->assertSame(43, strlen($code_verifier));
	}

    public function testThanGenerateCodeChallengeGenerateExpectedValue()
    {
		$codeVerifier = 'Q6D5aiJHs6QdEILJoCz5pFw3Wmi9UiP8ovQbvlgd3Gc';
		$code_challenge = PKCE::generateCodeChallenge($codeVerifier);
		$this->assertNotEmpty($code_challenge);
		$this->assertSame('f3X4JO4FpNodO254hdZAMCYKE4fzFn8ezYlLUr5qjH4', $code_challenge);
    }
}
