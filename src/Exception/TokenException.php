<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

use Exception;
use Throwable;

/**
 * @codeCoverageIgnore
 */
final class TokenException extends Exception implements Auth0Exception
{
    /**
     * @var string
     */
    public const MSG_HS256_REQUIRES_KEY_AS_STRING = 'HS256 algorithm requires a key in string format.';

    /**
     * @var string
     */
    public const MSG_KEY_TYPE_NOT_SUPPORTED = 'Key type "%s" is not supported for the %s algorithm';

    /**
     * @var string
     */
    public const MSG_KEY_TYPE_UNKNOWN = 'Key type could not be determined';

    /**
     * @var string
     */
    public const MSG_LIB_OPENSSL_MISSING = 'The OpenSSL extension is required to generate tokens';

    /**
     * @var string
     */
    public const MSG_LIB_OPENSSL_MISSING_ALGO = 'The OpenSSL extension must support %s algorithm to generate tokens';

    /**
     * @var string
     */
    public const MSG_SIGNING_KEY_PROCESSING_ERROR = 'An exception occurred while attempting to process the configured signing key: %s';

    /**
     * @var string
     */
    public const MSG_UNABLE_TO_ENCODE_SEGMENT = 'An exception occurred while attempting to encode segment "%s" during token generation: %s';

    /**
     * @var string
     */
    public const MSG_UNABLE_TO_SIGN_DATA = 'An exception occurred while attempting to produce signature during token generation: %s';

    /**
     * @var string
     */
    public const MSG_UNKNOWN_ERROR = 'An unknown error occurred.';

    /**
     * @var string
     */
    public const MSG_UNSUPPORTED_ALGORITHM = 'Unsupported algorithm "%s". Supported algorithms are: %s';

    public static function keyTypeMismatch(
        string $keyType,
        string $algorithm,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_KEY_TYPE_NOT_SUPPORTED, $keyType, $algorithm), 0, $previous);
    }

    public static function openSslMissing(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_LIB_OPENSSL_MISSING, 0, $previous);
    }

    public static function openSslMissingAlgo(
        string $algorithm,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_LIB_OPENSSL_MISSING_ALGO, $algorithm), 0, $previous);
    }

    public static function requireKeyAsStringHs256(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_HS256_REQUIRES_KEY_AS_STRING, 0, $previous);
    }

    public static function unableToEncodeSegment(
        string $segment,
        string $message,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_UNABLE_TO_ENCODE_SEGMENT, $segment, $message), 0, $previous);
    }

    public static function unableToProcessSigningKey(
        string $message,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_SIGNING_KEY_PROCESSING_ERROR, $message), 0, $previous);
    }

    public static function unableToSignData(
        string $message,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_UNABLE_TO_SIGN_DATA, $message), 0, $previous);
    }

    public static function unidentifiableKeyType(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_KEY_TYPE_UNKNOWN, 0, $previous);
    }

    public static function unknown(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_UNKNOWN_ERROR, 0, $previous);
    }

    public static function unsupportedAlgorithm(
        string $algorithm,
        string $supported,
        ?Throwable $previous = null,
    ): self {
        return new self(sprintf(self::MSG_UNSUPPORTED_ALGORITHM, $algorithm, $supported), 0, $previous);
    }
}
