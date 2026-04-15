<?php

namespace Auth0\SDK\API\Management\Actions\Triggers\Bindings;

use Auth0\SDK\API\Management\Types\ActionTriggerTypeEnum;
use Auth0\SDK\API\Management\Actions\Triggers\Bindings\Requests\ListActionTriggerBindingsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ActionBinding;
use Auth0\SDK\API\Management\Actions\Triggers\Bindings\Requests\UpdateActionBindingsRequestContent;
use Auth0\SDK\API\Management\Types\UpdateActionBindingsResponseContent;

interface BindingsClientInterface
{
    /**
     * Retrieve the actions that are bound to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The list of actions returned reflects the order in which they will be executed during the appropriate flow.
     *
     * @param value-of<ActionTriggerTypeEnum> $triggerId An actions extensibility point.
     * @param ListActionTriggerBindingsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ActionBinding>
     */
    public function list(string $triggerId, ListActionTriggerBindingsRequestParameters $request = new ListActionTriggerBindingsRequestParameters(), ?array $options = null): Pager;

    /**
     * Update the actions that are bound (i.e. attached) to a trigger. Once an action is created and deployed, it must be attached (i.e. bound) to a trigger so that it will be executed as part of a flow. The order in which the actions are provided will determine the order in which they are executed.
     *
     * @param value-of<ActionTriggerTypeEnum> $triggerId An actions extensibility point.
     * @param UpdateActionBindingsRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateActionBindingsResponseContent
     */
    public function updateMany(string $triggerId, UpdateActionBindingsRequestContent $request = new UpdateActionBindingsRequestContent(), ?array $options = null): ?UpdateActionBindingsResponseContent;
}
