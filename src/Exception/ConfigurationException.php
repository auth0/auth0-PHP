<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class ConfigurationException extends \Auth0\SDK\Exception\CoreException implements \Throwable
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

    public static function requiresConfiguration(): self
    {
        return new self(self::MSG_CONFIGURATION_REQUIRED);
    }

    public static function requiresManagementToken(): self
    {
        return new self(self::MSG_MISSING_MANAGEMENT_KEY);
    }

    public static function setImmutable(): self
    {
        return new self(self::MSG_SET_IMMUTABLE);
    }

    public static function setMissing(
        string $propertyName
    ): self {
        return new self(sprintf(self::MSG_SET_MISSING, $propertyName));
    }

    public static function setIncompatible(
        string $propertyName,
        string $expectedType,
        string $usedType
    ): self {
        return new self(sprintf(self::MSG_SET_INCOMPATIBLE, $propertyName, $expectedType, $usedType));
    }

    public static function setIncompatibleNullable(
        string $propertyName,
        string $expectedType,
        string $usedType
    ): self {
        return new self(sprintf(self::MSG_SET_INCOMPATIBLE_NULLABLE, $propertyName, $expectedType, $usedType));
    }

    public static function getMissing(
        string $propertyName
    ): self {
        return new self(sprintf(self::MSG_GET_MISSING, $propertyName));
    }

    public static function validationFailed(
        string $propertyName
    ): self {
        switch ($propertyName) {
            case 'domain':
                return new self(self::MSG_MISSING_DOMAIN);
                break;

            case 'clientId':
                return new self(self::MSG_MISSING_CLIENT_ID);
                break;

            case 'redirectUri':
                return new self(self::MSG_MISSING_REDIRECT_URI);
                break;

            default:
                return new self(sprintf(self::MSG_VALIDATION_FAILED, $propertyName));
                break;
        }
    }

    public static function invalidAlgorithm(): self
    {
        return new self(self::MSG_INVALID_TOKEN_ALGORITHM);
    }
}
