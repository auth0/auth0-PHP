<?php
namespace Auth0\Tests\unit\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Tokens\SymmetricVerifier;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Token;
use PHPUnit\Framework\TestCase;

/**
 * Class SymmetricVerifierTest.
 *
 * @package Auth0\Tests\unit\Helpers\Tokens
 */
class SymmetricVerifierTest extends TestCase
{
    public function testThatFormatCheckFails()
    {
        $error_msg = 'No exception caught';

        try {
            $verifier = new SymmetricVerifier( '__test_secret__' );
            $verifier->verifyAndDecode( uniqid().'.'.uniqid() );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token could not be decoded', $error_msg);
    }

    public function testThatAlgorithmNoneFails()
    {
        $error_msg      = 'No exception caught';
        $unsigned_token = self::getTokenBuilder()->getToken();

        try {
            $verifier = new SymmetricVerifier( '__test_secret__' );
            $verifier->verifyAndDecode( $unsigned_token );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Signature algorithm of "none" is not supported. Expected the ID token to be signed with "HS256".',
            $error_msg
        );
    }

    public function testThatWrongAlgorithmFails()
    {
        $rsa_keys    = AsymmetricVerifierTest::getRsaKeys();
        $rs256_token = AsymmetricVerifierTest::getToken( $rsa_keys['private'] );
        $error_msg   = 'No exception caught';

        try {
            $verifier = new SymmetricVerifier( '__test_secret__' );
            $verifier->verifyAndDecode( $rs256_token );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Signature algorithm of "RS256" is not supported. Expected the ID token to be signed with "HS256".',
            $error_msg
        );
    }

    public function testThatInvalidSignatureFails()
    {
        $error_msg = 'No exception caught';
        try {
            $verifier = new SymmetricVerifier( '__test_secret__' );
            $verifier->verifyAndDecode( self::getToken( '__invalid_secret__' ) );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Invalid ID token signature', $error_msg);
    }

    /**
     * @throws InvalidTokenException Should not be thrown in this test.
     */
    public function testThatTokenClaimsAreReturned()
    {
        $verifier     = new SymmetricVerifier( '__test_secret__' );
        $decodedToken = $verifier->verifyAndDecode( self::getToken() );

        $this->assertEquals('__test_sub__', $decodedToken->getClaim('sub'));
    }

    /*
     * Helper methods
     */

    /**
     * Returns a token builder with a default sub claim.
     *
     * @return Builder
     */
    public static function getTokenBuilder() : Builder
    {
        return (new Builder())->withClaim('sub', '__test_sub__');
    }

    /**
     * @param string $secret Symmetric key to sign.
     * @param Builder $builder Builder to use, null to create
     *
     * @return Token
     */
    public static function getToken(string $secret = '__test_secret__', Builder $builder = null) : Token
    {
        $builder = $builder ?? self::getTokenBuilder();
        return $builder->getToken( new HsSigner(), new Key($secret));
    }
}
