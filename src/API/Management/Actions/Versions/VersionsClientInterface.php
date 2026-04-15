<?php

namespace Auth0\SDK\API\Management\Actions\Versions;

use Auth0\SDK\API\Management\Actions\Versions\Requests\ListActionVersionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ActionVersion;
use Auth0\SDK\API\Management\Types\GetActionVersionResponseContent;
use Auth0\SDK\API\Management\Types\DeployActionVersionRequestContent;
use Auth0\SDK\API\Management\Types\DeployActionVersionResponseContent;

interface VersionsClientInterface
{
    /**
     * Retrieve all of an action's versions. An action version is created whenever an action is deployed. An action version is immutable, once created.
     *
     * @param string $actionId The ID of the action.
     * @param ListActionVersionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ActionVersion>
     */
    public function list(string $actionId, ListActionVersionsRequestParameters $request = new ListActionVersionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Retrieve a specific version of an action. An action version is created whenever an action is deployed. An action version is immutable, once created.
     *
     * @param string $actionId The ID of the action.
     * @param string $id The ID of the action version.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetActionVersionResponseContent
     */
    public function get(string $actionId, string $id, ?array $options = null): ?GetActionVersionResponseContent;

    /**
     * Performs the equivalent of a roll-back of an action to an earlier, specified version. Creates a new, deployed action version that is identical to the specified version. If this action is currently bound to a trigger, the system will begin executing the newly-created version immediately.
     *
     * @param string $actionId The ID of an action.
     * @param string $id The ID of an action version.
     * @param ?DeployActionVersionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DeployActionVersionResponseContent
     */
    public function deploy(string $actionId, string $id, ?DeployActionVersionRequestContent $request = null, ?array $options = null): ?DeployActionVersionResponseContent;
}
