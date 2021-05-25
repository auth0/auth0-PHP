<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\API\Authentication;

/**
 * Class MockAuthenticationApi.
 */
class MockAuthenticationApi extends MockApi
{
    /**
     * Authentication API object.
     */
    protected Authentication $client;

    /**
     * Setup the MockAPI to use the Authentication class.
     */
    protected function setClient(): void
    {
        $this->client = new Authentication([
            'domain' => 'api.test.local',
            'clientId' => '__test_client_id__',
            'redirectUri' => uniqid(),
        ]);
    }

    /**
     * Return the endpoint being used.
     */
    public function mock(): Authentication
    {
        return $this->client;
    }
}
