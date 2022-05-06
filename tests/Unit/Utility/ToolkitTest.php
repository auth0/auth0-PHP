<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Toolkit;

uses()->group('utility', 'utility.toolkit');

test('assert() returns an instance of \Auth0\SDK\Utility\Toolkit\Assert', function(): void {
    expect(Toolkit::assert([1,2,3]))->toBeInstanceOf(\Auth0\SDK\Utility\Toolkit\Assert::class);
});

test('filter() returns an instance of \Auth0\SDK\Utility\Toolkit\Filter', function(): void {
    expect(Toolkit::filter([1,2,3]))->toBeInstanceOf(\Auth0\SDK\Utility\Toolkit\Filter::class);
});

test('times() runs a function a number of times', function(): void {
    $times = 0;

    Toolkit::times(5, function() use (&$times) {
        $times++;
    });

    expect($times)->toEqual(5);
});

test('each() passes each item in an array through a function', function(): void {
    $items = ['a', 'b', 'c'];

    Toolkit::each($items, function(&$item, $key) {
        $item = $item . $key;
    });

    expect($items)->toEqual(['a0', 'b1', 'c2']);
});

test('each() will break loop if false is returned', function(): void {
    $items = ['a', 'b', 'c'];

    Toolkit::each($items, function(&$item, $key) {
        $item = $item . $key;
        return false;
    });

    expect($items)->toEqual(['a0', 'b', 'c']);
});

test('merge() merges two or more arrays and ignores items with null values', function(): void {
    $array1 = ['a' => 'string test', 'b' => 123456, 'c' => null];
    $array2 = ['b' => 654321, 'a' => null];

    $final = Toolkit::merge($array1, $array2);

    expect($final)->toEqual(['b' => 654321, 'a' => 'string test']);
});

test('every() returns true if no value is false', function(): void {
    $items = ['Testing', 123, uniqid()];

    $result = Toolkit::every(null, $items);

    expect($result)->toBeTrue();
});

test('every() throws an error if any value is null', function(): void {
    $items = ['Testing', 123, null];

    Toolkit::every(new \Exception('foobar'), $items);
})->throws(\Exception::class, 'foobar');

test('every() returns false if any value is null when no exception is provided', function(): void {
    $items = ['Testing', 123, null];

    $result = Toolkit::every(null, $items);

    expect($result)->toBeFalse();
});

test('some() does not throw an error if some values are null, and removes keys with null values in the response', function(): void {
    $items = ['Testing', 123, null];
    $expected = ['Testing', 123];

    $result = Toolkit::some(new \Exception('foobar'), $items);

    expect($result)->toEqual($expected);
});

test('some() returns false if all values are null when no exception is provided', function(): void {
    $items = [null, null, null];

    $result = Toolkit::some(null, $items);

    expect($result)->toBeFalse();
});

test('some() throws an error if all values are null', function(): void {
    $items = [null, null, null];

    Toolkit::some(new \Exception('foobar'), $items);
})->throws(\Exception::class, 'foobar');
