<?php

namespace Auth0SDK;

/*
 * This file is part of Auth0-PHP package.
 *
 * (c) Auth0
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */



/**
 * This class is a mockup store, that discards the values, its a way of saying no store.
 *
 * @author Auth0
 */
class EmptyStore
{
    /**
     * @param string $key
     * @param mixed $value
     */
    public function set($key, $value) {
    }

    /**
     */
    public function get($key, $default=false) {
        return $default;
    }

    /**
     */
    public function delete($key) {
    }
}
