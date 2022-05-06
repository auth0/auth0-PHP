<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\PaginatedRequest;

uses()->group('utility', 'utility.request', 'utility.request.request_options', 'utility.request.request_options.paginated_request');

test('setPage() and getPage() work as expected', function(): void {
    $filters = new PaginatedRequest();

    $filters->setPage(5);
    expect($filters->getPage())->toEqual(5);
});

test('setPerPage() and getPerPage() work as expected', function(): void {
    $filters = new PaginatedRequest();

    $filters->setPerPage(5);
    expect($filters->getPerPage())->toEqual(5);
});

test('setFrom() and getFrom() work as expected', function(): void {
    $filters = new PaginatedRequest();

    $filters->setFrom('test');
    expect($filters->getFrom())->toEqual('test');
});

test('setTake() and getTake() work as expected', function(): void {
    $filters = new PaginatedRequest();

    $filters->setTake(5);
    expect($filters->getTake())->toEqual(5);
});

test('setIncludeTotals() works as expected', function(): void {
    $filters = new PaginatedRequest();

    $filters->setIncludeTotals(true);
    expect($filters->getIncludeTotals())->toBeTrue();

    $filters->setIncludeTotals(false);
    expect($filters->getIncludeTotals())->toBeFalse();

    $filters->setIncludeTotals(null);
    expect($filters->getIncludeTotals())->toBeNull();
});
