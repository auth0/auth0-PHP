<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class StateException extends \Auth0\SDK\Exception\CoreException implements \Throwable
{
    public const MSG_INVALID_STATE = 'Invalid state';
    public const MSG_MISSING_CODE_VERIFIER = 'Missing code_verifier';
    public const MSG_EXISTING_SESSION = 'Cannot initialize session; a session is already active';
    public const MSG_BAD_ACCESS_TOKEN = 'Invalid access_token';
    public const MSG_MISSING_NONCE = 'Nonce was not found in the application storage';
    public const MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN = 'Cannot renew access token; a refresh token is not available';
    public const MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN = 'Token did not refresh successfully; access token was not returned';

    public static function invalidState(): self
    {
        return new self(self::MSG_INVALID_STATE);
    }

    public static function missingCodeVerifier(): self
    {
        return new self(self::MSG_MISSING_CODE_VERIFIER);
    }

    public static function existingSession(): self
    {
        return new self(self::MSG_EXISTING_SESSION);
    }

    public static function badAccessToken(): self
    {
        return new self(self::MSG_BAD_ACCESS_TOKEN);
    }

    public static function missingNonce(): self
    {
        return new self(self::MSG_MISSING_NONCE);
    }

    public static function failedRenewTokenMissingRefreshToken(): self
    {
        return new self(self::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN);
    }

    public static function failedRenewTokenMissingAccessToken(): self
    {
        return new self(self::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN);
    }
}
