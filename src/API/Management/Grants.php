<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Grants.
 * Handles requests to the Grants endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Grants
 *
 * @package Auth0\SDK\API\Management
 */
class Grants extends GenericResource
{
    /**
     * Retrieve the grants associated with your account.
     * Required scope: `read:grants`
     *
     * @param array               $query   Optional. Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function get(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('grants')
            ->withParams($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get Grants by Client ID with pagination.
     * Required scope: `read:grants`
     *
     * @param string              $clientId Client ID to filter Grants.
     * @param array               $query    Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByClientId(
        string $clientId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'client_id' => $clientId
        ] + $query;

        return $this->get($payload, $options);
    }

    /**
     * Get Grants by Audience with pagination.
     * Required scope: `read:grants`
     *
     * @param string              $audience Audience to filter Grants.
     * @param array               $query    Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByAudience(
        string $audience,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'audience' => $audience
        ] + $query;

        return $this->get($payload, $options);
    }

    /**
     * Get Grants by User ID with pagination.
     * Required scope: `read:grants`
     *
     * @param string              $userId  User ID to filter Grants.
     * @param array               $query   Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/get_grants
     */
    public function getByUserId(
        string $userId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'user_id' => $userId
        ] + $query;

        return $this->get($payload, $options);
    }

    /**
     * Delete a grant by Grant ID or User ID.
     * Required scope: `delete:grants`
     *
     * @param string              $id      Grant ID to delete a single Grant or User ID to delete all Grants for a User.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Grants/delete_grants_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('grants', $id)
            ->withOptions($options)
            ->call();
    }
}
