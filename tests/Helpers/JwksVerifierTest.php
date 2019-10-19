<?php
namespace Auth0\Tests\Helpers;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\JwksVerifier;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256 as HsSigner;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsSigner;
use Lcobucci\JWT\Token;
use PHPUnit\Framework\TestCase;

/**
 * Class JwksVerifierTest.
 *
 * @package Auth0\Tests\Helpers
 */
class JwksVerifierTest extends TestCase
{
    public function testThatWrongAlgorithmFails()
    {
        $pkey_resource = openssl_pkey_new( [
            'digest_alg' => 'sha256',
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ] );
        openssl_pkey_export($pkey_resource, $rsa_private_key);

        $error_msg   = 'No exception caught';
        $hs256_token = SymmetricVerifierTest::getToken();

        try {
            $verifier = new JwksVerifier( [ '__test_kid__' => '__test_pem__' ] );
            $verifier->verifyAndDecode( $hs256_token );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Signature algorithm of "HS256" is not supported. Expected the ID token to be signed with "RS256".',
            $error_msg
        );
    }

    public function testThatInvalidKidFails()
    {
        $error_msg = 'No exception caught';
        $rsa_keys  = self::getRsaKeys();
        $token     = self::getToken($rsa_keys['private']);

        try {
            $verifier = new JwksVerifier( [ '__invalid_kid__' => $rsa_keys['public'] ] );
            $verifier->verifyAndDecode( $token );
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token key ID "__test_kid__" was not found in the JWKS', $error_msg);
    }

    public function testThatInvalidSignatureFails()
    {
        $error_msg = 'No exception caught';
        $rsa_keys  = self::getRsaKeys();
        $token     = self::getToken($rsa_keys['private']);

        try {
            $verifier = new JwksVerifier( [ '__test_kid__' => $rsa_keys['public'] ] );
            $verifier->verifyAndDecode( $token.'__invalid_signature__' );
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
        $rsa_keys = self::getRsaKeys();
        $token    = self::getToken($rsa_keys['private']);

        $verifier     = new JwksVerifier( [ '__test_kid__' => $rsa_keys['public'] ] );
        $decodedToken = $verifier->verifyAndDecode( $token );

        $this->assertEquals('__test_sub__', $decodedToken->getClaim('sub'));
    }

    /*
     * Helper methods
     */

    public static function getRsaKeys() : array
    {
        $pkey_resource = openssl_pkey_new( [
            'digest_alg' => 'sha256',
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ] );

        openssl_pkey_export($pkey_resource, $rsa_private_key);
        $public_key = openssl_pkey_get_details($pkey_resource);

        return [
            'private' => $rsa_private_key,
            'public' => $public_key['key'],
        ];
    }

    public static function getTokenBuilder() : Builder
    {
        return (new Builder())->withClaim('sub', '__test_sub__')->withHeader('kid', '__test_kid__');
    }

    public static function getToken(string $rsa_private_key, Builder $builder = null) : Token
    {
        $builder = $builder ?? self::getTokenBuilder();
        return $builder->getToken( new RsSigner(), new Key( $rsa_private_key ));
    }
}
