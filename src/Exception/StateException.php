<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

use Exception;
use Throwable;

/**
 * @codeCoverageIgnore
 */
final class StateException extends Exception implements Auth0Exception
{
    /**
     * @var string
     */
    public const MSG_BAD_ACCESS_TOKEN = 'Invalid access_token';

    /**
     * @var string
     */
    public const MSG_FAILED_CODE_EXCHANGE = 'Code exchange was unsuccessful; network error resulted in unfulfilled request';

    /**
     * @var string
     */
    public const MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN = 'Token did not refresh successfully; access token was not returned';

    /**
     * @var string
     */
    public const MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN = 'Cannot renew access token; a refresh token is not available';

    /**
     * @var string
     */
    public const MSG_INVALID_STATE = 'Invalid state';

    /**
     * @var string
     */
    public const MSG_MISSING_CODE = 'Missing code';

    /**
     * @var string
     */
    public const MSG_MISSING_CODE_VERIFIER = 'Missing code_verifier';

    /**
     * @var string
     */
    public const MSG_MISSING_NONCE = 'Nonce was not found in the application storage';

    public static function badAccessToken(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_BAD_ACCESS_TOKEN, 0, $previous);
    }

    public static function failedCodeExchange(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_FAILED_CODE_EXCHANGE, 0, $previous);
    }

    public static function failedRenewTokenMissingAccessToken(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_FAILED_RENEW_TOKEN_MISSING_ACCESS_TOKEN, 0, $previous);
    }

    public static function failedRenewTokenMissingRefreshToken(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_FAILED_RENEW_TOKEN_MISSING_REFRESH_TOKEN, 0, $previous);
    }

    public static function invalidState(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_INVALID_STATE, 0, $previous);
    }

    public static function missingCode(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_CODE, 0, $previous);
    }

    public static function missingCodeVerifier(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_CODE_VERIFIER, 0, $previous);
    }

    public static function missingNonce(
        ?Throwable $previous = null,
    ): self {
        return new self(self::MSG_MISSING_NONCE, 0, $previous);
    }
}
