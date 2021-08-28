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
     * Library package name to send with telemetry headers.
     */
    private static ?string $packageName = null;

    /**
     * Library package version to send with telemetry headers.
     */
    private static ?string $packageVersion = null;

    /**
     * Additional environmental data tp send with telemetry headers, such as PHP version.
     *
     * @var array<mixed>|null
     */
    private static ?array $environment = null;

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
        self::$packageName = $name;
        self::$packageVersion = $version;
    }

    /**
     * Set the main SDK name and version to the PHP SDK.
     */
    public static function setCorePackage(): void
    {
        $phpVersion = phpversion();

        // @codeCoverageIgnoreStart
        // phpversion() can potentially return false in unusual circumstances; set PHP version to an empty string in those cases.
        if ($phpVersion === false) {
            $phpVersion = '';
        }
        // @codeCoverageIgnoreEnd

        self::setPackage('auth0-php', Auth0::VERSION);
        self::setEnvProperty('php', $phpVersion);
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
        if (self::$environment === null) {
            self::$environment = [];
        }

        self::$environment[$name] = $version;
    }

    /**
     * Replace the current env data with new data.
     *
     * @param array<mixed> $data Env data to add.
     */
    public static function setEnvironmentData(
        array $data
    ): void {
        self::$environment = $data;
    }

    /**
     * Get the current header data as an array.
     *
     * @return array<mixed>
     */
    public static function get(): array
    {
        if (self::$packageName === null) {
            self::setCorePackage();
        }

        return Toolkit::filter([
            [
                'name' => self::$packageName,
                'version' => self::$packageVersion,
                'env' => self::$environment,
            ],
        ])->array()->trim()[0];
    }

    /**
     * Return a header-formatted string.
     */
    public static function build(): string
    {
        return base64_encode(json_encode(self::get(), JSON_THROW_ON_ERROR));
    }

    /**
     * Reset Telemetry to defaults.
     */
    public static function reset(): void
    {
        self::$environment = null;
        self::setCorePackage();
    }
}
