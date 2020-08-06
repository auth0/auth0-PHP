<?php
namespace Auth0\Tests\unit\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use Auth0\SDK\Helpers\Tokens\SymmetricVerifier;
use Lcobucci\JWT\Builder;
use PHPUnit\Framework\TestCase;

class IdTokenVerifierTest extends TestCase
{
    public function testThatEmptyTokenFails()
    {
        $verifier  = new IdTokenVerifier( '__test_iss__', '__test_aud__', new SymmetricVerifier( uniqid() ) );
        $error_msg = 'No exception caught';

        try {
            $verifier->verify('');
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token is required but missing', $error_msg);
    }

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

    public function testThatTokenWithMissingSubFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = (new Builder())
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Subject (sub) claim must be a string present in the ID token', $error_msg);
    }

    public function testThatTokenWithNonStringSubFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->withClaim('sub', 123)
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Subject (sub) claim must be a string present in the ID token', $error_msg);
    }

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

    public function testThatTokenWithInvalidArrayAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->withClaim('aud', ['__invalid_aud_1__', '__invalid_aud_2__']);
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

    public function testThatTokenWithInvalidStringAudFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__invalid_aud__');
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

    public function testThatTokenWithMissingExpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Expiration Time (exp) claim must be a number present in the ID token', $error_msg);
    }

    public function testThatTokenWithNonIntExpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', uniqid());
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Expiration Time (exp) claim must be a number present in the ID token', $error_msg);
    }

    public function testThatExpiredTokenFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', 1000);
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

    public function testThatTokenWithMissingIatFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Issued At (iat) claim must be a number present in the ID token', $error_msg);
    }

    public function testThatTokenWithoutNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['nonce' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Nonce (nonce) claim must be a string present in the ID token', $error_msg);
    }

    public function testThatTokenNonStringNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('nonce', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token, ['nonce' => uniqid()]);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Nonce (nonce) claim must be a string present in the ID token', $error_msg);
    }

    public function testThatTokenWithInvalidNonceFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('nonce', '__invalid_nonce__');
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

    public function testThatTokenWithMissingAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->withClaim('aud', ['__test_aud__', '__test_aud_2__'])
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000);
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

    public function testThatTokenWithNonStringAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->withClaim('aud', ['__test_aud__', '__test_aud_2__'])
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('azp', 123);
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

    public function testThatTokenWithInvalidAzpFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->withClaim('aud', ['__test_aud__', '__test_aud_2__'])
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('azp', '__invalid_azp__');
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

    public function testThatTokenWithMissingAuthTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000);
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

    public function testThatTokenWithNonIntAuthTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('auth_time', uniqid());
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

    public function testThatTokenWithInvalidAuthTimeTimeFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', 11000)
            ->withClaim('iat', 9000)
            ->withClaim('auth_time', 9000);
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
     * @throws InvalidTokenException Should not be thrown in this test.
     */
    public function testThatValidTokenReturnsClaims()
    {
        $verifier = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder  = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->withClaim('exp', time() + 1000)
            ->withClaim('iat', time() - 1000)
            ->withClaim('auth_time', 9000);
        $token    = SymmetricVerifierTest::getToken('__test_secret__', $builder);

        $decoded_token = $verifier->verify($token);

        $this->assertEquals('__test_sub__', $decoded_token['sub']);
    }
}
