<?php

namespace Auth0\SDK\API\Management\Actions\Triggers;

use Auth0\SDK\API\Management\Types\ListActionTriggersResponseContent;
use Auth0\SDK\API\Management\Actions\Triggers\Bindings\BindingsClientInterface;

interface TriggersClientInterface
{
    /**
     * Retrieve the set of triggers currently available within actions. A trigger is an extensibility point to which actions can be bound.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ListActionTriggersResponseContent
     */
    public function list(?array $options = null): ?ListActionTriggersResponseContent;

    /**
     * @return BindingsClientInterface
     */
    public function getBindings(): BindingsClientInterface;
}
