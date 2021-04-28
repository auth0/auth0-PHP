<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use Auth0\SDK\Helpers\Tokens\SymmetricVerifier;
use InvalidArgumentException as GlobalInvalidArgumentException;
use Lcobucci\JWT\Builder;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use RuntimeException;
use SebastianBergmann\RecursionContext\InvalidArgumentException;

class IdTokenVerifierTest extends TestCase
{
    /**
     * Test that empty token fails.
     *
     * @return void
     */
    public function testThatEmptyTokenFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier(uniqid()));
        $error_msg = 'No exception caught';

        try {
            $verifier->verify('');
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token is required but missing', $error_msg);
    }

    /**
     * Test that token missing issuer fails.
     *
     * @return void
     */
    public function testThatTokenMissingIssuerFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $token     = SymmetricVerifierTest::getToken();
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Issuer (iss) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token with non string issuer fails.
     *
     * @return void
     */
    public function testThatTokenWithNonStringIssuerFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = (new Builder())->withClaim('iss', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Issuer (iss) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token with invalid issuer fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidIssuerFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = (new Builder())->issuedBy('__invalid_issuer__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Issuer (iss) claim mismatch in the ID token; expected "__test_iss__", found "__invalid_issuer__"',
            $error_msg
        );
    }

    /**
     * Test that token with missing sub fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingSubFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = (new Builder())->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Subject (sub) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token with non string sub fails.
     *
     * @return void
     */
    public function testThatTokenWithNonStringSubFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->withClaim('sub', 123)->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Subject (sub) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token with missing aud fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Audience (aud) claim must be a string or array of strings present in the ID token',
            $error_msg
        );
    }

    /**
     * Test that token with non string or array aud fails.
     *
     * @return void
     */
    public function testThatTokenWithNonStringOrArrayAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', uniqid(), new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->withClaim('aud', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Audience (aud) claim must be a string or array of strings present in the ID token',
            $error_msg
        );
    }

    /**
     * Test that token with invalid array aud fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidArrayAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->withClaim('aud', ['__invalid_aud_1__', '__invalid_aud_2__']);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Audience (aud) claim mismatch in the ID token; expected "__test_aud__" was not one of "__invalid_aud_1__, __invalid_aud_2__"',
            $error_msg
        );
    }

    /**
     * Test that token with invalid string aud fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidStringAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__invalid_aud__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Audience (aud) claim mismatch in the ID token; expected "__test_aud__", found "__invalid_aud__"',
            $error_msg
        );
    }

    /**
     * Test that token with missing exp fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingExpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Expiration Time (exp) claim must be a number present in the ID token', $error_msg);
    }

    /**
     * Test that token with non int exp fails.
     *
     * @return void
     */
    public function testThatTokenWithNonIntExpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', uniqid());
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Expiration Time (exp) claim must be a number present in the ID token', $error_msg);
    }

    /**
     * Test that expired token fails.
     *
     * @return void
     */
    public function testThatExpiredTokenFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', 1000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['time' => 10000, 'leeway' => 10]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Expiration Time (exp) claim error in the ID token; current time (10000) is after expiration time (1010)',
            $error_msg
        );
    }

    /**
     * Test that token with missing iat fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingIatFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Issued At (iat) claim must be a number present in the ID token', $error_msg);
    }

    /**
     * Test that token without nonce fails.
     *
     * @return void
     */
    public function testThatTokenWithoutNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['nonce' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Nonce (nonce) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token non string nonce fails.
     *
     * @return void
     */
    public function testThatTokenNonStringNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('nonce', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['nonce' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Nonce (nonce) claim must be a string present in the ID token', $error_msg);
    }

    /**
     * Test that token with invalid nonce fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('nonce', '__invalid_nonce__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['nonce' => '__test_nonce__']);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Nonce (nonce) claim mismatch in the ID token; expected "__test_nonce__", found "__invalid_nonce__"',
            $error_msg
        );
    }

    /**
     * Test hat token with missing azp fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->withClaim('aud', ['__test_aud__', '__test_aud_2__'])->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authorized Party (azp) claim must be a string present in the ID token when Audience (aud) claim has multiple values',
            $error_msg
        );
    }

    /**
     * Test that token with non string azp fails
     *
     * @return void
     */
    public function testThatTokenWithNonStringAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->withClaim('aud', ['__test_aud__', '__test_aud_2__'])->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('azp', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authorized Party (azp) claim must be a string present in the ID token when Audience (aud) claim has multiple values',
            $error_msg
        );
    }

    /**
     * Test that token with invalid azp fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->withClaim('aud', ['__test_aud__', '__test_aud_2__'])->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('azp', '__invalid_azp__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authorized Party (azp) claim mismatch in the ID token; expected "__test_aud__", found "__invalid_azp__"',
            $error_msg
        );
    }

    /**
     * Test that token with missing auth time fails.
     *
     * @return void
     */
    public function testThatTokenWithMissingAuthTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['max_age' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authentication Time (auth_time) claim must be a number present in the ID token when Max Age (max_age) is specified',
            $error_msg
        );
    }

    /**
     * Test that token with non int auth time fails.
     *
     * @return void
     */
    public function testThatTokenWithNonIntAuthTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('auth_time', uniqid());
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['max_age' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authentication Time (auth_time) claim must be a number present in the ID token when Max Age (max_age) is specified',
            $error_msg
        );
    }

    /**
     * Test that token with invalid auth time time fails.
     *
     * @return void
     */
    public function testThatTokenWithInvalidAuthTimeTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', 11000)->withClaim('iat', 9000)->withClaim('auth_time', 9000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->setLeeway(0);
            $verifier->verify($token, ['time' => 10000, 'max_age' => 100]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Authentication Time (auth_time) claim in the ID token indicates that too much time has passed since the last end-user authentication. Current time (10000) is after last auth at 9100',
            $error_msg
        );
    }

    /**
     * Test that valid token returns claims.
     *
     * @return void
     */
    public function testThatValidTokenReturnsClaims()
    {
        $verifier = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder  = SymmetricVerifierTest::getTokenBuilder()->issuedBy('__test_iss__')->permittedFor('__test_aud__')->withClaim('exp', (time() + 1000))->withClaim('iat', (time() - 1000))->withClaim('auth_time', 9000);
        $token    = SymmetricVerifierTest::getToken('__test_secret__', $builder);

        $decoded_token = $verifier->verify($token);

        $this->assertEquals('__test_sub__', $decoded_token['sub']);
    }
}
