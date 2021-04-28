<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\Helpers\Tokens;

use Auth0\SDK\Exception\InvalidTokenException;
use Auth0\SDK\Helpers\Tokens\AsymmetricVerifier;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256 as RsSigner;
use PHPUnit\Framework\TestCase;

/**
 * Class AsymmetricVerifierTest.
 */
class AsymmetricVerifierTest extends TestCase
{
    /**
     * Test that incorrect algorithms fail.
     *
     * @return void
     */
    public function testThatWrongAlgorithmFails()
    {
        $pkey_resource = openssl_pkey_new(
            [
                'digest_alg'       => 'sha256',
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ]
        );
        openssl_pkey_export($pkey_resource, $rsa_private_key);

        $error_msg   = 'No exception caught';
        $hs256_token = SymmetricVerifierTest::getToken();

        try {
            $verifier = new AsymmetricVerifier(['__test_kid__' => '__test_pem__']);
            $verifier->verifyAndDecode($hs256_token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals(
            'Signature algorithm of "HS256" is not supported. Expected the ID token to be signed with "RS256".',
            $error_msg
        );
    }

    /**
     * Test that invalid kids fail.
     *
     * @return void
     */
    public function testThatInvalidKidFails()
    {
        $error_msg = 'No exception caught';
        $rsa_keys  = self::getRsaKeys();
        $token     = self::getToken($rsa_keys['private']);

        try {
            $verifier = new AsymmetricVerifier(['__invalid_kid__' => $rsa_keys['public']]);
            $verifier->verifyAndDecode($token);
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('ID token key ID "__test_kid__" was not found in the JWKS', $error_msg);
    }

    /**
     * Test that invalid signatures fail.
     *
     * @return void
     */
    public function testThatInvalidSignatureFails()
    {
        $error_msg = 'No exception caught';
        $rsa_keys  = self::getRsaKeys();
        $token     = self::getToken($rsa_keys['private']);

        try {
            $verifier = new AsymmetricVerifier(['__test_kid__' => $rsa_keys['public']]);
            $verifier->verifyAndDecode($token . '__invalid_signature__');
        } catch (InvalidTokenException $e) {
            $error_msg = $e->getMessage();
        }

        $this->assertEquals('Invalid ID token signature', $error_msg);
    }

    /**
     * Test that token claims are returned.
     *
     * @return void
     */
    public function testThatTokenClaimsAreReturned()
    {
        $rsa_keys = self::getRsaKeys();
        $token    = self::getToken($rsa_keys['private']);

        $verifier     = new AsymmetricVerifier(['__test_kid__' => $rsa_keys['public']]);
        $decodedToken = $verifier->verifyAndDecode($token);

        $this->assertEquals('__test_sub__', $decodedToken->getClaim('sub'));
    }

    /**
     * Test that malformed tokens fail.
     *
     * @return void
     */
    public function testThatMalformedTokenFails()
    {
        $rsa_keys = self::getRsaKeys();
        $verifier = new AsymmetricVerifier(['__test_kid__' => $rsa_keys['public']]);
        $token    = 'a' . (string) self::getToken($rsa_keys['private']);

        $this->expectException(InvalidTokenException::class);
        $this->expectExceptionMessage('ID token could not be decoded');

        $verifier->verifyAndDecode($token);
    }

     /**
      * Generate a new RSA key pair.
      *
      * @return array
      */
    public static function getRsaKeys(): array
    {
        $pkey_resource = openssl_pkey_new(
            [
                'digest_alg'       => 'sha256',
                'private_key_type' => OPENSSL_KEYTYPE_RSA,
            ]
        );

        openssl_pkey_export($pkey_resource, $rsa_private_key);
        $public_key = openssl_pkey_get_details($pkey_resource);

        return [
            'private' => $rsa_private_key,
            'public'  => $public_key['key'],
        ];
    }

    /**
     * Create a new instance of the token builder.
     *
     * @return Builder
     */
    public static function getTokenBuilder(): Builder
    {
        return (new Builder())->withClaim('sub', '__test_sub__')->withHeader('kid', '__test_kid__');
    }

    /**
     * Generate a token from a private key using a token builder.
     *
     * @param string|null  $rsa_private_key Private key
     * @param Builder|null $builder         Build instance
     *
     * @return string
     */
    public static function getToken(string $rsa_private_key = null, Builder $builder = null): string
    {
        $rsa_private_key = ($rsa_private_key ?? self::getRsaKeys()['private']);
        $builder         = ($builder ?? self::getTokenBuilder());

        return (string) $builder->getToken(new RsSigner(), new Key($rsa_private_key));
    }
}
