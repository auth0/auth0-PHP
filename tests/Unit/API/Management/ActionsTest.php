<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\Tests\Utilities\MockManagementApi;

uses()->group('management', 'actions');

beforeEach(function(): void {
    $this->sdk = new MockManagementApi();

    $this->filteredRequest = new FilteredRequest();
    $this->paginatedRequest = new PaginatedRequest();
    $this->requestOptions = new RequestOptions(
        $this->filteredRequest,
        $this->paginatedRequest
    );

    $this->endpoint = $this->sdk->mock()->actions();
});

test('create() issues valid requests', function(array $body): void {
    $this->endpoint->create($body);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/actions', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());

    $request = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $request);
    $this->assertArrayHasKey('supported-triggers', $request);

    $this->assertEquals('my-action', $request['name']);
    $this->assertIsArray($request['supported-triggers']);

    $request = $this->sdk->getRequestBodyAsString();
    $this->assertEquals('{"name":"my-action","supported-triggers":[{"id":"post-login","version":"v2"}],"code":"module.exports = () => {}","dependencies":[{"name":"lodash","version":"1.0.0"}],"runtime":"node12","secrets":[{"name":"mySecret","value":"mySecretValue"}]}', $request);
})->with(['valid body' => [
    fn() => [
        'name' => 'my-action',
        'supported-triggers' => [
            (object) [
                'id' => 'post-login',
                'version' => 'v2'
            ],
        ],
        'code' => 'module.exports = () => {}',
        'dependencies' => [
            (object) [
                'name' => 'lodash',
                'version' => '1.0.0'
            ],
        ],
        'runtime' => 'node12',
        'secrets' => [
            (object) [
                'name' => 'mySecret',
                'value' => 'mySecretValue'
            ]
        ]
    ]
]]);

test('create() throws an error with an empty body', function(array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $this->endpoint->create($body);
})->with(['empty body' => [
    fn() => []
]]);

test('getAll() issues valid requests', function(): void {
    $this->endpoint->getAll();

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/actions', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
});

test('getAll() issues valid requests using parameters', function(array $parameters): void {
    $this->endpoint->getAll($parameters);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/actions/actions', $this->sdk->getRequestUrl());
    $this->assertStringContainsString('&triggerId=' . $parameters['triggerId'], $this->sdk->getRequestQuery());
    $this->assertStringContainsString('&actionName=' . $parameters['actionName'], $this->sdk->getRequestQuery());
})->with(['valid parameters' => [
    fn() => [
        'triggerId' => uniqid(),
        'actionName' => uniqid()
    ]
]]);

test('get() issues valid requests', function(string $id): void {
    $this->endpoint->get($id);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/actions/' . $id, $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
})->with(['valid id' => [
    fn() => uniqid()
]]);

test('get() throws an error with an empty id', function(string $id): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->get($id);
})->with(['empty id' => [
    fn() => ''
]]);

test('update() issues valid requests', function(string $id, array $body): void {
    $this->endpoint->update($id, $body);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/actions/' . $id, $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());

    $request = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('name', $request);
    $this->assertArrayHasKey('supported-triggers', $request);

    $this->assertEquals('my-action', $request['name']);
    $this->assertIsArray($request['supported-triggers']);

    $request = $this->sdk->getRequestBodyAsString();
    $this->assertEquals('{"name":"my-action","supported-triggers":[{"id":"post-login","version":"v2"}],"code":"module.exports = () => {}","dependencies":[{"name":"lodash","version":"1.0.0"}],"runtime":"node12","secrets":[{"name":"mySecret","value":"mySecretValue"}]}', $request);
})->with(['valid request' => [
    fn() => uniqid(),
    fn() => [
        'name' => 'my-action',
        'supported-triggers' => [
            (object) [
                'id' => 'post-login',
                'version' => 'v2'
            ],
        ],
        'code' => 'module.exports = () => {}',
        'dependencies' => [
            (object) [
                'name' => 'lodash',
                'version' => '1.0.0'
            ],
        ],
        'runtime' => 'node12',
        'secrets' => [
            (object) [
                'name' => 'mySecret',
                'value' => 'mySecretValue'
            ]
        ]
    ]
]]);

