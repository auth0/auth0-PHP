<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class ArgumentException extends \Exception implements Auth0Exception
{
    public const MSG_VALUE_CANNOT_BE_EMPTY = 'A value for `%s` must be provided';
    public const MSG_PKCE_CODE_VERIFIER_LENGTH = 'Code verifier must be created with a minimum length of 43 characters and a maximum length of 128 characters.';
    public const MSG_BAD_PERMISSIONS_ARRAY = 'Invalid or empty permissions array passed. All permissions must include both permission_name and resource_server_identifier keys.';
    public const MSG_UNKNOWN_METHOD = 'Unknown method %s.';

    public static function missing(
        string $parameterName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_VALUE_CANNOT_BE_EMPTY, $parameterName), 0, $previous);
    }

    public static function codeVerifierLength(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_PKCE_CODE_VERIFIER_LENGTH, 0, $previous);
    }

    public static function badPermissionsArray(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_BAD_PERMISSIONS_ARRAY, 0, $previous);
    }

    public static function unknownMethod(
        string $methodName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_UNKNOWN_METHOD, $methodName), 0, $previous);
    }
}
