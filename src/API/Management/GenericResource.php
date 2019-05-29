<?php namespace Auth0\SDK\API\Management;

use Auth0\SDK\API\Helpers\ApiClient;

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

        return $pagination;
    }
}
