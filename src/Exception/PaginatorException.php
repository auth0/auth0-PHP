<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
final class PaginatorException extends \Exception implements Auth0Exception
{
    public const MSG_HTTP_METHOD_UNSUPPORTED = 'This request type is not supported. You can only paginate GET requests.';
    public const MSG_HTTP_BAD_RESPONSE = 'Unable to paginate request. Please ensure the endpoint you are using supports pagination, and that you are using the include_totals params.';
    public const MSG_HTTP_ENDPOINT_DOES_NOT_SUPPORT_CHECKPOINT_PAGINATION = 'The requested endpoint "%s" does not support checkpoint pagination.';
    public const MSG_HTTP_CANNOT_COUNT_CHECKPOINT_PAGINATION = 'Cannot receive counts when using checkpoint pagination.';

    public static function httpMethodUnsupported(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_HTTP_METHOD_UNSUPPORTED, 0, $previous);
    }

    public static function httpBadResponse(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_HTTP_BAD_RESPONSE, 0, $previous);
    }

    public static function httpEndpointUnsupportedCheckpoints(
        string $endpoint,
        ?\Throwable $previous = null
    ): self {
        return new self(sprintf(self::MSG_HTTP_ENDPOINT_DOES_NOT_SUPPORT_CHECKPOINT_PAGINATION, $endpoint), 0, $previous);
    }

    public static function httpCheckpointCannotBeCounted(
        ?\Throwable $previous = null
    ): self {
        return new self(self::MSG_HTTP_CANNOT_COUNT_CHECKPOINT_PAGINATION, 0, $previous);
    }
}
