<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Auth0;

/**
 * Class Telemetry
 * Builds, extends, modifies, and formats SDK telemetry data.
 */
final class HttpTelemetry
{
    /**
     * Default header data to send.
     */
    protected static array $data = [];

    /**
     * Set the main SDK name and version.
     *
     * @param string $name    SDK name.
     * @param string $version SDK version number.
     */
    public static function setPackage(
        string $name,
        string $version
    ): void {
        self::$data['name'] = $name;
        self::$data['version'] = $version;
    }

    /**
     * Set the main SDK name and version to the PHP SDK.
     */
    public static function setCorePackage(): void
    {
        self::setPackage('auth0-php', Auth0::VERSION);
        self::setEnvProperty('php', phpversion());
    }

    /**
     * Add an optional env property for SDK telemetry.
     *
     * @param string $name    Property name to set, name of dependency or platform.
     * @param string $version Version number of dependency or platform.
     */
    public static function setEnvProperty(
        string $name,
        string $version
    ): void {
        if (! isset(self::$data['env']) || ! is_array(self::$data['env'])) {
            self::$data['env'] = [];
        }

        self::$data['env'][$name] = $version;
    }

    /**
     * Replace the current env data with new data.
     *
     * @param array $data Env data to add.
     */
    public static function setEnvironmentData(
        array $data
    ): void {
        self::$data['env'] = $data;
    }

    /**
     * Get the current header data as an array.
     *
     * @return array
     */
    public static function get(): array
    {
        if (! isset(self::$data['name'])) {
            self::setCorePackage();
        }

        return self::$data;
    }

    /**
     * Return a header-formatted string.
     */
    public static function build(): string
    {
        return base64_encode(json_encode(self::get()));
    }

    /**
     * Reset Telemetry to defaults.
     */
    public static function reset(): void
    {
        self::setCorePackage();
        self::$data = [];
    }
}
