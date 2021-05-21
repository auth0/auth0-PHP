<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\API\Management;
use Auth0\SDK\Configuration\SdkConfiguration;

/**
 * Class MockManagementApi.
 */
class MockManagementApi extends MockApi
{
    /**
     * Management API object.
     */
    protected Management $client;

    /**
     * Setup the MockAPI to use the Management class.
     */
    protected function setClient(): void
    {
        $this->client = new Management([
            'domain' => 'api.test.local',
            'clientId' => '__test_client_id__',
            'redirectUri' => uniqid(),
            'managementToken' => '__api_token__'
        ]);
    }

    /**
     * Return the endpoint being used.
     */
    public function mock(): Management
    {
        return $this->client;
    }
}
