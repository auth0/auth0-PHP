<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class InvalidTokenException extends \Auth0\SDK\Exception\CoreException implements \Throwable
{
    public static function badSeparators(): self
    {
        return new self('The JWT string must contain two dots');
    }

    public static function badSignature(): self
    {
        return new self('Cannot verify signature');
    }

    public static function badSignatureMissingKid(): self
    {
        return new self('Cannot verify signature: JWKS did not contain the key specified by the token');
    }

    public static function badSignatureIncompatibleAlgorithm(): self
    {
        return new self('Cannot verify signature: Key uses an incompatible signing algorithm');
    }

    public static function requiresClientSecret(): self
    {
        return new self('Cannot verify signature: Client secret must be configured to verify HS256 signatures');
    }

    public static function requiresJwksUri(): self
    {
        return new self('Cannot verify signature: JWKS uri was not configured properly');
    }

    public static function unexpectedSigningAlgorithm(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Expected token signed with "%s" algorithm, but token uses "%s"', $expected, $found));
    }

    public static function unsupportedSigningAlgorithm(
        string $algorithm
    ): self {
        return new self(sprintf('Signature algorithm of "%s" is not supported. Expected the token to be signed with "RS256" or "HS256"', $algorithm));
    }

    public static function missingKidHeader(): self
    {
        return new self('Provided token is missing a kid header');
    }

    public static function missingAudienceClaim(): self
    {
        return new self('Audience (aud) claim must be a string or array of strings present in the token');
    }

    public static function missingAzpClaim(): self
    {
        return new self('Authorized Party (azp) claim must be a string present in the token when Audience (aud) claim has multiple values');
    }

    public static function missingAuthTimeClaim(): self
    {
        return new self('Authentication Time (auth_time) claim must be a number present in the token when Max Age is specified');
    }

    public static function missingExpClaim(): self
    {
        return new self('Expiration Time (exp) claim must be a number present in the token');
    }

    public static function missingIatClaim(): self
    {
        return new self('Issued At (iat) claim must be a number present in the token');
    }

    public static function missingIssClaim(): self
    {
        return new self('Issuer (iss) claim must be a string present in the token');
    }

    public static function missingNonceClaim(): self
    {
        return new self('Nonce (nonce) claim must be a string present in the token');
    }

    public static function missingOrgIdClaim(): self
    {
        return new self('Organization Id (org_id) claim must be a string present in the token');
    }

    public static function missingSubClaim(): self
    {
        return new self('Subject (sub) claim must be a string present in the token');
    }

    public static function mismatchedAzpClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Authorized Party (azp) claim mismatch in the ID token; expected "%s", found "%s"', $expected, $found));
    }

    public static function mismatchedAudClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Audience (aud) claim mismatch in the token; expected "%s", found "%s"', $expected, $found));
    }

    public static function mismatchedAuthTimeClaim(
        int $now,
        int $expired
    ): self {
        return new self(sprintf('Authentication Time (auth_time) claim in the token indicates that too much time has passed since the last end-user authentication. Current time %d is after last auth at %d', $now, $expired));
    }

    public static function mismatchedExpClaim(
        int $now,
        int $expired
    ): self {
        return new self(sprintf('Expiration Time (exp) claim error in the token; current time %d is after expiration time %d', $now, $expired));
    }

    public static function mismatchedIssClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Issuer (iss) claim mismatch in the token; expected "%s", found "%s"', $expected, $found));
    }

    public static function mismatchedNonceClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Nonce (nonce) claim mismatch in the token; expected "%s", found "%s"', $expected, $found));
    }

    public static function mismatchedOrgIdClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf('Organization Id (org_id) claim value mismatch in the token; expected "%s", found "%s"', $expected, $found));
    }
}
