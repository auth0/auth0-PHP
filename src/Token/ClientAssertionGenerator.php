<?php

declare(strict_types=1);

namespace Auth0\SDK\Token;

use Auth0\SDK\Exception\TokenException;
use Auth0\SDK\Token;
use InvalidArgumentException;
use OpenSSLAsymmetricKey;

final class ClientAssertionGenerator
{
    /**
     * Supported signing algorithms.
     *
     * @var array<string>
     */
    public const CONST_SUPPORTED_ALGORITHMS = [
        Token::ALGO_RS256,
    ];

    /**
     * Create a JWT client assertion.
     *
     * @param string $domain The Auth0 domain to use.
     * @param string $clientId The Auth0 client ID to use.
     * @param OpenSSLAsymmetricKey|string $signingKey The signing key to use.
     * @param string $signingAlgorithm The signing algorithm to use.
     *
     * @return string The generated JWT.
     *
     * @throws InvalidArgumentException If an invalid signing algorithm is provided.
     * @throws TokenException If an error occurs during signing.
     */
    public static function create(
        string $domain,
        string $clientId,
        OpenSSLAsymmetricKey|string $signingKey,
        string $signingAlgorithm = Token::ALGO_RS256,
    ): string {
        if (! in_array($signingAlgorithm, self::CONST_SUPPORTED_ALGORITHMS, true)) {
            throw TokenException::unsupportedAlgorithm($signingAlgorithm, implode(',', self::CONST_SUPPORTED_ALGORITHMS));
        }

        $now = time();

        $claims = [
            'iss' => $clientId,
            'sub' => $clientId,
            'aud' => $domain,
            'iat' => $now,
            'exp' => $now + 180,
            'jti' => hash('sha256', implode(':', [uniqid(microtime(), true), bin2hex(random_bytes(32))]))
        ];

        return (string) Generator::create(
            signingKey: $signingKey,
            algorithm: $signingAlgorithm,
            claims: $claims,
        );
    }
}
