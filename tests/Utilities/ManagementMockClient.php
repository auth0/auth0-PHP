<?php

declare(strict_types=1);

namespace Auth0\Tests\Utilities;

use Auth0\SDK\API\Management;

final class ManagementMockClient extends MockClientAbstract
{
    protected Management $client;

    public function __construct(
        ?array $responses = []
    ) {
        $this->client = new Management([
            'domain' => MockDomain::valid(),
            'clientId' => '__test_client_id__',
            'cookieSecret' => uniqid(),
            'redirectUri' => uniqid(),
            'managementToken' => '__api_token__',
        ]);

        parent::__construct($responses);
    }

    public function mock(): Management
    {
        return $this->client;
    }
}
