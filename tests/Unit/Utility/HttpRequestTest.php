<?php

declare(strict_types=1);

use Auth0\SDK\Configuration\SdkConfiguration;
use Auth0\SDK\Utility\HttpClient;
use Auth0\SDK\Utility\HttpRequest;
use Auth0\Tests\Utilities\HttpResponseGenerator;
use Psr\Http\Client\ClientExceptionInterface;

uses()->group('utility', 'utility.http_request', 'networking');

beforeEach(function(): void {
    $this->configuration = new SdkConfiguration([
        'strategy' => 'none',
        'domain' => 'api.local.test',
    ]);
});

it('builds url pathes correctly', function(HttpRequest $client): void {
    expect($client->getUrl())->toEqual('');
    expect($client->addPath('path1')->getUrl())->toEqual('path1');
    expect($client->addPath('path2', '3')->getUrl())->toEqual('path1/path2/3');
})->with(['mocked client' => [
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

it('adds field filtering params when configured', function(HttpRequest $client): void {
    expect($client->getParams())->toEqual('?' . http_build_query(['fields' => implode(',', ['a', 'b', 123]), 'include_fields' => 'true'], '', '&', PHP_QUERY_RFC3986));
})->with(['mocked client' => [
    function(): HttpRequest {
        $client = new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid());
        $client->withFields(new \Auth0\SDK\Utility\Request\FilteredRequest(['a', 'b', 123], true));
        return $client;
    }
]]);

it('adds classic pagination params when configured', function(HttpRequest $client): void {
    expect($client->getParams())->toEqual('?' . http_build_query(['page' => 5, 'per_page' => 10, 'include_totals' => 'true'], '', '&', PHP_QUERY_RFC3986));
})->with(['mocked client' => [
    function(): HttpRequest {
        $client = new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid());
        $client->withPagination(new \Auth0\SDK\Utility\Request\PaginatedRequest(5, 10, true));
        return $client;
    }
]]);

it('adds checkpoints pagination params when configured', function(HttpRequest $client): void {
    expect($client->getParams())->toEqual('?' . http_build_query(['from' => 123456, 'take' => 25], '', '&', PHP_QUERY_RFC3986));
})->with(['mocked client' => [
    function(): HttpRequest {
        $client = new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid());
        $client->withPagination(new \Auth0\SDK\Utility\Request\PaginatedRequest(null, 25, null, '123456'));
        return $client;
    }
]]);

test('withParam() adds a parameter to the URL', function(string $parameter, string $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('?' . $parameter . '=' . $value);
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => (string) uniqid(),
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() adds multiple parameters to the URL', function(array $parameters, array $values, HttpRequest $client): void {
    $expectedParameterStrings = [
        '?' . $parameters[0] . '=' . $values[0],
        '&' . $parameters[1] . '=true',
        '&' . $parameters[2] . '=123',
    ];

    expect($client->withParam($parameters[0], $values[0])->getParams())->toEqual($expectedParameterStrings[0]);
    expect($client->withParam($parameters[1], $values[1])->getParams())->toEqual($expectedParameterStrings[0] . $expectedParameterStrings[1]);
    expect($client->withParam($parameters[2], $values[2])->getParams())->toEqual($expectedParameterStrings[0] . $expectedParameterStrings[1] . $expectedParameterStrings[2]);
})->with(['mocked client and data' => [
    fn() => [(string) uniqid(), (string) uniqid(), (string) uniqid()],
    fn() => [(string) uniqid(), true, 123],
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() adds a parameter to the URL with a `true` value', function(string $parameter, bool $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('?' . $parameter . '=true');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => true,
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() adds a parameter to the URL with a `false` value', function(string $parameter, bool $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('?' . $parameter . '=false');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => false,
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() adds a parameter to the URL with an int value', function(string $parameter, int $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('?' . $parameter . '=' . $value);
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => random_int(0, PHP_INT_MAX),
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() skips adding parameters with empty values', function(string $parameter, string $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => '',
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() skips adding parameters with null values', function(string $parameter, ?string $value, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->getParams())->toEqual('');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => null,
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParam() replaces a parameter in the URL', function(string $parameter, string $value, string $replacementValue, HttpRequest $client): void {
    expect($client->withParam($parameter, $value)->withParam($parameter, $replacementValue)->getParams())->toEqual('?' . $parameter . '=' . $replacementValue);
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => (string) uniqid(),
    fn() => (string) uniqid(),
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withFormParam() adds a form parameter to the request body with a `true` value', function(string $parameter, bool $value, HttpRequest $client): void {
    $client->withFormParam($parameter, $value);
    $client->call();

    expect($client->getLastRequest()->getBody()->__toString())->toEqual($parameter . '=true');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => true,
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withFormParam() adds a form parameter to the request body with a `false` value', function(string $parameter, bool $value, HttpRequest $client): void {
    $client->withFormParam($parameter, $value);
    $client->call();

    expect($client->getLastRequest()->getBody()->__toString())->toEqual($parameter . '=false');
})->with(['mocked client and data' => [
    fn() => (string) uniqid(),
    fn() => false,
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

test('withParams() adds multiple parameters to the URL', function(array $parameters, array $values, HttpRequest $client): void {
    $expectedParameterStrings = [
        '?' . $parameters[0] . '=' . $values[0],
        '&' . $parameters[1] . '=true',
        '&' . $parameters[2] . '=123',
    ];

    $this->assertEquals($expectedParameterStrings[0] . $expectedParameterStrings[1] . $expectedParameterStrings[2], $client->withParams([
        $parameters[0] => $values[0],
        $parameters[1] => $values[1],
        $parameters[2] => $values[2],
    ])->getParams());
})->with(['mocked client and data' => [
    fn() => [(string) uniqid(), (string) uniqid(), (string) uniqid()],
    fn() => [(string) uniqid(), true, 123],
    fn() => new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid())
]]);

it('throws a NetworkException when the underlying client raises a ClientExceptionInterface', function(HttpRequest $client): void {
    $client->call();
})->with(['mocked client' => [
    function(): HttpRequest {
        $responses = [
            (object) [
                'exception' => new class () extends \Exception implements ClientExceptionInterface {},
                'response' => HttpResponseGenerator::create('', 500)

            ]
        ];

        return new HttpRequest($this->configuration, HttpClient::CONTEXT_GENERIC_CLIENT, 'get', '/' . uniqid(), [], null, $responses);
    }
]])->throws(\Auth0\SDK\Exception\NetworkException::class);
