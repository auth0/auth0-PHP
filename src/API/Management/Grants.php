<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Shortcut;
use Auth0\SDK\Utility\Validate;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Grants.
 * Handles requests to the Grants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Grants
 */
final class Grants extends ManagementEndpoint
{
    /**
     * Retrieve the grants associated with your account.
     * Required scope: `read:grants`
     *
     * @param array<string,int|string|null>|null $parameters Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null                $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()->method('get')
            ->addPath('grants')
            ->withParams($parameters ?? [])
            ->withOptions($options)
            ->call();
    }

    /**
     * Get Grants by Client ID with pagination.
     * Required scope: `read:grants`
     *
     * @param string                             $clientId   Client ID to filter Grants.
     * @param array<string,int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null                $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByClientId(
        string $clientId,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($clientId, 'clientId');

        $parameters = Shortcut::mergeArrays([
            'client_id' => $clientId,
        ], $parameters);

        return $this->getAll($parameters, $options);
    }

    /**
     * Get Grants by Audience with pagination.
     * Required scope: `read:grants`
     *
     * @param string                             $audience   Audience to filter Grants.
     * @param array<string,int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null                $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByAudience(
        string $audience,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($audience, 'audience');

        $parameters = Shortcut::mergeArrays([
            'audience' => $audience,
        ], $parameters ?? []);

        return $this->getAll($parameters, $options);
    }

    /**
     * Get Grants by User ID with pagination.
     * Required scope: `read:grants`
     *
     * @param string                             $userId     User ID to filter Grants.
     * @param array<string,int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null                $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getAllByUserId(
        string $userId,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($userId, 'userId');

        $parameters = Shortcut::mergeArrays([
            'user_id' => $userId,
        ], $parameters);

        return $this->getAll($parameters, $options);
    }

    /**
     * Delete a grant by Grant ID or User ID.
     * Required scope: `delete:grants`
     *
     * @param string              $id      Grant ID to delete a single Grant or User ID to delete all Grants for a User.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/delete_grants_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        Validate::string($id, 'id');

        return $this->getHttpClient()->method('delete')
            ->addPath('grants', $id)
            ->withOptions($options)
            ->call();
    }
}
