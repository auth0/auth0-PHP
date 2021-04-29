<?php

declare(strict_types=1);

namespace Auth0\Tests\traits;

trait ErrorHelpers
{
    /**
     * Does an error message contain a specific string?
     *
     * @param \Exception $e   - Error object.
     * @param string     $str - String to find in the error message.
     */
    protected function errorHasString(\Exception $e, string $str): bool
    {
        return ! strpos($e->getMessage(), $str) === false;
    }
}
