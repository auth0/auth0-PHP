<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Header;

class Telemetry extends Header
{
    /**
     * Telemetry constructor.
     *
     * @param string $telemetryData Identifying string for the Auth0-Client header.
     */
    public function __construct(
        string $telemetryData
    ) {
        parent::__construct('Auth0-Client', $telemetryData);
    }
}
