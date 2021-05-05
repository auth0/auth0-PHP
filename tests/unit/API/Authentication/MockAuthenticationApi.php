<?php

declare(strict_types=1);

namespace Auth0\Tests\unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\unit\MockApi;

/**
 * Class MockAuthenticationApi.
 */
class MockAuthenticationApi extends MockApi
{
    /**
     * @param array $guzzleOptions
     * @param array $config
     */
    public function setClient(array $guzzleOptions, array $config = []): void
    {
        $this->client = new Authentication(
            'test-domain.auth0.com',
            '__test_client_id__',
            '__test_client_secret__',
            null,
            null,
            $guzzleOptions
        );
    }
}
