<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Toolkit;

uses()->group('utility', 'utility.toolkit', 'utility.toolkit.filter', 'utility.toolkit.filter.array');

test('first() skips non-array values', function(): void {
    $items = [[], null, [true]];

    $result = Toolkit::filter($items)->array()->first(new \Exception('foo'));

    expect($result)->toEqual([true]);
});

test('empty() returns an empty array when its values are null', function(): void {
    $items = [[], null, [true]];

    $result = Toolkit::filter($items)->array()->empty();

    expect($result)->toEqual([null, null, [true]]);
});

