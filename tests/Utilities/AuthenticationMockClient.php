<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\API\Authentication;

/**
 * Class MockAuthenticationApi.
 */
class AuthenticationMockClient extends MockClientAbstract
{
    protected Authentication $client;

    public function __construct(
        ?array $responses = []
    ) {
        $this->client = new Authentication([
            'domain' => MockDomain::valid(),
            'clientId' => '__test_client_id__',
            'redirectUri' => uniqid(),
        ]);

        parent::__construct($responses);
    }

    public function mock(): Authentication
    {
        return $this->client;
    }
}
