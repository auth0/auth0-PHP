<?php namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use Auth0\SDK\Exception\InvalidPermissionsArrayException;

class GenericResource
{

    /**
     *
     * @var ApiClient
     */
    protected $apiClient;

    /**
     * GenericResource constructor.
     *
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
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

        foreach (array_keys( $pagination ) as $pagination_key) {
            if (empty( $pagination[$pagination_key] )) {
                unset( $pagination[$pagination_key] );
                continue;
            }

            $pagination[$pagination_key] = abs( intval( $pagination[$pagination_key] ) );
        }

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

        // If include_totals is set (not null), then make sure we have a boolean.
        if (isset( $params['include_totals'] )) {
            $params['include_totals'] = boolval( $params['include_totals'] );
        }

        return $params;
    }

    /**
     * Check for invalid permissions with an array of permissions.
     *
     * @param array $permissions Permissions array to check.
     *
     * @throws InvalidPermissionsArrayException
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
     * @param mixed  $var      The variable to check
     * @param string $var_name The variable name.
     *
     * @throws EmptyOrInvalidParameterException If $var is empty or is not a string.
     */
    protected function checkEmptyOrInvalidString($var, $var_name)
    {
        if (empty($var) || ! is_string($var)) {
            throw new EmptyOrInvalidParameterException($var_name);
        }
    }
}
