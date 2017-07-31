<?php
/**
 * Created by PhpStorm.
 * User: germanlena
 * Date: 4/23/15
 * Time: 12:03 PM.
 */

namespace Auth0\SDK\Exception;

use Auth0\SDK\Exception;
use Psr\Http\Message\ResponseInterface;

/**
 * Represents all errors returned by the server.
 *
 * @author Auth0
 */
abstract class ApiException extends \RuntimeException implements Exception
{
    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ResponseInterface $response
     * @param $message
     *
     * @return static
     */
    public static function create(ResponseInterface $response, $message)
    {
        $e = new static();
        $e->response = $response;
        $e->message = $message;

        return $e;
    }
}
