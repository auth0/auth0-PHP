<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

use Auth0\SDK\Auth0;

use function is_array;

/**
 * Builds, extends, modifies, and formats SDK telemetry data.
 */
final class HttpTelemetry
{
    /**
     * Additional environmental data tp send with telemetry headers, such as PHP version.
     *
     * @var null|array<mixed>
     */
    private static ?array $environment = null;

    /**
     * Library package name to send with telemetry headers.
     */
    private static ?string $packageName = null;

    /**
     * Library package version to send with telemetry headers.
     */
    private static ?string $packageVersion = null;

    /**
     * Return a header-formatted string.
     */
    public static function build(): string
    {
        return base64_encode(json_encode(self::get(), JSON_THROW_ON_ERROR));
    }

    /**
     * Get the current header data as an array.
     *
     * @return array<mixed>
     *
     * @codeCoverageIgnore
     */
    public static function get(): array
    {
        if (null === self::$packageName) {
            self::setCorePackage();
        }

        if (is_array($response = Toolkit::filter([
            [
                'name' => self::$packageName,
                'version' => self::$packageVersion,
                'env' => self::$environment,
            ],
        ])->array()->trim()[0])) {
            return $response;
        }

        return [];
    }

    /**
     * Reset Telemetry to defaults.
     */
    public static function reset(): void
    {
        self::$environment = null;
        self::setCorePackage();
    }

    /**
     * Set the main SDK name and version to the PHP SDK.
     */
    public static function setCorePackage(): void
    {
        $phpVersion = PHP_VERSION;
        self::setPackage('auth0-php', Auth0::VERSION);
        self::setEnvProperty('php', $phpVersion);
    }

    /**
     * Replace the current env data with new data.
     *
     * @param array<mixed> $data env data to add
     */
    public static function setEnvironmentData(
        array $data,
    ): void {
        self::$environment = $data;
    }

    /**
     * Add an optional env property for SDK telemetry.
     *
     * @param string $name    property name to set, name of dependency or platform
     * @param string $version version number of dependency or platform
     */
    public static function setEnvProperty(
        string $name,
        string $version,
    ): void {
        if (null === self::$environment) {
            self::$environment = [];
        }

        self::$environment[$name] = $version;
    }

    /**
     * Set the main SDK name and version.
     *
     * @param string $name    SDK name
     * @param string $version SDK version number
     */
    public static function setPackage(
        string $name,
        string $version,
    ): void {
        self::$packageName = $name;
        self::$packageVersion = $version;
    }
}
