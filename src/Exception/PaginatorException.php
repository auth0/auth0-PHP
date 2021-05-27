<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

final class PaginatorException extends \Auth0\SDK\Exception\SdkException implements \Throwable
{
    public const MSG_HTTP_METHOD_UNSUPPORTED = 'This request type is not supported. You can only paginate GET requests.';

    public static function httpMethodUnsupported(): self
    {
        return new self(self::MSG_HTTP_METHOD_UNSUPPORTED);
    }
}
