<?php

namespace Auth0\SDK\API\Management\Types;

enum EventStreamCloudEventErrorCodeEnum: string
{
    case InvalidCursor = "invalid_cursor";
    case CursorExpired = "cursor_expired";
    case Timeout = "timeout";
    case PayloadTooLarge = "payload_too_large";
    case ProcessingError = "processing_error";
    case ConnectionTimeout = "connection_timeout";
}
