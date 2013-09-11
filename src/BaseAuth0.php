<?php

namespace Auth0SDK;

/*
 * This file is part of Auth0-PHP-SDK package.
 * 
 * (c) Auth0
 * 
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

use \Exception;

/**
 * This class provides access to Auth0 Platform.
 * 
 * @author Sergio Daniel Lepore
 */
abstract class BaseAuth0
{
    /**
     * SDK Version.
     */
    const VERSION = "0.0.0";

    /**
     * SDK Codename.
     */
    const CODENAME = "Abyssinian";

    /**
     * CURL Options.
     * 
     * @var array
     */
    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_USERAGENT      => 'auth0-php-abyssinian',
    );

    /**
     * Available keys to persist data.
     * 
     * @var array
     */
    public static $PERSISTENCE_KEYMAP = array(
        'user_id',
        'token'
    );

}

class ApiException extends Exception { }

class CoreException extends Exception { }