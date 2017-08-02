<?php

namespace Auth0\Tests\API;

use Auth0\SDK\API\Helpers\TokenGenerator;
use GuzzleHttp\Psr7\Response;
use Http\Client\HttpClient;
use josegonzalez\Dotenv\Loader;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ApiTests extends \PHPUnit_Framework_TestCase
{
    protected function getEnv()
    {
        try {
            $loader = new Loader('.env');
            $loader->parse()
             ->putenv(true);
        } catch (\InvalidArgumentException $e) {
            //ignore
        }

        return [
          'GLOBAL_CLIENT_ID' => getenv('GLOBAL_CLIENT_ID'),
          'GLOBAL_CLIENT_SECRET' => getenv('GLOBAL_CLIENT_SECRET'),
          'APP_CLIENT_ID' => getenv('APP_CLIENT_ID'),
          'APP_CLIENT_SECRET' => getenv('APP_CLIENT_SECRET'),
          'NIC_ID' => getenv('NIC_ID'),
          'NIC_SECRET' => getenv('NIC_SECRET'),
          'DOMAIN' => getenv('DOMAIN'),
        ];
    }

    protected function getToken($env, $scopes)
    {
        $generator = new TokenGenerator(['client_id' => $env['GLOBAL_CLIENT_ID'], 'client_secret' => $env['GLOBAL_CLIENT_SECRET']]);

        return $generator->generate($scopes);
    }

    /**
     * @return Response
     */
    protected function createResponse($body = null, $httpStatus = 200, $headers = [])
    {
        if (!isset($headers['Content-Type'])) {
            $headers['Content-Type'] = 'application/json';
        }

        return new Response($httpStatus, $headers, $body);
    }

    /**
     * Get a mocked HTTP client where you may do tests on the request.
     *
     * @param string|null $body
     * @param int         $statusCode
     *
     * @return HttpClient
     */
    protected function getMockedHttpClientCallback(callable $requestCallback)
    {
        $client = $this->getMockBuilder(HttpClient::class)->getMock();
        $client
            ->expects($this->once())
            ->method('sendRequest')
            ->willReturnCallback(function (RequestInterface $request) use ($requestCallback) {
                $response = $requestCallback($request);
                if (!$response instanceof ResponseInterface) {
                    $response = new Response(200, [], (string) $response);
                }

                return $response;
            });

        return $client;
    }
}
