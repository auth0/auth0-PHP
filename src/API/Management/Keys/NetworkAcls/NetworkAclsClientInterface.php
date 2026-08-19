<?php

namespace Auth0\SDK\API\Management\Keys\NetworkAcls;

use Auth0\SDK\API\Management\Types\GetAllKeysNetworkAclsResponseContent;
use Auth0\SDK\API\Management\Keys\NetworkAcls\Requests\CreateKeysNetworkAclsRequestContent;
use Auth0\SDK\API\Management\Types\CreateKeysNetworkAclsResponseContent;
use Auth0\SDK\API\Management\Types\NetworkAclKey;

interface NetworkAclsClientInterface
{
    /**
     * Retrieve all keys used to verify HTTP Message Signatures on Network ACL rules, ordered by creation time descending.
     *
     * Example:
     * ```php
     * $client->keys->networkAcls->list();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetAllKeysNetworkAclsResponseContent
     */
    public function list(?array $options = null): ?GetAllKeysNetworkAclsResponseContent;

    /**
     * Create a new key used to verify HTTP Message Signatures on Network ACL rules.
     *
     * Example:
     * ```php
     * $client->keys->networkAcls->create(
     *     new CreateKeysNetworkAclsRequestContent([
     *         'name' => 'name',
     *         'alg' => NetworkAclKeyAlgorithmEnum::HmacSha256->value,
     *         'value' => 'value',
     *     ]),
     * );
     * ```
     *
     * @param CreateKeysNetworkAclsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateKeysNetworkAclsResponseContent
     */
    public function create(CreateKeysNetworkAclsRequestContent $request, ?array $options = null): ?CreateKeysNetworkAclsResponseContent;

    /**
     * Retrieve a specific key used to verify HTTP Message Signatures on Network ACL rules.
     *
     * Example:
     * ```php
     * $client->keys->networkAcls->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the Network ACL Key to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?NetworkAclKey
     */
    public function get(string $id, ?array $options = null): ?NetworkAclKey;

    /**
     * Delete a key used to verify HTTP Message Signatures on Network ACL rules
     *
     * Example:
     * ```php
     * $client->keys->networkAcls->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the Network ACL Key to delete.
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
}
