<?php

namespace Auth0\SDK\API\Management\NetworkAcls;

use Auth0\SDK\API\Management\NetworkAcls\Requests\ListNetworkAclsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\NetworkAclsResponseContent;
use Auth0\SDK\API\Management\NetworkAcls\Requests\CreateNetworkAclRequestContent;
use Auth0\SDK\API\Management\Types\GetNetworkAclsResponseContent;
use Auth0\SDK\API\Management\NetworkAcls\Requests\SetNetworkAclRequestContent;
use Auth0\SDK\API\Management\Types\SetNetworkAclsResponseContent;
use Auth0\SDK\API\Management\NetworkAcls\Requests\UpdateNetworkAclRequestContent;
use Auth0\SDK\API\Management\Types\UpdateNetworkAclResponseContent;

interface NetworkAclsClientInterface
{
    /**
     * Get all access control list entries for your client.
     *
     * @param ListNetworkAclsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<NetworkAclsResponseContent>
     */
    public function list(ListNetworkAclsRequestParameters $request = new ListNetworkAclsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new access control list for your client.
     *
     * @param CreateNetworkAclRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function create(CreateNetworkAclRequestContent $request, ?array $options = null): void;

    /**
     * Get a specific access control list entry for your client.
     *
     * @param string $id The id of the access control list to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetNetworkAclsResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetNetworkAclsResponseContent;

    /**
     * Update existing access control list for your client.
     *
     * @param string $id The id of the ACL to update.
     * @param SetNetworkAclRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetNetworkAclsResponseContent
     */
    public function set(string $id, SetNetworkAclRequestContent $request, ?array $options = null): ?SetNetworkAclsResponseContent;

    /**
     * Delete existing access control list for your client.
     *
     * @param string $id The id of the ACL to delete
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;

    /**
     * Update existing access control list for your client.
     *
     * @param string $id The id of the ACL to update.
     * @param UpdateNetworkAclRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateNetworkAclResponseContent
     */
    public function update(string $id, UpdateNetworkAclRequestContent $request = new UpdateNetworkAclRequestContent(), ?array $options = null): ?UpdateNetworkAclResponseContent;
}
