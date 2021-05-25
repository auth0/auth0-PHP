<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class NetworkException extends \Auth0\SDK\Exception\SdkException implements \Throwable
{
    public const MSG_NETWORK_REQUEST_FAILED = 'Unable to process API request; %s';

    public static function requestFailed(
        string $httpClientMessage
    ): self {
        return new self(sprintf(self::MSG_NETWORK_REQUEST_FAILED, $httpClientMessage));
    }
}
