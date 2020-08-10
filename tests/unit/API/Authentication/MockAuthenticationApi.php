<?php
namespace Auth0\Tests\unit\API\Authentication;

use Auth0\SDK\API\Authentication;
use Auth0\Tests\unit\MockApi;

/**
 * Class MockAuthenticationApi
 *
 * @package Auth0\Tests\unit\API\Authentication
 */
class MockAuthenticationApi extends MockApi
{

    /**
     * @var Authentication
     */
    protected $client;

    /**
     * @param array $guzzleOptions
     * @param array $config
     */
    public function setClient(array $guzzleOptions, array $config = [])
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
