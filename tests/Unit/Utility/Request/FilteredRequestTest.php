<?php

declare(strict_types=1);

use Auth0\SDK\Utility\Request\FilteredRequest;

uses()->group('utility', 'utility.request', 'utility.request.request_options', 'utility.request.request_options.filtered_request');

test('setFields() works as expected', function(): void {
    $filters = new FilteredRequest();

    $filters->setFields(['a', 'b', 'c']);

    expect($filters->getFields())->toEqualCanonicalizing(['a', 'b', 'c']);
});

test('clearFields() works as expected', function(): void {
    $filters = new FilteredRequest();

    $filters->setFields(['a', 'b', 'c']);
    $filters->clearFields();

    expect($filters->getFields())->toBeNull();
});

test('setIncludeFields() works as expected', function(): void {
    $filters = new FilteredRequest();

    $filters->setIncludeFields(true);
    expect($filters->getIncludeFields())->toBeTrue();

    $filters->setIncludeFields(false);
    expect($filters->getIncludeFields())->toBeFalse();

    $filters->setIncludeFields(null);
    expect($filters->getIncludeFields())->toBeNull();
});
