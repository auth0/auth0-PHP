<?php
namespace Auth0\SDK\API\Header;

class Telemetry extends Header
{

    /**
     * Telemetry constructor.
     *
     * @param string $telemetryData
     */
    public function __construct($telemetryData)
    {
        parent::__construct('Auth0-Client', $telemetryData);
    }
}
