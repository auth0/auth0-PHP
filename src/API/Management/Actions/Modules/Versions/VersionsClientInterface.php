<?php

namespace Auth0\SDK\API\Management\Actions\Modules\Versions;

use Auth0\SDK\API\Management\Actions\Modules\Versions\Requests\GetActionModuleVersionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ActionModuleVersion;
use Auth0\SDK\API\Management\Types\CreateActionModuleVersionResponseContent;
use Auth0\SDK\API\Management\Types\GetActionModuleVersionResponseContent;

interface VersionsClientInterface
{
    /**
     * List all published versions of a specific Actions Module.
     *
     * @param string $id The unique ID of the module.
     * @param GetActionModuleVersionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ActionModuleVersion>
     */
    public function list(string $id, GetActionModuleVersionsRequestParameters $request = new GetActionModuleVersionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Creates a new immutable version of an Actions Module from the current draft version. This publishes the draft as a new version that can be referenced by actions, while maintaining the existing draft for continued development.
     *
     * @param string $id The ID of the action module to create a version for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateActionModuleVersionResponseContent
     */
    public function create(string $id, ?array $options = null): ?CreateActionModuleVersionResponseContent;

    /**
     * Retrieve the details of a specific, immutable version of an Actions Module.
     *
     * @param string $id The unique ID of the module.
     * @param string $versionId The unique ID of the module version to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetActionModuleVersionResponseContent
     */
    public function get(string $id, string $versionId, ?array $options = null): ?GetActionModuleVersionResponseContent;
}
