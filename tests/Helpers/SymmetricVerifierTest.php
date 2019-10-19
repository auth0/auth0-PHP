<?php
namespace Auth0\Tests\Helpers;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\SymmetricVerifier;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsSigner;
use PHPUnit\Framework\TestCase;

/**
 * Class SymmetricVerifierTest.
 *
 * @package Auth0\Tests\Helpers
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
        $pkey_resource = openssl_pkey_new( [
            'digest_alg' => 'sha256',
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ] );
        openssl_pkey_export($pkey_resource, $rsa_private_key);

        $error_msg   = 'No exception caught';
        $rs256_token = self::getTokenBuilder()->getToken( new RsSigner(), new Key( $rsa_private_key ));

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
        $token     = self::getTokenBuilder()->getToken( new HsSigner(), new Key( '__invalid_secret__' ));

        try {
            $verifier = new SymmetricVerifier( '__test_secret__' );
            $verifier->verifyAndDecode( $token );
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
        $token = self::getTokenBuilder()->getToken( new HsSigner(), new Key( '__test_secret__' ));

        $verifier     = new SymmetricVerifier( '__test_secret__' );
        $decodedToken = $verifier->verifyAndDecode( $token );

        $this->assertEquals('__test_sub__', $decodedToken->getClaim('sub'));
    }

    private static function getTokenBuilder() : Builder
    {
        return (new Builder())->withClaim('sub', '__test_sub__');
    }
}
