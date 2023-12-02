<?php

declare(strict_types=1);

namespace Auth0\SDK\Exception;

/**
 * @codeCoverageIgnore
 */
interface ExtendedExceptionInterface extends Auth0Exception
{
    /**
     * Produces a formatted exception string using the supplied values.
     *
     * @param array<string,mixed> $values Values to be injected into the message.
     */
    public static function message(
        array $values = [],
    ): string;
}
