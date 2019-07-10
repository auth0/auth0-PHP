<?php namespace Auth0\SDK\API\Management;

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
     * Normalize pagination parameters.
     *
     * @param array        $params   Original parameters to normalize.
     * @param null|integer $page     Page number, zero-based.
     * @param null|integer $per_page Per-page count, zero-based.
     *
     * @return array
     */
    protected function normalizePagination(array $params, $page = null, $per_page = null)
    {
        $pagination = [
            'page' => isset( $params['page'] ) ? $params['page'] : $page,
            'per_page' => isset( $params['per_page'] ) ? $params['per_page'] : $per_page,
        ];

        // Filter out empty values.
        $pagination = array_filter( $pagination );

        // Make sure we have absolute integers.
        $pagination = array_map( function ($val) {
            return abs( intval( $val ) );
        }, $pagination );

        return array_merge( $params, $pagination );
    }

    /**
     * Normalize include_totals parameter.
     *
     * @param array      $params         Original parameters to normalize.
     * @param null|mixed $include_totals Include totals parameter value, if any.
     *
     * @return array
     */
    protected function normalizeIncludeTotals(array $params, $include_totals = null)
    {
        // User parameter include_totals if params does not have the key.
        if (! isset( $params['include_totals'] )) {
            $params['include_totals'] = $include_totals;
        }

        // Make sure we have a boolean.
        $params['include_totals'] = filter_var( $params['include_totals'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );

        return $params;
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
    protected function checkInvalidPermissions(array $permissions)
    {
        if (empty( $permissions )) {
            throw new InvalidPermissionsArrayException();
        }

        foreach ($permissions as $permission) {
            if (empty( $permission['permission_name'] )) {
                throw new InvalidPermissionsArrayException();
            }

            if (empty( $permission['resource_server_identifier'] )) {
                throw new InvalidPermissionsArrayException();
            }
        }
    }

    /**
     * Check that a variable is a string and is not empty.
     *
     * @param mixed  $var      The variable to check.
     * @param string $var_name The variable name.
     *
     * @return void
     *
     * @throws EmptyOrInvalidParameterException If $var is empty or is not a string.
     */
    protected function checkEmptyOrInvalidString($var, $var_name)
    {
        if (! is_string($var) || empty($var)) {
            throw new EmptyOrInvalidParameterException($var_name);
        }
    }
}
