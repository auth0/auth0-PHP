<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class TokenException extends \Exception implements Auth0Exception
{
    public const MSG_UNKNOWN_ERROR = 'An unknown error occurred.';
    public const MSG_KEY_TYPE_UNKNOWN = 'Key type could not be determined';
    public const MSG_KEY_TYPE_NOT_SUPPORTED = 'Key type "%s" is not supported for the $s algorithm';
    public const MSG_SIGNING_KEY_PROCESSING_ERROR = 'An exception occurred while attempting to process the configured signing key: %s';
    public const MSG_UNABLE_TO_ENCODE_SEGMENT = 'An exception occurred while attempting to encode segment "%s" during token generation: %s';
    public const MSG_UNABLE_TO_SIGN_DATA = 'An exception occurred while attempting to produce signature during token generation: %s';
    public const MSG_UNSUPPORTED_ALGORITHM = 'Unsupported algorithm "%s". Supported algorithms are: %s';
    public const MSG_HS256_REQUIRES_KEY_AS_STRING = 'HS256 algorithm requires a key in string format.';
    public const MSG_LIB_OPENSSL_MISSING = 'The OpenSSL extension is required to generate tokens';
    public const MSG_LIB_OPENSSL_MISSING_ALGO = 'The OpenSSL extension must support %s algorithm to generate tokens';

    public static function unableToProcessSigningKey(
        string $message,
        ?\Throwable $previous = null,
    ): static {
        return new static(sprintf(static::MSG_SIGNING_KEY_PROCESSING_ERROR, $message), 0, $previous);
    }

    public static function unableToEncodeSegment(
        string $segment,
        string $message,
        ?\Throwable $previous = null,
    ): static {
        return new static(sprintf(static::MSG_UNABLE_TO_ENCODE_SEGMENT, $segment, $message), 0, $previous);
    }

    public static function unableToSignData(
        string $message,
        ?\Throwable $previous = null,
    ): static {
        return new static(sprintf(static::MSG_UNABLE_TO_SIGN_DATA, $message), 0, $previous);
    }

    public static function unsupportedAlgorithm(
        string $algorithm,
        string $supported,
        ?\Throwable $previous = null,
    ): static {
        return new static(sprintf(static::MSG_UNSUPPORTED_ALGORITHM, $algorithm, $supported), 0, $previous);
    }

    public static function requireKeyAsStringHs256(
        ?\Throwable $previous = null,
    ): static {
        return new static(static::MSG_HS256_REQUIRES_KEY_AS_STRING, 0, $previous);
    }

    public static function openSslMissing(
        ?\Throwable $previous = null,
    ): static {
        return new static(static::MSG_LIB_OPENSSL_MISSING, 0, $previous);
    }

    public static function openSslMissingAlgo(
        string $algorithm,
        ?\Throwable $previous = null,
    ): static {
        return new static(sprintf(static::MSG_LIB_OPENSSL_MISSING_ALGO, $algorithm), 0, $previous);
    }
}
