<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;

/**
 * Class GenericResource.
 * Extended by Management API endpoints classes.
 *
 * @package Auth0\SDK\API\Management
 */
class GenericResource
{
    /**
     * Injected ApiClient instance to use.
     *
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * GenericResource constructor.
     *
     * @param ApiClient $apiClient ApiClient instance to use.
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Get the injected ApiClient instance.
     *
     * @return ApiClient
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Check for invalid permissions with an array of permissions.
     *
     * @param array $permissions Permissions array to check.
     *
     * @return void
     *
     * @throws InvalidPermissionsArrayException If permissions are empty or do not contain the necessary keys.
     */
    protected function validatePermissions(array $permissions): void
    {
        if (empty($permissions)) {
            throw new InvalidPermissionsArrayException();
        }

        foreach ($permissions as $permission) {
            if (empty($permission['permission_name'])) {
                throw new InvalidPermissionsArrayException();
            }

            if (empty($permission['resource_server_identifier'])) {
                throw new InvalidPermissionsArrayException();
            }
        }
    }

    /**
     * Check that a variable is a string and is not empty.
     *
     * @param string $variable     The variable to check.
     * @param string $variableName The variable name.
     *
     * @return void
     *
     * @throws EmptyOrInvalidParameterException If $var is empty or is not a string.
     */
    protected function validateString(
        string $variable,
        string $variableName
    ): void {
        if (! strlen($variable)) {
            throw new EmptyOrInvalidParameterException($variableName);
        }
    }

    /**
     * Check that a variable contains a valid email address.
     *
     * @param string $email        The email to check.
     * @param string $variableName The variable name.
     *
     * @return void
     *
     * @throws EmptyOrInvalidParameterException If $var is empty or is not a string.
     */
    protected function validateEmail(
        string $email,
        string $variableName
    ): void {
        if (! (filter_var($email, FILTER_VALIDATE_EMAIL))) {
            throw new EmptyOrInvalidParameterException($variableName);
        }
    }

    /**
     * Check that a variable is an array and is not empty.
     *
     * @param array  $variable     The variable to check.
     * @param string $variableName The variable name.
     *
     * @return void
     *
     * @throws EmptyOrInvalidParameterException If $var is empty or is not a string.
     */
    protected function validateArray(
        array $variable,
        string $variableName
    ): void {
        if (! count($variable)) {
            throw new EmptyOrInvalidParameterException($variableName);
        }
    }
}
