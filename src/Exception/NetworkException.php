<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class NetworkException extends \Exception implements Auth0Exception
{
    public const MSG_NETWORK_REQUEST_FAILED = 'Unable to complete network request; %s';

    public static function requestFailed(
        string $httpClientMessage,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_NETWORK_REQUEST_FAILED, $httpClientMessage), 0, $previous);
    }
}
