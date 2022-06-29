<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Toolkit;

uses()->group('utility', 'utility.toolkit', 'utility.toolkit.assert');

test('isPermissions() throws an exception if value is not an array', function(): void {
    $permissions = true;

    Toolkit::assert([
        [$permissions, new \Exception('foobar')],
    ])->isPermissions();
})->throws(\Exception::class, 'foobar');

test('isPermissions() throws an exception if value is an empty array', function(): void {
    $permissions = [];

    Toolkit::assert([
        [$permissions, new \Exception('foobar')],
    ])->isPermissions();
})->throws(\Exception::class, 'foobar');

test('isPermissions() throws an exception if a value does not have `permission_name`', function(): void {
    $permissions = [
        [
            'permission_name' => 'Testing',
            'resource_server_identifier' => uniqid()
        ],
        [
            'resource_server_identifier' => uniqid()
        ]
    ];

    Toolkit::assert([
        [$permissions, new \Exception('foobar')],
    ])->isPermissions();
})->throws(\Exception::class, 'foobar');

test('isPermissions() throws an exception if a value does not have `resource_server_identifier`', function(): void {
    $permissions = [
        [
            'permission_name' => 'Testing',
            'resource_server_identifier' => uniqid()
        ],
        [
            'permission_name' => 'Testing'
        ]
    ];

    Toolkit::assert([
        [$permissions, new \Exception('foobar')],
    ])->isPermissions();
})->throws(\Exception::class, 'foobar');

test('isString() throws an exception if value is not a string', function(): void {
    Toolkit::assert([
        [true, new \Exception('foobar')],
    ])->isString();
})->throws(\Exception::class, 'foobar');

test('isString() throws an exception if value is an empty string', function(): void {
    Toolkit::assert([
        ['', new \Exception('foobar')],
    ])->isString();
})->throws(\Exception::class, 'foobar');

test('isArray() throws an exception if value is not an array', function(): void {
    Toolkit::assert([
        [true, new \Exception('foobar')],
    ])->isArray();
})->throws(\Exception::class, 'foobar');

test('isArray() throws an exception if value is an empty array', function(): void {
    Toolkit::assert([
        [[], new \Exception('foobar')],
    ])->isArray();
})->throws(\Exception::class, 'foobar');
