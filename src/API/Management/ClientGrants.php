<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class ClientGrants.
 * Handles requests to the Client Grants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Client_Grants
 */
class ClientGrants extends GenericResource
{
    /**
     * Create a new Client Grant.
     * Required scope: `create:client_grants`
     *
     * @param string              $clientId Client ID to receive the grant.
     * @param string              $audience Audience identifier for the API being granted.
     * @param array               $scope    Optional. Scopes allowed for this client grant.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/post_client_grants
     */
    public function create(
        string $clientId,
        string $audience,
        array $scope = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($clientId, 'clientId');
        $this->validateString($audience, 'audience');

        return $this->apiClient->method('post')
            ->addPath('client-grants')
            ->withBody(
                (object) [
                    'client_id' => $clientId,
                    'audience' => $audience,
                    'scope' => $scope,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve client grants, by page if desired.
     * Required scope: `read:client_grants`
     *
     * @param array               $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAll(
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('client-grants')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get Client Grants by audience.
     * Required scope: `read:client_grants`
     *
     * @param string              $audience   API Audience to filter by.
     * @param array               $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByAudience(
        string $audience,
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($audience, 'audience');

        return $this->getAll(
            [
                'audience' => $audience,
            ] + $parameters,
            $options
        );
    }

    /**
     * Get Client Grants by Client ID.
     * Required scope: `read:client_grants`
     *
     * @param string              $clientId   Client ID to filter by.
     * @param array               $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/get_client_grants
     */
    public function getAllByClientId(
        string $clientId,
        array $parameters = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($clientId, 'clientId');

        return $this->getAll(
            [
                'client_id' => $clientId,
            ] + $parameters,
            $options
        );
    }

    /**
     * Update an existing Client Grant.
     * Required scope: `update:client_grants`
     *
     * @param string              $id      Grant (by it's ID) to update.
     * @param array               $scope   Optional. Array of scopes to update; will replace existing scopes, not merge.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/patch_client_grants_by_id
     */
    public function update(
        string $id,
        array $scope = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('patch')
            ->addPath('client-grants', $id)
            ->withBody(
                (object) [
                    'scope' => $scope,
                ]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a Client Grant by ID.
     * Required scope: `delete:client_grants`
     *
     * @param string              $id      Grant (by it's ID) to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException Thrown by the HTTP client when there is a problem with the API call.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Client_Grants/delete_client_grants_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($id, 'id');

        return $this->apiClient->method('delete')
            ->addPath('client-grants', $id)
            ->withOptions($options)
            ->call();
    }
}
