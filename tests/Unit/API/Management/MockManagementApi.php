<?php

declare(strict_types=1);

namespace Auth0\Tests\Unit\API\Management;

use Auth0\SDK\API\Management;
use Auth0\Tests\Unit\MockApi;

/**
 * Class MockManagementApi.
 */
class MockManagementApi extends MockApi
{
    /**
     * @param array $guzzleOptions
     * @param array $config
     */
    public function setClient(array $guzzleOptions, array $config = []): void
    {
        $returnType = isset($config['return_type']) ? $config['return_type'] : null;
        $this->client = new Management('__api_token__', 'api.test.local', $guzzleOptions, $returnType);
    }
}
