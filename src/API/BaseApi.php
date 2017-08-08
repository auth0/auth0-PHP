<?php

namespace Auth0\SDK\API;

use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\ForbiddenException;
use Auth0\SDK\Exception\BadRequestException;
use Auth0\SDK\Exception\TooManyRequestsException;
use Auth0\SDK\Exception\UnauthorizedException;
use Auth0\SDK\Exception\UnknownApiException;
use Auth0\SDK\Hydrator\Hydrator;
use Auth0\SDK\Hydrator\NoopHydrator;
use Http\Client\Common\HttpMethodsClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class BaseApi
{
    /**
     * @var HttpMethodsClient
     */
    protected $httpClient;

    /**
     * @var Hydrator|null
     */
    protected $hydrator;

    /**
     * @param HttpMethodsClient $apiClient
     * @param Hydrator $hydrator
     */
    public function __construct(HttpMethodsClient $apiClient, Hydrator $hydrator)
    {
        $this->httpClient = $apiClient;

        if (!$hydrator instanceof NoopHydrator) {
            $this->hydrator = $hydrator;
        }
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     *
     * @throws ApiException
     */
    protected function handleExceptions(ResponseInterface $response)
    {
        $status = $response->getStatusCode();
        $content = ResponseMediator::getContent($response);

        switch ($status) {
            case 400:
                throw BadRequestException::create($response, $content);
            case 401:
                throw UnauthorizedException::create($response, $content);
            case 403:
                throw ForbiddenException::create($response, $content);
            case 429:
                throw TooManyRequestsException::create($response, $content);
            default:
                throw UnknownApiException::create($response, $content);
        }
    }
}
