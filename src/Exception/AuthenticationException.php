<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class AuthenticationException extends SdkException
{
    public const MSG_REQUIRES_CLIENT_SECRET = 'A client secret must be configured for this request';
    public const MSG_REQUIRES_GRANT_TYPE = 'A grant type must be specified for this request';
    public const MSG_REQUIRES_RETURN_URI = 'A return uri must be configured for this request';

    public static function requiresClientSecret(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_CLIENT_SECRET, 0, $previous);
    }

    public static function requiresGrantType(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_GRANT_TYPE, 0, $previous);
    }

    public static function requiresReturnUri(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_RETURN_URI, 0, $previous);
    }
}
