<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class InvalidTokenException extends \Auth0\SDK\Exception\SdkException implements \Throwable
{
    public const MSG_BAD_SEPARATORS = 'The JWT string must contain two dots';
    public const MSG_BAD_SIGNATURE = 'Cannot verify signature';
    public const MSG_BAD_SIGNATURE_MISSING_KID = 'Cannot verify signature: JWKS did not contain the key specified by the token';
    public const MSG_BAD_SIGNATURE_INCOMPATIBLE_ALGORITHM = 'Cannot verify signature: Key uses an incompatible signing algorithm';
    public const MSG_REQUIRES_CLIENT_SECRET = 'Cannot verify signature: Client secret must be configured to verify HS256 signatures';
    public const MSG_REQUIRES_JWKS_URI = 'Cannot verify signature: JWKS uri was not configured properly';
    public const MSG_UNEXPECTED_SIGNING_ALGORITHM = 'Expected token signed with "%s" algorithm, but token uses "%s"';
    public const MSG_UNSUPPORTED_SIGNING_ALGORITHM = 'Signature algorithm of "%s" is not supported. Expected the token to be signed with "RS256" or "HS256"';
    public const MSG_MISSING_AUDIENCE_CLAIM = 'Audience (aud) claim must be a string or array of strings present in the token';
    public const MSG_MISSING_AUTH_TIME_CLAIM = 'Authentication Time (auth_time) claim must be a number present in the token when Max Age is specified';
    public const MSG_MISSING_AZP_CLAIM = 'Authorized Party (azp) claim must be a string present in the token when Audience (aud) claim has multiple values';
    public const MSG_MISSING_EXP_CLAIM = 'Expiration Time (exp) claim must be a number present in the token';
    public const MSG_MISSING_IAT_CLAIM = 'Issued At (iat) claim must be a number present in the token';
    public const MSG_MISSING_ISS_CLAIM = 'Issuer (iss) claim must be a string present in the token';
    public const MSG_MISSING_NONCE_CLAIM = 'Nonce (nonce) claim must be a string present in the token';
    public const MSG_MISSING_ORG_ID_CLAIM = 'Organization Id (org_id) claim must be a string present in the token';
    public const MSG_MISSING_SUB_CLAIM = 'Subject (sub) claim must be a string present in the token';
    public const MSG_MISSING_ALG_HEADER = 'Provided token is missing a alg header';
    public const MSG_MISSING_KID_HEADER = 'Provided token is missing a kid header';
    public const MSG_MISMATCHED_AUD_CLAIM = 'Audience (aud) claim mismatch in the token; expected "%s", found "%s"';
    public const MSG_MISMATCHED_AUTH_TIME_CLAIM = 'Authentication Time (auth_time) claim in the token indicates that too much time has passed since the last end-user authentication. Current time %d is after last auth at %d';
    public const MSG_MISMATCHED_AZP_CLAIM = 'Authorized Party (azp) claim mismatch in the ID token; expected "%s", found "%s"';
    public const MSG_MISMATCHED_EXP_CLAIM = 'Expiration Time (exp) claim error in the token; current time %d is after expiration time %d';
    public const MSG_MISMATCHED_ISS_CLAIM = 'Issuer (iss) claim mismatch in the token; expected "%s", found "%s"';
    public const MSG_MISMATCHED_NONCE_CLAIM = 'Nonce (nonce) claim mismatch in the token; expected "%s", found "%s"';
    public const MSG_MISMATCHED_ORG_ID_CLAIM = 'Organization Id (org_id) claim value mismatch in the token; expected "%s", found "%s"';

    public static function badSeparators(): self
    {
        return new self(self::MSG_BAD_SEPARATORS);
    }

    public static function badSignature(): self
    {
        return new self(self::MSG_BAD_SIGNATURE);
    }

    public static function badSignatureMissingKid(): self
    {
        return new self(self::MSG_BAD_SIGNATURE_MISSING_KID);
    }

    public static function badSignatureIncompatibleAlgorithm(): self
    {
        return new self(self::MSG_BAD_SIGNATURE_INCOMPATIBLE_ALGORITHM);
    }

    public static function requiresClientSecret(): self
    {
        return new self(self::MSG_REQUIRES_CLIENT_SECRET);
    }

    public static function requiresJwksUri(): self
    {
        return new self(self::MSG_REQUIRES_JWKS_URI);
    }

    public static function unexpectedSigningAlgorithm(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_UNEXPECTED_SIGNING_ALGORITHM, $expected, $found));
    }

    public static function unsupportedSigningAlgorithm(
        string $algorithm
    ): self {
        return new self(sprintf(self::MSG_UNSUPPORTED_SIGNING_ALGORITHM, $algorithm));
    }

    public static function missingAudienceClaim(): self
    {
        return new self(self::MSG_MISSING_AUDIENCE_CLAIM);
    }

    public static function missingAuthTimeClaim(): self
    {
        return new self(self::MSG_MISSING_AUTH_TIME_CLAIM);
    }

    public static function missingAzpClaim(): self
    {
        return new self(self::MSG_MISSING_AZP_CLAIM);
    }

    public static function missingExpClaim(): self
    {
        return new self(self::MSG_MISSING_EXP_CLAIM);
    }

    public static function missingIatClaim(): self
    {
        return new self(self::MSG_MISSING_IAT_CLAIM);
    }

    public static function missingIssClaim(): self
    {
        return new self(self::MSG_MISSING_ISS_CLAIM);
    }

    public static function missingNonceClaim(): self
    {
        return new self(self::MSG_MISSING_NONCE_CLAIM);
    }

    public static function missingOrgIdClaim(): self
    {
        return new self(self::MSG_MISSING_ORG_ID_CLAIM);
    }

    public static function missingSubClaim(): self
    {
        return new self(self::MSG_MISSING_SUB_CLAIM);
    }

    public static function missingAlgHeader(): self
    {
        return new self(self::MSG_MISSING_ALG_HEADER);
    }

    public static function missingKidHeader(): self
    {
        return new self(self::MSG_MISSING_KID_HEADER);
    }

    public static function mismatchedAudClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AUD_CLAIM, $expected, $found));
    }

    public static function mismatchedAzpClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AZP_CLAIM, $expected, $found));
    }

    public static function mismatchedAuthTimeClaim(
        int $now,
        int $expired
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AUTH_TIME_CLAIM, $now, $expired));
    }

    public static function mismatchedExpClaim(
        int $now,
        int $expired
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_EXP_CLAIM, $now, $expired));
    }

    public static function mismatchedIssClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_ISS_CLAIM, $expected, $found));
    }

    public static function mismatchedNonceClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_NONCE_CLAIM, $expected, $found));
    }

    public static function mismatchedOrgIdClaim(
        string $expected,
        string $found
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_ORG_ID_CLAIM, $expected, $found));
    }
}
