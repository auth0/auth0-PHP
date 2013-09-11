<?php

namespace Auth0SDK;

/*
 * This file is part of GUAI-PHP-SDK package.
 * 
 * (c) Auth0
 * 
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

use \Exception;

abstract class BaseAuth0
{
    const VERSION = "0.0.0";

    const CODENAME = "Abyssinian";

    public static $CURL_OPTS = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_USERAGENT      => 'guai-php-vaalbara',
    );

}

class ApiException extends Exception { }

class CoreException extends Exception { }