<?php

namespace Auth0\SDK\Model;

/**
 * This class represent a 204 HTTP response.
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class EmptyResponse implements CreatableFromArray
{
    private function __construct()
    {
    }

    public static function createFromArray(array $data)
    {
    }
}