test('update() throws an error with an empty id', function(string $id, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->update($id, $body);
})->with(['invalid request' => [
    fn() => '',
    fn() => [
        'name' => 'my-action',
        'supported-triggers' => [
            (object) [
                'id' => 'post-login',
                'version' => 'v2'
            ],
        ],
        'code' => 'module.exports = () => {}',
        'dependencies' => [
            (object) [
                'name' => 'lodash',
                'version' => '1.0.0'
            ],
        ],
        'runtime' => 'node12',
        'secrets' => [
            (object) [
                'name' => 'mySecret',
                'value' => 'mySecretValue'
            ]
        ]
    ]
]]);

test('update() throws an error with an empty body', function(string $id, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $this->endpoint->update($id, $body);
})->with(['invalid request' => [
    fn() => uniqid(),
    fn() => []
]]);

test('delete() issues valid requests', function(string $id, ?bool $force): void {
    $this->endpoint->delete($id, $force);

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/actions/actions/' . $id, $this->sdk->getRequestUrl());
})->with(['valid id' => [
    fn() => uniqid(),
    fn() => null
]]);

test('delete() issues valid requests when using optional ?force parameter', function(string $id, ?bool $force): void {
    $this->endpoint->delete($id, $force);

    $this->assertEquals('DELETE', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/actions/actions/' . $id, $this->sdk->getRequestUrl());
    $this->assertStringContainsString('&force=false', $this->sdk->getRequestQuery());
})->with(['valid id and force=false' => [
    fn() => uniqid(),
    fn() => false
]]);

test('delete() throws an error with an empty id', function(string $id, ?bool $force): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->delete($id, $force);
})->with(['empty id' => [
    fn() => '',
    fn() => null
]]);

test('deploy() issues valid requests', function(string $id): void {
    $this->endpoint->deploy($id);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/' . $id . '/deploy', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
})->with(['valid id' => [
    fn() => uniqid()
]]);

test('deploy() throws an error with an empty id', function(string $id): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->deploy($id);
})->with(['empty id' => [
    fn() => ''
]]);

test('test() issues valid requests', function(string $id, array $body): void {
    $this->endpoint->test($id, $body);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/actions/' . $id . '/test', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());

    $request = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('payload', $request);
    $this->assertIsArray($request['payload']);
    $this->assertArrayHasKey('test', $request['payload'][0]);
    $this->assertEquals($body['payload'][0]->test, $request['payload'][0]['test']);

    $request = $this->sdk->getRequestBodyAsString();
    $this->assertEquals('{"payload":[{"test":"' . $body['payload'][0]->test . '"}]}', $request);
})->with(['valid request' => [
    fn() => uniqid(),
    fn() => [
        'payload' => [
            (object) [
                'test' => uniqid(),
            ],
        ],
    ]
]]);

test('test() throws an error with an empty id', function(string $id, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->test($id, $body);
})->with(['empty id' => [
    fn() => '',
    fn() => [
        'payload' => [
            (object) [
                'test' => uniqid(),
            ],
        ],
    ]
]]);

test('test() throws an error with an empty body', function(string $id, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $this->endpoint->test($id, $body);
})->with(['empty body' => [
    fn() => uniqid(),
    fn() => []
]]);

test('getVersion() issues valid requests', function(string $id, string $actionId): void {
    $this->endpoint->getVersion($id, $actionId);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/actions/' . $actionId . '/versions/' . $id, $this->sdk->getRequestUrl());
})->with(['valid id' => [
    fn() => uniqid(),
    fn() => uniqid()
]]);

test('getVersion() throws an error with an empty id', function(string $id, string $actionId): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->getVersion($id, $actionId);
})->with(['empty id' => [
    fn() => '',
    fn() => uniqid()
]]);

test('getVersion() throws an error with an empty action id', function(string $id, string $actionId): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'actionId'));

    $this->endpoint->getVersion($id, $actionId);
})->with(['empty action id' => [
    fn() => uniqid(),
    fn() => ''
]]);

test('getVersions() issues valid requests', function(string $actionId): void {
    $this->endpoint->getVersions($actionId);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertStringStartsWith('https://api.test.local/api/v2/actions/' . $actionId . '/versions', $this->sdk->getRequestUrl());
})->with(['valid action id' => [
    fn() => uniqid()
]]);

test('getVersions() throws an error with an empty action id', function(string $actionId): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'actionId'));

    $this->endpoint->getVersions($actionId);
})->with(['empty action id' => [
    fn() => ''
]]);

