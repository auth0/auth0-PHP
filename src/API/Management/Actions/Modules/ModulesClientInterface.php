<?php

namespace Auth0\SDK\API\Management\Actions\Modules;

use Auth0\SDK\API\Management\Actions\Modules\Requests\GetActionModulesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ActionModuleListItem;
use Auth0\SDK\API\Management\Actions\Modules\Requests\CreateActionModuleRequestContent;
use Auth0\SDK\API\Management\Types\CreateActionModuleResponseContent;
use Auth0\SDK\API\Management\Types\GetActionModuleResponseContent;
use Auth0\SDK\API\Management\Actions\Modules\Requests\UpdateActionModuleRequestContent;
use Auth0\SDK\API\Management\Types\UpdateActionModuleResponseContent;
use Auth0\SDK\API\Management\Actions\Modules\Requests\GetActionModuleActionsRequestParameters;
use Auth0\SDK\API\Management\Types\ActionModuleAction;
use Auth0\SDK\API\Management\Actions\Modules\Requests\RollbackActionModuleRequestParameters;
use Auth0\SDK\API\Management\Types\RollbackActionModuleResponseContent;
use Auth0\SDK\API\Management\Actions\Modules\Versions\VersionsClientInterface;

interface ModulesClientInterface
{
    /**
     * Retrieve a paginated list of all Actions Modules with optional filtering and totals.
     *
     * @param GetActionModulesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ActionModuleListItem>
     */
    public function list(GetActionModulesRequestParameters $request = new GetActionModulesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new Actions Module for reusable code across actions.
     *
     * @param CreateActionModuleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateActionModuleResponseContent
     */
    public function create(CreateActionModuleRequestContent $request, ?array $options = null): ?CreateActionModuleResponseContent;

    /**
     * Retrieve details of a specific Actions Module by its unique identifier.
     *
     * @param string $id The ID of the action module to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetActionModuleResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetActionModuleResponseContent;

    /**
     * Permanently delete an Actions Module. This will fail if the module is still in use by any actions.
     *
     * @param string $id The ID of the Actions Module to delete.
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
     * Update properties of an existing Actions Module, such as code, dependencies, or secrets.
     *
     * @param string $id The ID of the action module to update.
     * @param UpdateActionModuleRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateActionModuleResponseContent
     */
    public function update(string $id, UpdateActionModuleRequestContent $request = new UpdateActionModuleRequestContent(), ?array $options = null): ?UpdateActionModuleResponseContent;

    /**
     * Lists all actions that are using a specific Actions Module, showing which deployed action versions reference this Actions Module.
     *
     * @param string $id The unique ID of the module.
     * @param GetActionModuleActionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ActionModuleAction>
     */
    public function listActions(string $id, GetActionModuleActionsRequestParameters $request = new GetActionModuleActionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Rolls back an Actions Module's draft to a previously created version. This action copies the code, dependencies, and secrets from the specified version into the current draft.
     *
     * @param string $id The unique ID of the module to roll back.
     * @param RollbackActionModuleRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?RollbackActionModuleResponseContent
     */
    public function rollback(string $id, RollbackActionModuleRequestParameters $request, ?array $options = null): ?RollbackActionModuleResponseContent;

    /**
     * @return VersionsClientInterface
     */
    public function getVersions(): VersionsClientInterface;
}
