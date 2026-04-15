<?php

namespace Auth0\SDK\API\Management\Actions;

use Auth0\SDK\API\Management\Actions\Requests\ListActionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\Action;
use Auth0\SDK\API\Management\Actions\Requests\CreateActionRequestContent;
use Auth0\SDK\API\Management\Types\CreateActionResponseContent;
use Auth0\SDK\API\Management\Types\GetActionResponseContent;
use Auth0\SDK\API\Management\Actions\Requests\DeleteActionRequestParameters;
use Auth0\SDK\API\Management\Actions\Requests\UpdateActionRequestContent;
use Auth0\SDK\API\Management\Types\UpdateActionResponseContent;
use Auth0\SDK\API\Management\Types\DeployActionResponseContent;
use Auth0\SDK\API\Management\Actions\Requests\TestActionRequestContent;
use Auth0\SDK\API\Management\Types\TestActionResponseContent;
use Auth0\SDK\API\Management\Actions\Versions\VersionsClientInterface;
use Auth0\SDK\API\Management\Actions\Executions\ExecutionsClientInterface;
use Auth0\SDK\API\Management\Actions\Modules\ModulesClientInterface;
use Auth0\SDK\API\Management\Actions\Triggers\TriggersClientInterface;

interface ActionsClientInterface
{
    /**
     * Retrieve all actions.
     *
     * @param ListActionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<Action>
     */
    public function list(ListActionsRequestParameters $request = new ListActionsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create an action. Once an action is created, it must be deployed, and then bound to a trigger before it will be executed as part of a flow.
     *
     * @param CreateActionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateActionResponseContent
     */
    public function create(CreateActionRequestContent $request, ?array $options = null): ?CreateActionResponseContent;

    /**
     * Retrieve an action by its ID.
     *
     * @param string $id The ID of the action to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetActionResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetActionResponseContent;

    /**
     * Deletes an action and all of its associated versions. An action must be unbound from all triggers before it can be deleted.
     *
     * @param string $id The ID of the action to delete.
     * @param DeleteActionRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, DeleteActionRequestParameters $request = new DeleteActionRequestParameters(), ?array $options = null): void;

    /**
     * Update an existing action. If this action is currently bound to a trigger, updating it will <strong>not</strong> affect any user flows until the action is deployed.
     *
     * @param string $id The id of the action to update.
     * @param UpdateActionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateActionResponseContent
     */
    public function update(string $id, UpdateActionRequestContent $request = new UpdateActionRequestContent(), ?array $options = null): ?UpdateActionResponseContent;

    /**
     * Deploy an action. Deploying an action will create a new immutable version of the action. If the action is currently bound to a trigger, then the system will begin executing the newly deployed version of the action immediately. Otherwise, the action will only be executed as a part of a flow once it is bound to that flow.
     *
     * @param string $id The ID of an action.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?DeployActionResponseContent
     */
    public function deploy(string $id, ?array $options = null): ?DeployActionResponseContent;

    /**
     * Test an action. After updating an action, it can be tested prior to being deployed to ensure it behaves as expected.
     *
     * @param string $id The id of the action to test.
     * @param TestActionRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TestActionResponseContent
     */
    public function test(string $id, TestActionRequestContent $request, ?array $options = null): ?TestActionResponseContent;

    /**
     * @return VersionsClientInterface
     */
    public function getVersions(): VersionsClientInterface;

    /**
     * @return ExecutionsClientInterface
     */
    public function getExecutions(): ExecutionsClientInterface;

    /**
     * @return ModulesClientInterface
     */
    public function getModules(): ModulesClientInterface;

    /**
     * @return TriggersClientInterface
     */
    public function getTriggers(): TriggersClientInterface;
}
