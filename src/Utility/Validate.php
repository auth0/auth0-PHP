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
     * @throws \Auth0\SDK\Exception\ArgumentException If $variable is empty or is not a string.
     */
    public static function string(
        string $variable,
        string $variableName
    ): string {
        $variable = trim($variable);

        if (mb_strlen($variable) === 0) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }

        return $variable;
    }

    /**
     * Check that a variable contains a valid email address.
     *
     * @param string $email        The email to check.
     * @param string $variableName The variable name.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If $variable is empty or is not a string.
     */
    public static function email(
        string $email,
        string $variableName
    ): string {
        $email = trim($email);

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }

        return $email;
    }

    /**
     * Check that a variable is an array and is not empty.
     *
     * @param array<mixed> $variable     The variable to check.
     * @param string       $variableName The variable name.
     *
     * @throws \Auth0\SDK\Exception\ArgumentException If $variable is empty or is not a string.
     */
    public static function array(
        array $variable,
        string $variableName
    ): void {
        if (count($variable) === 0) {
            throw \Auth0\SDK\Exception\ArgumentException::missing($variableName);
        }
    }

    /**
     * Throw an error if all the provided values are null.
     *
     * @param \Throwable $exception An exception to throw if all values are null.
     * @param mixed      $values    One or more values to check.
     *
     * @return mixed
     *
     * @throws \Throwable If all $values are null.
     */
    public static function any(
        \Throwable $exception,
        ...$values
    ) {
        $values = Shortcut::filterArray($values);

        // All values were null, throw an exception.
        if (count($values) === 0) {
            throw $exception;
        }

        // Return all non-null values.
        return $values;
    }
}
