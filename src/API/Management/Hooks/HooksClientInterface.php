<?php

namespace Auth0\SDK\API\Management\Hooks;

use Auth0\SDK\API\Management\Hooks\Requests\ListHooksRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Hook;
use Auth0\SDK\API\Management\Hooks\Requests\CreateHookRequestContent;
use Auth0\SDK\API\Management\Types\CreateHookResponseContent;
use Auth0\SDK\API\Management\Hooks\Requests\GetHookRequestParameters;
use Auth0\SDK\API\Management\Types\GetHookResponseContent;
use Auth0\SDK\API\Management\Hooks\Requests\UpdateHookRequestContent;
use Auth0\SDK\API\Management\Types\UpdateHookResponseContent;
use Auth0\SDK\API\Management\Hooks\Secrets\SecretsClientInterface;

interface HooksClientInterface
{
    /**
     * Retrieve all <a href="https://auth0.com/docs/hooks">hooks</a>. Accepts a list of fields to include or exclude in the result.
     *
     * @param ListHooksRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Hook>
     */
    public function list(ListHooksRequestParameters $request = new ListHooksRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new hook.
     *
     * @param CreateHookRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateHookResponseContent
     */
    public function create(CreateHookRequestContent $request, ?array $options = null): ?CreateHookResponseContent;

    /**
     * Retrieve <a href="https://auth0.com/docs/hooks">a hook</a> by its ID. Accepts a list of fields to include in the result.
     *
     * @param string $id ID of the hook to retrieve.
     * @param GetHookRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetHookResponseContent
     */
    public function get(string $id, GetHookRequestParameters $request = new GetHookRequestParameters(), ?array $options = null): ?GetHookResponseContent;

    /**
     * Delete a hook.
     *
     * @param string $id ID of the hook to delete.
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
     * Update an existing hook.
     *
     * @param string $id ID of the hook to update.
     * @param UpdateHookRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateHookResponseContent
     */
    public function update(string $id, UpdateHookRequestContent $request = new UpdateHookRequestContent(), ?array $options = null): ?UpdateHookResponseContent;

    /**
     * @return SecretsClientInterface
     */
    public function getSecrets(): SecretsClientInterface;
}
