<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class ConfigurationException extends \Exception implements Auth0Exception
{
    public const MSG_CONFIGURATION_REQUIRED = 'The Auth0 SDK requires an SdkConfiguration be provided at initialization';
    public const MSG_STRATEGY_REQUIRED = 'The Auth0 SDK requires a `strategy` to be configured';

    public const MSG_VALUE_REQUIRED = '`%s` is not configured';

    public const MSG_SET_IMMUTABLE = 'Changes cannot be applied to a locked configuration';
    public const MSG_SET_MISSING = 'Attempted to assign a value to undefined property "%s"';
    public const MSG_SET_INCOMPATIBLE = 'Parameter "%s" must be of type %s, %s used';
    public const MSG_SET_INCOMPATIBLE_NULLABLE = 'Parameter "%s" must be of type %s or null, %s used';
    public const MSG_GET_MISSING = 'Attempted to retrieve the value of an undefined property "%s"';

    public const MSG_VALIDATION_FAILED = 'Validation of "%s" was unsuccessful';

    public const MSG_REQUIRES_AUDIENCE = '`audience` must be configured';
    public const MSG_REQUIRES_COOKIE_SECRET = '`cookieSecret` must be configured';
    public const MSG_REQUIRES_CLIENT_ID = '`clientId` must be configured';
    public const MSG_REQUIRES_CLIENT_SECRET = '`clientSecret` must be configured';
    public const MSG_REQUIRES_DOMAIN = '`domain` must be configured';
    public const MSG_REQUIRES_MANAGEMENT_KEY = '`managementToken` must be configured';
    public const MSG_REQUIRES_REDIRECT_URI = '`redirectUri` must be configured';
    public const MSG_REQUIRES_RETURN_URI = '`returnUri` must be configured';

    public const MSG_INVALID_TOKEN_ALGORITHM = 'Invalid token algorithm; must be "HS256" or "RS256"';

    public const MSG_NO_PSR18_LIBRARY = 'No compatible PSR-18 library was configured, and one could not be auto-discovered.';
    public const MSG_NO_PSR17_LIBRARY = 'No compatible PSR-17 library was configured, and one could not be auto-discovered.';

    public static function requiresConfiguration(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_CONFIGURATION_REQUIRED, 0, $previous);
    }

    public static function requiresStrategy(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_STRATEGY_REQUIRED, 0, $previous);
    }

    public static function requiresDomain(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_DOMAIN, 0, $previous);
    }

    public static function requiresAudience(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_AUDIENCE, 0, $previous);
    }

    public static function requiresCookieSecret(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_COOKIE_SECRET, 0, $previous);
    }

    public static function requiresClientId(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_CLIENT_ID, 0, $previous);
    }

    public static function requiresClientSecret(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_CLIENT_SECRET, 0, $previous);
    }

    public static function requiresManagementToken(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_MANAGEMENT_KEY, 0, $previous);
    }

    public static function requiresRedirectUri(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_REDIRECT_URI, 0, $previous);
    }

    public static function requiresReturnUri(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_REQUIRES_RETURN_URI, 0, $previous);
    }

    public static function required(
        string $propertyName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_VALUE_REQUIRED, $propertyName), 0, $previous);
    }

    public static function setImmutable(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_SET_IMMUTABLE, 0, $previous);
    }

    public static function setMissing(
        string $propertyName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_SET_MISSING, $propertyName), 0, $previous);
    }

    public static function setIncompatible(
        string $propertyName,
        string $expectedType,
        string $usedType,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_SET_INCOMPATIBLE, $propertyName, $expectedType, $usedType), 0, $previous);
    }

    public static function setIncompatibleNullable(
        string $propertyName,
        string $expectedType,
        string $usedType,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_SET_INCOMPATIBLE_NULLABLE, $propertyName, $expectedType, $usedType), 0, $previous);
    }

    public static function getMissing(
        string $propertyName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_GET_MISSING, $propertyName), 0, $previous);
    }

    public static function validationFailed(
        string $propertyName,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_VALIDATION_FAILED, $propertyName), 0, $previous);
    }

    public static function invalidAlgorithm(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_INVALID_TOKEN_ALGORITHM, 0, $previous);
    }

    public static function missingPsr18Library(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_NO_PSR18_LIBRARY, 0, $previous);
    }

    public static function missingPsr17Library(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_NO_PSR17_LIBRARY, 0, $previous);
    }
}
