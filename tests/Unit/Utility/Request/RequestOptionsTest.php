<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;
use Auth0\SDK\Utility\Request\PaginatedRequest;
use Auth0\SDK\Utility\Request\RequestOptions;

uses()->group('utility', 'utility.request', 'utility.request.request_options');

test('setFields() accepts a `FilteredRequest` instance', function(): void {
    $filters = new FilteredRequest();
    $request = new RequestOptions();

    $request->setFields($filters);

    expect($request->getFields())->toEqual($filters);
});

test('setPagination() accepts a `PaginatedRequest` instance', function(): void {
    $pagination = new PaginatedRequest();
    $request = new RequestOptions();

    $request->setPagination($pagination);

    expect($request->getPagination())->toEqual($pagination);
});
