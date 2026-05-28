<?php

namespace Auth0\SDK\API\Management\RateLimitPolicies;

use Auth0\SDK\API\Management\RateLimitPolicies\Requests\ListRateLimitPoliciesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\RateLimitPolicy;
use Auth0\SDK\API\Management\RateLimitPolicies\Requests\CreateRateLimitPolicyRequestContent;
use Auth0\SDK\API\Management\Types\CreateRateLimitPolicyResponseContent;
use Auth0\SDK\API\Management\Types\GetRateLimitPolicyResponseContent;
use Auth0\SDK\API\Management\RateLimitPolicies\Requests\PatchRateLimitPolicyRequestContent;
use Auth0\SDK\API\Management\Types\UpdateRateLimitPolicyResponseContent;

interface RateLimitPoliciesClientInterface
{
    /**
     * @param ListRateLimitPoliciesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<RateLimitPolicy>
     */
    public function list(ListRateLimitPoliciesRequestParameters $request = new ListRateLimitPoliciesRequestParameters(), ?array $options = null): Pager;

    /**
     * @param CreateRateLimitPolicyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateRateLimitPolicyResponseContent
     */
    public function create(CreateRateLimitPolicyRequestContent $request, ?array $options = null): ?CreateRateLimitPolicyResponseContent;

    /**
     * @param string $id Unique identifier for the Rate Limit Policy.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetRateLimitPolicyResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetRateLimitPolicyResponseContent;

    /**
     * @param string $id Unique identifier for the Rate Limit Policy.
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
     * @param string $id Unique identifier for the Rate Limit Policy.
     * @param PatchRateLimitPolicyRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateRateLimitPolicyResponseContent
     */
    public function update(string $id, PatchRateLimitPolicyRequestContent $request, ?array $options = null): ?UpdateRateLimitPolicyResponseContent;
}
