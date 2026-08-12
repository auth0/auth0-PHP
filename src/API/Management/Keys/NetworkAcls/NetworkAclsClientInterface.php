<?php

namespace Auth0\SDK\API\Management\Keys\NetworkAcls;

use Auth0\SDK\API\Management\Keys\NetworkAcls\Requests\CreateKeysNetworkAclsRequestContent;
use Auth0\SDK\API\Management\Types\CreateKeysNetworkAclsResponseContent;

interface NetworkAclsClientInterface
{
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
}