test('rollbackVersion() issues valid requests', function(string $id, string $actionId): void {
    $this->endpoint->rollbackVersion($id, $actionId);

    $this->assertEquals('POST', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/' . $actionId . '/versions/' . $id . '/deploy', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
})->with(['valid request' => [
    fn() => uniqid(),
    fn() => uniqid(),
]]);

test('rollbackVersion() throws an error with an empty id', function(string $id, string $actionId): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->rollbackVersion($id, $actionId);
})->with(['empty id' => [
    fn() => '',
    fn() => uniqid(),
]]);

test('rollbackVersion() throws an error with an action id', function(string $id, string $actionId): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'actionId'));

    $this->endpoint->rollbackVersion($id, $actionId);
})->with(['empty action id' => [
    fn() => uniqid(),
    fn() => '',
]]);

test('getTriggers() issues valid requests', function(): void {
    $this->endpoint->getTriggers();

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/triggers', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
});

test('getTriggerBindings() issues valid requests', function(string $triggerId): void {
    $this->endpoint->getTriggerBindings($triggerId);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/triggers/' . $triggerId . '/bindings', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
})->with(['valid trigger id' => [
    fn() => uniqid(),
]]);

test('updateTriggerBindings() issues valid requests', function(string $triggerId, array $body): void {
    $this->endpoint->updateTriggerBindings($triggerId, $body);

    $this->assertEquals('PATCH', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/triggers/' . $triggerId . '/bindings', $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());

    $request = $this->sdk->getRequestBody();
    $this->assertArrayHasKey('bindings', $request);
    $this->assertIsArray($request['bindings']);
    $this->assertArrayHasKey('ref', $request['bindings'][0]);
    $this->assertEquals($body['bindings'][0]->ref->value, $request['bindings'][0]['ref']['value']);

    $request = $this->sdk->getRequestBodyAsString();
    $this->assertEquals('{"bindings":[{"ref":{"type":"action_name","value":"my-action"},"display_name":"First Action"},{"ref":{"type":"action_id","value":"a6a5a107-d2e3-45a3-8ff6-1218aa4bf8bd"},"display_name":"Second Action"}]}', $request);
})->with(['valid request' => [
    fn() => uniqid(),
    fn() => [
        'bindings' => [
            (object) [
                'ref' => (object) [
                    'type' => 'action_name',
                    'value' => 'my-action',
                ],
                'display_name' => 'First Action',
            ],
            (object) [
                'ref' => (object) [
                    'type' => 'action_id',
                    'value' => 'a6a5a107-d2e3-45a3-8ff6-1218aa4bf8bd',
                ],
                'display_name' => 'Second Action',
            ],
        ],
    ]
]]);

test('updateTriggerBindings() throws an error with an empty trigger id', function(string $triggerId, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'triggerId'));

    $this->endpoint->updateTriggerBindings($triggerId, $body);
})->with(['empty id' => [
    fn() => '',
    fn() => [
        'bindings' => [
            (object) [
                'ref' => (object) [
                    'type' => 'action_name',
                    'value' => 'my-action',
                ],
                'display_name' => 'First Action',
            ],
            (object) [
                'ref' => (object) [
                    'type' => 'action_id',
                    'value' => 'a6a5a107-d2e3-45a3-8ff6-1218aa4bf8bd',
                ],
                'display_name' => 'Second Action',
            ],
        ],
    ]
]]);

test('updateTriggerBindings() throws an error with an empty body', function(string $triggerId, array $body): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'body'));

    $this->endpoint->updateTriggerBindings($triggerId, $body);
})->with(['empty id' => [
    fn() => uniqid(),
    fn() => [],
]]);

test('getExecution() issues valid requests', function(string $id): void {
    $this->endpoint->getExecution($id);

    $this->assertEquals('GET', $this->sdk->getRequestMethod());
    $this->assertEquals('https://api.test.local/api/v2/actions/executions/' . $id, $this->sdk->getRequestUrl());
    $this->assertEmpty($this->sdk->getRequestQuery());
})->with(['valid id' => [
    fn() => uniqid()
]]);

test('getExecution() throws an error with an empty id', function(string $id): void {
    $this->expectException(\Auth0\SDK\Exception\ArgumentException::class);
    $this->expectExceptionMessage(sprintf(\Auth0\SDK\Exception\ArgumentException::MSG_VALUE_CANNOT_BE_EMPTY, 'id'));

    $this->endpoint->getExecution($id);
})->with(['valid trigger id' => [
    fn() => '',
]]);
