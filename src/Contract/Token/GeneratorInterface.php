<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\Token;

use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use OpenSSLAsymmetricKey;

interface GeneratorInterface
{
    /**
     * Generate a new token and return it as a string.
     *
     * @throws TokenException
     */
    public function __toString(): string;

    /**
     * Generate a new token and return it as an array.
     *
     * @param bool $encodeSegments Whether to encode the segments or not. Defaults to true.
     *
     * @throws TokenException If an error occurs while generating the token.
     *
     * @return array<mixed>
     */
    public function toArray(
        $encodeSegments = true,
    ): array;

    /**
     * Generate a new token and return it as a string.
     *
     * @throws TokenException
     */
    public function toString(): string;

    /**
     * Create a new token generator instance.
     *
     * @param OpenSSLAsymmetricKey|string $signingKey           Signing key to use for signing the token. This MUST be a string for HS256. MUST be either a string or OpenSSLAsymmetricKey for RS256.
     * @param string                      $algorithm            Algorithm to use for signing the token. Defaults to RS256.
     * @param array<mixed>                $claims               Claims to include in the token. Defaults to an empty array.
     * @param array<string>               $headers              Headers to include in the token. Defaults to an empty array. The the "alg" header will be set to represent $algorithm appropriately.
     * @param null|string                 $signingKeyPassphrase Optional. Passphrase to use for signing key if it is encrypted. Defaults to null.
     *
     * @throws TokenException When an unsupported algorithm is provided.
     * @throws TokenException When a non-string $signingKey is provided for HS256.
     * @throws TokenException When a string $signingKey is used with RS256.
     * @throws TokenException When using RS256 and openssl_pkey_get_private() is unable to load the provided signing key.
     */
    public static function create(
        OpenSSLAsymmetricKey | string $signingKey,
        string $algorithm = Token::ALGO_RS256,
        array $claims = [],
        array $headers = [],
        null | string $signingKeyPassphrase = null,
    ): static;
}
