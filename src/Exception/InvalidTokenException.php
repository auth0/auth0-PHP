<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

use Exception;
use Throwable;

/**
 * @codeCoverageIgnore
 */
final class InvalidTokenException extends Exception implements Auth0Exception
{
    /**
     * @var string
     */
    public const MSG_BAD_EVENT_CLAIM = '`%s` member in the `events` claim must be an %s';

    /**
     * @var string
     */
    public const MSG_BAD_SEPARATORS = 'The JWT string must contain two dots';

    /**
     * @var string
     */
    public const MSG_BAD_SIGNATURE = 'Cannot verify signature';

    /**
     * @var string
     */
    public const MSG_BAD_SIGNATURE_INCOMPATIBLE_ALGORITHM = 'Cannot verify signature: Key uses an incompatible signing algorithm';

    /**
     * @var string
     */
    public const MSG_BAD_SIGNATURE_MISSING_KID = 'Cannot verify signature: JWKS did not contain the key specified by the token';

    /**
     * @var string
     */
    public const MSG_LOGOUT_TOKEN_NONCE_PRESENT = 'Valid logout tokens cannot include `nonce` claims';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_AUD_CLAIM = 'Audience (aud) claim mismatch in the token; expected "%s", found "%s"';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_AUTH_TIME_CLAIM = 'Authentication Time (auth_time) claim in the token indicates that too much time has passed since the last end-user authentication. Current time %d is after last auth at %d';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_AZP_CLAIM = 'Authorized Party (azp) claim mismatch in the ID token; expected "%s", found "%s"';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_EVENTS_CLAIM = 'Events (events) claim mismatch in the token; expected "%s", found "%s"';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_EXP_CLAIM = 'Expiration Time (exp) claim error in the token; current time %d is after expiration time %d';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_ISS_CLAIM = 'Issuer (iss) claim mismatch in the token; expected "%s", found "%s"';

    /**
     * @var string
     */
    public const MSG_MISMATCHED_NONCE_CLAIM = 'Nonce (nonce) claim mismatch in the token; expected "%s", found "%s"';

    /**
     * @var string
     */
    public const MSG_MISSING_ALG_HEADER = 'Provided token is missing a alg header';

    /**
     * @var string
     */
    public const MSG_MISSING_AUDIENCE_CLAIM = 'Audience (aud) claim must be a string or array of strings present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_AUTH_TIME_CLAIM = 'Authentication Time (auth_time) claim must be a number present in the token when Max Age is specified';

    /**
     * @var string
     */
    public const MSG_MISSING_AZP_CLAIM = 'Authorized Party (azp) claim must be a string present in the token when Audience (aud) claim has multiple values';

    /**
     * @var string
     */
    public const MSG_MISSING_EVENTS_CLAIM = 'Events (events) claim must be an array of strings present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_EXP_CLAIM = 'Expiration Time (exp) claim must be a number present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_IAT_CLAIM = 'Issued At (iat) claim must be a number present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_ISS_CLAIM = 'Issuer (iss) claim must be a string present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_KID_HEADER = 'Provided token is missing a kid header';

    /**
     * @var string
     */
    public const MSG_MISSING_NONCE_CLAIM = 'Nonce (nonce) claim must be a string present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_SID_CLAIM = 'Identifier (sid) claim must be a number present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_SUB_AND_SID_CLAIMS = 'Subject (sub) or Identifier (sid) claim must be a string present in the token';

    /**
     * @var string
     */
    public const MSG_MISSING_SUB_CLAIM = 'Subject (sub) claim must be a string present in the token';

    /**
     * @var string
     */
    public const MSG_ORGANIZATION_CLAIM_BAD = 'Token organization claim (`org_id` or `org_name`) must be a string';

    /**
     * @var string
     */
    public const MSG_ORGANIZATION_CLAIM_MISSING = 'Token organization claim (`org_id` or `org_name`) was not found';

    /**
     * @var string
     */
    public const MSG_ORGANIZATION_CLAIM_UNEXPECTED = 'Token organization claim (`org_id` or `org_name`) was not expected';

    /**
     * @var string
     */
    public const MSG_ORGANIZATION_CLAIM_UNMATCHED = 'Token organization claim (`org_id` or `org_name`) is not allowed';

