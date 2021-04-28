<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class ClientGrants.
 * Handles requests to the Client Grants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Client_Grants
 *
 * @package Auth0\SDK\API\Management
 */
class ClientGrants extends GenericResource
{
    /**
     * Retrieve client grants, by page if desired.
     * Required scope: `read:client_grants`
     *
     * @param array               $query   Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function get(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('client-grants')
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get Client Grants by audience.
     * Required scope: `read:client_grants`
     *
     * @param string              $audience API Audience to filter by.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getByAudience(
        string $audience,
        ?RequestOptions $options = null
    ): ?array {
        return $this->get(
            [
                'audience' => $audience
            ],
            $options
        );
    }

    /**
     * Get Client Grants by Client ID.
     * Required scope: `read:client_grants`
     *
     * @param string              $clientId Client ID to filter by.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getByClientId(
        string $clientId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->get(
            [
                'client_id' => $clientId
            ],
            $options
        );
    }

    /**
     * Create a new Client Grant.
     * Required scope: `create:client_grants`
     *
     * @param string              $clientId Client ID to receive the grant.
     * @param string              $audience Audience identifier for the API being granted.
     * @param array               $scope    Optional. Array of scopes for the grant.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     */
    public function create(
        string $clientId,
        string $audience,
        array $scope = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('client-grants')
            ->withBody(
                [
                    'client_id' => $clientId,
                    'audience'  => $audience,
                    'scope'     => $scope,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Client Grant by ID.
     * Required scope: `delete:client_grants`
     *
     * @param string              $grantId Client Grant ID to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     */
    public function delete(
        string $grantId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('client-grants', $grantId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update an existing Client Grant.
     * Required scope: `update:client_grants`
     *
     * @param string              $grantId Client Grant ID to update.
     * @param array               $scope   Array of scopes to update; will replace existing scopes, not merge.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     */
    public function update(
        string $grantId,
        array $scope,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('client-grants', $grantId)
            ->withBody(
                [
                    'scope' => $scope
                ]
            )
            ->withOptions($options)
            ->call();
    }
}
