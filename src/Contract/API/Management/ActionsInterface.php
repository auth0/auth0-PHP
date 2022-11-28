<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface ActionsInterface.
 */
interface ActionsInterface
{
    /**
     * Create an action. Once an action is created, it must be deployed, and then bound to a trigger before it will be executed as part of a flow.
     * Required scope: `create:actions`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/post_action
     */
    public function create(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve all actions.
     * Required scope: `read:actions`.
     *
     * @param  array<int|string|null>|null  $parameters  Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_actions
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve an action by its ID.
     * Required scope: `read:actions`.
     *
     * @param  string  $id  action (by it's ID) to retrieve
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_action
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an existing action. If this action is currently bound to a trigger, updating it will not affect any user flows until the action is deployed.
     * Required scope: `update:actions`.
     *
     * @param  string  $id  action (by it's ID) to update
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/patch_action
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete an action and all of its associated versions. An action must be unbound from all triggers before it can be deleted.
     * Required scope: `delete:actions`.
     *
     * @param  string  $id  action (by it's ID) to delete
     * @param  bool|null  $force  Force action deletion detaching bindings
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/delete_action
     */
    public function delete(
        string $id,
        ?bool $force = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Deploy an action. Deploying an action will create a new immutable version of the action. If the action is currently bound to a trigger, then the system will begin executing the newly deployed version of the action immediately. Otherwise, the action will only be executed as a part of a flow once it is bound to that flow.
     * Required scope: `create:actions`.
     *
     * @param  string  $id  action (by it's ID) to deploy
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_action
     */
    public function deploy(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Test an action. After updating an action, it can be tested prior to being deployed to ensure it behaves as expected.
     * Required scope: `create:actions`.
     *
     * @param  string  $id  action (by it's ID) to test
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/post_test_action
     */
    public function test(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve a specific version of an action. An action version is created whenever an action is deployed. An action version is immutable, once created.
     * Required scope: `read:actions`.
     *
     * @param  string  $id  action version (by it's ID) to retrieve
     * @param  string  $actionId  action (by it's ID) to retrieve
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_action_version
     */
    public function getVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve all of an action's versions. An action version is created whenever an action is deployed. An action version is immutable, once created.
     * Required scope: `read:actions`.
     *
     * @param  string  $actionId  action (by it's ID) to retrieve
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_action_versions
     */
    public function getVersions(
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Performs the equivalent of a roll-back of an action to an earlier, specified version. Creates a new, deployed action version that is identical to the specified version. If this action is currently bound to a trigger, the system will begin executing the newly-created version immediately.
     * Required scope: `read:actions`.
     *
     * @param  string  $id  action version (by it's ID) to roll-back to
     * @param  string  $actionId  action (by it's ID) to perform the roll-back on
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_draft_version
     */
    public function rollbackVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve the set of triggers currently available within actions. A trigger is an extensibility point to which actions can be bound.
     * Required scope: `read:actions`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_triggers
     */
    public function getTriggers(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve the actions that are bound to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The list of actions returned reflects the order in which they will be executed during the appropriate flow.
     * Required scope: `read:actions`.
     *
     * @param  string  $triggerId  an actions extensibility point
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_bindings
     */
    public function getTriggerBindings(
        string $triggerId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update the actions that are bound (i.e. attached) to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The order in which the actions are provided will determine the order in which they are executed.
     * Required scope: `update:actions`.
     *
     * @param  string  $triggerId  an actions extensibility point
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/patch_bindings
     */
    public function updateTriggerBindings(
        string $triggerId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get information about a specific execution of a trigger. Relevant execution IDs will be included in tenant logs generated as part of that authentication flow. Executions will only be stored for 10 days after their creation.
     * Required scope: `read:actions`.
     *
     * @param  string  $id  execution (by it's ID) to retrieve
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Actions/get_execution
     */
    public function getExecution(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
