<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class ConfigurationException extends \Exception implements Auth0Exception
{
    public const MSG_CONFIGURATION_REQUIRED = 'The Auth0 SDK requires an SdkConfiguration be provided at initialization';
    public const MSG_MISSING_MANAGEMENT_KEY = 'A Management API token was not configured';
    public const MSG_SET_IMMUTABLE = 'Changes cannot be applied to a locked configuration';
    public const MSG_SET_MISSING = 'Attempted to assign a value to undefined property "%s"';
    public const MSG_SET_INCOMPATIBLE = 'Parameter "%s" must be of type %s, %s used';
    public const MSG_SET_INCOMPATIBLE_NULLABLE = 'Parameter "%s" must be of type %s or null, %s used';
    public const MSG_GET_MISSING = 'Attempted to retrieve the value of an undefined property "%s"';

    public const MSG_VALIDATION_FAILED = 'Validation of "%s" was unsuccessful';
    public const MSG_MISSING_DOMAIN = 'Missing or invalid `domain` configuration';
    public const MSG_MISSING_CLIENT_ID = 'Missing or invalid `clientId` configuration';
    public const MSG_MISSING_REDIRECT_URI = 'Missing or invalid `redirectUri` configuration';
    public const MSG_INVALID_TOKEN_ALGORITHM = 'Invalid token algorithm; must be "HS256" or "RS256"';

    public static function requiresConfiguration(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_CONFIGURATION_REQUIRED, 0, $previous);
    }

    public static function requiresManagementToken(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_MISSING_MANAGEMENT_KEY, 0, $previous);
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
        if ($propertyName === 'domain') {
            return new self(self::MSG_MISSING_DOMAIN, 0, $previous);
        }

        if ($propertyName === 'clientId') {
            return new self(self::MSG_MISSING_CLIENT_ID, 0, $previous);
        }

        if ($propertyName === 'redirectUri') {
            return new self(self::MSG_MISSING_REDIRECT_URI, 0, $previous);
        }

        return new self(sprintf(self::MSG_VALIDATION_FAILED, $propertyName), 0, $previous);
    }

    public static function invalidAlgorithm(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_INVALID_TOKEN_ALGORITHM, 0, $previous);
    }
}
