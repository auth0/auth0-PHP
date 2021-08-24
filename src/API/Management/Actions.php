<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Actions.
 * Handles requests to the Actions endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Actions
 */
final class Actions extends ManagementEndpoint
{
    /**
     * Create an action. Once an action is created, it must be deployed, and then bound to a trigger before it will be executed as part of a flow.
     * Required scope: `create:actions`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/post_action
     */
    public function create(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('actions', 'actions')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve all actions.
     * Required scope: `read:actions`
     *
     * @param array<int|string|null>|null $parameters Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null         $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_actions
     */
    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', 'actions')
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve an action by its ID.
     * Required scope: `read:actions`
     *
     * @param string              $id      Action (by it's ID) to retrieve.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_action
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', 'actions', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update an existing action. If this action is currently bound to a trigger, updating it will not affect any user flows until the action is deployed.
     * Required scope: `update:actions`
     *
     * @param string              $id      Action (by it's ID) to update.
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/patch_action
     */
    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('actions', 'actions', $id)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete an action and all of its associated versions. An action must be unbound from all triggers before it can be deleted.
     * Required scope: `delete:actions`
     *
     * @param string              $id      Action (by it's ID) to delete.
     * @param bool|null           $force   Force action deletion detaching bindings
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/delete_action
     */
    public function delete(
        string $id,
        ?bool $force = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('actions', 'actions', $id)
            ->withParams(Toolkit::filter([
                [
                    'force' => $force,
                ],
            ])->array()->trim()[0])
            ->withOptions($options)
            ->call();
    }

    /**
     * Deploy an action. Deploying an action will create a new immutable version of the action. If the action is currently bound to a trigger, then the system will begin executing the newly deployed version of the action immediately. Otherwise, the action will only be executed as a part of a flow once it is bound to that flow.
     * Required scope: `create:actions`
     *
     * @param string              $id      Action (by it's ID) to deploy.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_action
     */
    public function deploy(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('actions', $id, 'deploy')
            ->withOptions($options)
            ->call();
    }

    /**
     * Test an action. After updating an action, it can be tested prior to being deployed to ensure it behaves as expected.
     * Required scope: `create:actions`
     *
     * @param string              $id      Action (by it's ID) to test.
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/post_test_action
     */
    public function test(
        string $id,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('actions', 'actions', $id, 'test')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve a specific version of an action. An action version is created whenever an action is deployed. An action version is immutable, once created.
     * Required scope: `read:actions`
     *
     * @param string              $id       Action version (by it's ID) to retrieve.
     * @param string              $actionId Action (by it's ID) to retrieve.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_action_version
     */
    public function getVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id, $actionId] = Toolkit::filter([$id, $actionId])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', $actionId, 'versions', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve all of an action's versions. An action version is created whenever an action is deployed. An action version is immutable, once created.
     * Required scope: `read:actions`
     *
     * @param string              $actionId Action (by it's ID) to retrieve.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_action_versions
     */
    public function getVersions(
        string $actionId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$actionId] = Toolkit::filter([$actionId])->string()->trim();

        Toolkit::assert([
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', $actionId, 'versions')
            ->withOptions($options)
            ->call();
    }

    /**
     * Performs the equivalent of a roll-back of an action to an earlier, specified version. Creates a new, deployed action version that is identical to the specified version. If this action is currently bound to a trigger, the system will begin executing the newly-created version immediately.
     * Required scope: `read:actions`
     *
     * @param string              $id       Action version (by it's ID) to roll-back to.
     * @param string              $actionId Action (by it's ID) to perform the roll-back on.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/post_deploy_draft_version
     */
    public function rollbackVersion(
        string $id,
        string $actionId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$actionId, $id] = Toolkit::filter([$actionId, $id])->string()->trim();

        Toolkit::assert([
            [$actionId, \Auth0\SDK\Exception\ArgumentException::missing('actionId')],
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('actions', $actionId, 'versions', $id, 'deploy')
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve the set of triggers currently available within actions. A trigger is an extensibility point to which actions can be bound.
     * Required scope: `read:actions`
     *
     * @param RequestOptions|null $options   Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_triggers
     */
    public function getTriggers(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', 'triggers')
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve the actions that are bound to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The list of actions returned reflects the order in which they will be executed during the appropriate flow.
     * Required scope: `read:actions`
     *
     * @param string              $triggerId An actions extensibility point.
     * @param RequestOptions|null $options   Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_bindings
     */
    public function getTriggerBindings(
        string $triggerId,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$triggerId] = Toolkit::filter([$triggerId])->string()->trim();

        Toolkit::assert([
            [$triggerId, \Auth0\SDK\Exception\ArgumentException::missing('triggerId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', 'triggers', $triggerId, 'bindings')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the actions that are bound (i.e. attached) to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The order in which the actions are provided will determine the order in which they are executed.
     * Required scope: `update:actions`
     *
     * @param string              $triggerId An actions extensibility point.
     * @param array<mixed>        $body      Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options   Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/patch_bindings
     */
    public function updateTriggerBindings(
        string $triggerId,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$triggerId] = Toolkit::filter([$triggerId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$triggerId, \Auth0\SDK\Exception\ArgumentException::missing('triggerId')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('actions', 'triggers', $triggerId, 'bindings')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get information about a specific execution of a trigger. Relevant execution IDs will be included in tenant logs generated as part of that authentication flow. Executions will only be stored for 10 days after their creation.
     * Required scope: `read:actions`
     *
     * @param string              $id      Execution (by it's ID) to retrieve.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Actions/get_execution
     */
    public function getExecution(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('actions', 'executions', $id)
            ->withOptions($options)
            ->call();
    }
}
