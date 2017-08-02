<?php

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ResponseMediator;
use Auth0\SDK\Exception\ApiException;
use Auth0\SDK\Exception\ForbiddenException;
use Auth0\SDK\Exception\BadRequestException;
use Auth0\SDK\Exception\TooManyRequestsException;
use Auth0\SDK\Exception\UnauthorizedException;
use Auth0\SDK\Exception\UnknownApiException;
use Http\Client\Common\HttpMethodsClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class GenericResource
{
    /**
     * @var HttpMethodsClient
     */
    protected $httpClient;

    /**
     * @param HttpMethodsClient $apiClient
     */
    public function __construct(HttpMethodsClient $apiClient)
    {
        $this->httpClient = $apiClient;
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
