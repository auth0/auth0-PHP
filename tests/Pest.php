<?php

declare(strict_types=1);

define('AUTH0_TESTS_DIR', dirname(__FILE__));

require_once implode(DIRECTORY_SEPARATOR, [AUTH0_TESTS_DIR, '..', 'vendor', 'autoload.php']);

uses()
    ->beforeEach(function(): void {
        $this->api = new \Auth0\Tests\Utilities\ManagementMockClient();

        $this->filteredRequest = new \Auth0\SDK\Utility\Request\FilteredRequest();
        $this->paginatedRequest = new \Auth0\SDK\Utility\Request\PaginatedRequest();
        $this->requestOptions = new \Auth0\SDK\Utility\Request\RequestOptions(
            $this->filteredRequest,
            $this->paginatedRequest
        );
    })->in('Unit' . DIRECTORY_SEPARATOR   . 'API' . DIRECTORY_SEPARATOR . 'Management');
