<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class AuthenticationException extends \Auth0\SDK\Exception\SdkException implements \Throwable
{
    public const MSG_REQUIRES_CLIENT_SECRET = 'A client secret must be configured for this request';
    public const MSG_REQUIRES_GRANT_TYPE = 'A grant type must be specified for this request';
    public const MSG_VALUE_CANNOT_BE_EMPTY = 'A value for `%s` must be specified for this request';

    public static function requiresClientSecret(): self
    {
        return new self(self::MSG_REQUIRES_CLIENT_SECRET);
    }

    public static function requiresGrantType(): self
    {
        return new self(self::MSG_REQUIRES_GRANT_TYPE);
    }

    public static function emptyString(
        string $parameterName
    ): self {
        return new self(sprintf(self::MSG_VALUE_CANNOT_BE_EMPTY, $parameterName));
    }
}
