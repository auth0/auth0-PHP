<?php
namespace Auth0\Tests\unit\API\Management;

use Auth0\Tests\unit\MockApi;

use Auth0\SDK\API\Management;

/**
 * Class MockManagementApi
 *
 * @package Auth0\Tests\unit\API\Management
 */
class MockManagementApi extends MockApi
{

    /**
     * Management API object.
     *
     * @var Management
     */
    protected $client;

    /**
     * @param array $guzzleOptions
     * @param array $config
     */
    public function setClient(array $guzzleOptions, array $config = [])
    {
        $returnType   = isset( $config['return_type'] ) ? $config['return_type'] : null;
        $this->client = new Management('__api_token__', 'api.test.local', $guzzleOptions, $returnType);
    }
}
