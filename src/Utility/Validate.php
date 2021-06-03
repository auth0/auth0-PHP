<?php

declare(strict_types=1);

namespace Auth0\SDK\Utility;

/**
 * Class Validate.
 */
final class Validate
{
    /**
     * Check for invalid permissions with an array of permissions.
     *
     * @param array<array> $permissions Permissions array to check.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If permissions are empty or do not contain the necessary keys.
     */
    public static function permissions(
        array $permissions
    ): void {
        if (count($permissions) === 0) {
            throw \Auth0\SDK\Exception\ArgumentException::badPermissionsArray();
        }

        foreach ($permissions as $permission) {
            if (! isset($permission['permission_name'])) {
                throw \Auth0\SDK\Exception\ArgumentException::badPermissionsArray();
            }

            if (! isset($permission['resource_server_identifier'])) {
                throw \Auth0\SDK\Exception\ArgumentException::badPermissionsArray();
            }
        }
    }

    /**
     * Check that a variable is a string and is not empty.
     *
     * @param string $variable     The variable to check.
     * @param string $variableName The variable name.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If $var is empty or is not a string.
     */
    public static function string(
        string $variable,
        string $variableName
    ): void {
        if (mb_strlen(trim($variable)) === 0) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }
    }

    /**
     * Check that a variable contains a valid email address.
     *
     * @param string $email        The email to check.
     * @param string $variableName The variable name.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If $var is empty or is not a string.
     */
    public static function email(
        string $email,
        string $variableName
    ): void {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }
    }

    /**
     * Check that a variable is an array and is not empty.
     *
     * @param array<mixed> $variable     The variable to check.
     * @param string       $variableName The variable name.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If $var is empty or is not a string.
     */
    public static function array(
        array $variable,
        string $variableName
    ): void {
        if (count($variable) === 0) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }
    }
}