    /**
     * @var string
     */
    public const MSG_REQUIRES_CLIENT_SECRET = 'Cannot verify signature: Client secret must be configured to verify HS256 signatures';

    /**
     * @var string
     */
    public const MSG_REQUIRES_JWKS_URI = 'Cannot verify signature: JWKS uri was not configured properly';

    /**
     * @var string
     */
    public const MSG_UNEXPECTED_SIGNING_ALGORITHM = 'Expected token signed with "%s" algorithm, but token uses "%s"';

    /**
     * @var string
     */
    public const MSG_UNSUPPORTED_SIGNING_ALGORITHM = 'Signature algorithm of "%s" is not supported. Expected the token to be signed with "RS256" or "HS256"';

    public static function badEventClaim(
        string $claim,
        string $format,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_BAD_EVENT_CLAIM, $claim, $format), 0, $previous);
    }

    public static function badSeparators(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_BAD_SEPARATORS, 0, $previous);
    }

    public static function badSignature(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_BAD_SIGNATURE, 0, $previous);
    }

    public static function badSignatureIncompatibleAlgorithm(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_BAD_SIGNATURE_INCOMPATIBLE_ALGORITHM, 0, $previous);
    }

    public static function badSignatureMissingKid(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_BAD_SIGNATURE_MISSING_KID, 0, $previous);
    }

    public static function jsonError(
        string $message,
        ?Throwable $previous = null,
    ): self {
        return new self($message, 0, $previous);
    }

    public static function logoutTokenNoncePresent(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_LOGOUT_TOKEN_NONCE_PRESENT, 0, $previous);
    }

    public static function mismatchedAudClaim(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AUD_CLAIM, $expected, $found), 0, $previous);
    }

    public static function mismatchedAuthTimeClaim(
        int $now,
        int $expired,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AUTH_TIME_CLAIM, $now, $expired), 0, $previous);
    }

    public static function mismatchedAzpClaim(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_AZP_CLAIM, $expected, $found), 0, $previous);
    }

    public static function mismatchedEventsClaim(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_EVENTS_CLAIM, $expected, $found), 0, $previous);
    }

    public static function mismatchedExpClaim(
        int $now,
        int $expired,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_EXP_CLAIM, $now, $expired), 0, $previous);
    }

    public static function mismatchedIssClaim(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_ISS_CLAIM, $expected, $found), 0, $previous);
    }

    public static function mismatchedNonceClaim(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_MISMATCHED_NONCE_CLAIM, $expected, $found), 0, $previous);
    }

    public static function missingAlgHeader(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_ALG_HEADER, 0, $previous);
    }

    public static function missingAudienceClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_AUDIENCE_CLAIM, 0, $previous);
    }

    public static function missingAuthTimeClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_AUTH_TIME_CLAIM, 0, $previous);
    }

    public static function missingAzpClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_AZP_CLAIM, 0, $previous);
    }

    public static function missingEventsClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_EVENTS_CLAIM, 0, $previous);
    }

    public static function missingExpClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_EXP_CLAIM, 0, $previous);
    }

    public static function missingIatClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_IAT_CLAIM, 0, $previous);
    }

    public static function missingIssClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_ISS_CLAIM, 0, $previous);
    }

    public static function missingKidHeader(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_KID_HEADER, 0, $previous);
    }

    public static function missingNonceClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_NONCE_CLAIM, 0, $previous);
    }

    public static function missingSidClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_SID_CLAIM, 0, $previous);
    }

    public static function missingSubAndSidClaims(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_SUB_AND_SID_CLAIMS, 0, $previous);
    }

    public static function missingSubClaim(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_SUB_CLAIM, 0, $previous);
    }

    public static function requiresClientSecret(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_REQUIRES_CLIENT_SECRET, 0, $previous);
    }

    public static function requiresJwksUri(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_REQUIRES_JWKS_URI, 0, $previous);
    }

    public static function unexpectedSigningAlgorithm(
        string $expected,
        string $found,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_UNEXPECTED_SIGNING_ALGORITHM, $expected, $found), 0, $previous);
    }

    public static function unsupportedSigningAlgorithm(
        string $algorithm,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_UNSUPPORTED_SIGNING_ALGORITHM, $algorithm), 0, $previous);
    }
}
