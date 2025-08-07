<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface NetworkAclsInterface
{
    /**
     * Create a new Access Control List.
     * Required scope: `create:network_acls`.
     *
     * @param string              $description the type of log stream being created
     * @param bool                $active      whether the ACL is active or not
     * @param int                 $priority    the order in which the ACL will be evaluated relative to other ACL rules
     * @param array<string>       $rule        the rules to apply to the ACL
     * @param null|array<mixed>   $additional  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param null|RequestOptions $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `type` or `sink` are provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/post_network_acls
     */
    public function create(
        string $description,
        bool $active,
        int $priority,
        array $rule,
        ?array $additional = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete an Access Control List.
     * Required scope: `delete:network_acls`.
     *
     * @param string              $id      ID of the Access Control List to delete
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/delete_network_acls_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get a Single Access Control List.
     * Required scope: `read:network_acls`.
     *
     * @param string              $id      log Stream ID to query
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/get_network_acls_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get all Access Control Lists.
     * Required scope: `read:network_acls`.
     *
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/get_network_acls
     */
    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update partially an existing Access Control List.
     * Required scope: `update:network_acls`.
     *
     * @param string              $id      ID of the Access Control List to update
     * @param array<mixed>        $body    Log Stream data to update. Only certain fields are update-able; see the linked documentation.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/patch_network_acls_by_id
     */
    public function patch(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an existing Access Control List.
     * Required scope: `update:network_acls`.
     *
     * @param string              $id      ID of the Access Control List to update
     * @param array<mixed>        $body    Log Stream data to update. Only certain fields are update-able; see the linked documentation.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Network_Acls/put_network_acls_by_id
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
