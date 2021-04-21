<?php
namespace Auth0\Tests\unit\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Tokens\IdTokenVerifier;
use Auth0\SDK\Helpers\Tokens\SymmetricVerifier;
use Firebase\JWT\JWT;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token;
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
            $verifier->verify($token->toString());
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Issuer (iss) claim must be a string present in the ID token', $error_msg);
    }

    public function testThatTokenWithNonStringIssuerFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder = (new Token\Builder(new JoseEncoder(), ChainedFormatter::default()))->issuedBy(123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Issuer (iss) claim mismatch in the ID token; expected "__test_iss__", found "123"',
            $error_msg
        );
    }

    public function testThatTokenWithInvalidIssuerFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder = (new Token\Builder(new JoseEncoder(), ChainedFormatter::default()))->issuedBy('__invalid_issuer__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
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
        $builder   = (new Token\Builder(new JoseEncoder(), ChainedFormatter::default()))
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'));
        $token     = $builder->getToken(new HsSigner(), InMemory::plainText('__test_secret__'));

        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Subject (sub) claim must be a string present in the ID token', $error_msg);
    }

    public function testThatTokenWithNonStringSubFails()
    {
        $tokenData = [
            'aud' => '__test_aud__',
            'iss' => '__test_iss__',
            'sub' => 123,
            'exp' => time() + 1000,
        ];
        $token = JWT::encode($tokenData, '__test_secret__');

        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
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
            $verifier->verify($token->toString());
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
        $tokenData = [
            'aud' => ['__invalid_aud_1__', '__invalid_aud_2__'],
            'iss' => '__test_iss__',
        ];
        $token = JWT::encode($tokenData, '__test_secret__');

        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
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
            $verifier->verify($token->toString());
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Audience (aud) claim mismatch in the ID token; expected "__test_aud__" was not one of "__invalid_aud__"',
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
            $verifier->verify($token->toString());
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Expiration Time (exp) claim must be a number present in the ID token', $error_msg);
    }

    public function testThatTokenWithNonIntExpFails()
    {
        $tokenData = [
            'aud' => '__test_aud__',
            'iss' => '__test_iss__',
            'exp' => uniqid(),
        ];
        $token = JWT::encode($tokenData, '__test_secret__');

        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));

        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token could not be decoded', $error_msg);
    }

    public function testThatExpiredTokenFails()
    {
        $verifier  = new IdTokenVerifier('__test_iss__', '__test_aud__', new SymmetricVerifier('__test_secret__'));
        $builder   = SymmetricVerifierTest::getTokenBuilder()
            ->issuedBy('__test_iss__')
            ->permittedFor('__test_aud__')
            ->expiresAt(new \DateTimeImmutable('@' . 1000));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['time' => 10000, 'leeway' => 10]);
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
            ->expiresAt(new \DateTimeImmutable('@' . (time() + 1000)));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['nonce' => uniqid()]);
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('nonce', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['nonce' => uniqid()]);
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('nonce', '__invalid_nonce__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['nonce' => '__test_nonce__']);
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
            ->permittedFor('__test_aud__', '__test_aud_2__')
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
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
            ->permittedFor('__test_aud__', '__test_aud_2__')
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('azp', 123);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
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
            ->permittedFor('__test_aud__', '__test_aud_2__')
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('azp', '__invalid_azp__');
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString());
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'));
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['max_age' => uniqid()]);
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('auth_time', uniqid());
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->verify($token->toString(), ['max_age' => uniqid()]);
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('auth_time', 9000);
        $token     = SymmetricVerifierTest::getToken('__test_secret__', $builder);
        $error_msg = 'No exception caught';

        try {
            $verifier->setLeeway(0);
            $verifier->verify($token->toString(), ['time' => 10000, 'max_age' => 100]);
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
            ->expiresAt(new \DateTimeImmutable('+1000 seconds'))
            ->issuedAt(new \DateTimeImmutable('-1000 seconds'))
            ->withClaim('auth_time', 9000);
        $token    = SymmetricVerifierTest::getToken('__test_secret__', $builder);

        $decoded_token = $verifier->verify($token->toString());

        $this->assertEquals('__test_sub__', $decoded_token['sub']);
    }
}
