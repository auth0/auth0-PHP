<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class PaginatorException extends \Auth0\SDK\Exception\SdkException implements \Throwable
{
    public const MSG_HTTP_METHOD_UNSUPPORTED = 'This request type is not supported. You can only paginate GET requests.';
    public const MSG_HTTP_BAD_RESPONSE = 'Unable to paginate request.';
    public const MSG_HTTP_ENDPOINT_UNSUPPORTED = 'The requested endpoint "%s" is not supported for pagination.';
    public const MSG_HTTP_ENDPOINT_DOES_NOT_SUPPORT_CHECKPOINT_PAGINATION = 'This requested endpoint "%s" does not support checkpoint-based pagination.';

    public static function httpMethodUnsupported(): self
    {
        return new self(self::MSG_HTTP_METHOD_UNSUPPORTED);
    }

    public static function httpBadResponse(): self
    {
        return new self(self::MSG_HTTP_BAD_RESPONSE);
    }

    public static function httpEndpointUnsupported(
        string $endpoint
    ): self {
        return new self(sprintf(self::MSG_HTTP_ENDPOINT_UNSUPPORTED, $endpoint));
    }

    public static function httpEndpointUnsupportedCheckpoints(
        string $endpoint
    ): self {
        return new self(sprintf(self::MSG_HTTP_ENDPOINT_DOES_NOT_SUPPORT_CHECKPOINT_PAGINATION, $endpoint));
    }
}
