<?php

declare(strict_types=1);

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once join(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);

// For unit tests, use a mock network client rather than sending real requests.
uses()
    ->beforeAll(function(): void {
        \Http\Discovery\Psr18ClientDiscovery::prependStrategy(\Http\Discovery\Strategy\MockClientStrategy::class);
    })
    ->in('Unit');

// For Management SDK unit tests, configure the MockManagementApi client.
uses()
    ->beforeEach(function(): void {
        $this->api = new \Auth0\Tests\Utilities\MockManagementApi();

        $this->filteredRequest = new \Auth0\SDK\Utility\Request\FilteredRequest();
        $this->paginatedRequest = new \Auth0\SDK\Utility\Request\PaginatedRequest();
        $this->requestOptions = new \Auth0\SDK\Utility\Request\RequestOptions(
            $this->filteredRequest,
            $this->paginatedRequest
        );
    })
    ->in('Unit' . DIRECTORY_SEPARATOR   . 'API' . DIRECTORY_SEPARATOR . 'Management');
