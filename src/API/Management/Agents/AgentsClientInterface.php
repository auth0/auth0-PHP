<?php

namespace Auth0\SDK\API\Management\Agents;

use Auth0\SDK\API\Management\Agents\Requests\ListAgentsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\AgentResponseContent;
use Auth0\SDK\API\Management\Agents\Requests\CreateAgentRequestContent;
use Auth0\SDK\API\Management\Agents\Requests\PatchAgentRequestParameters;

interface AgentsClientInterface
{
    /**
     * Get agents
     *
     * Example:
     * ```php
     * $client->agents->list(
     *     new ListAgentsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListAgentsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<AgentResponseContent>
     */
    public function list(ListAgentsRequestParameters $request = new ListAgentsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create an agent
     *
     * Example:
     * ```php
     * $client->agents->create(
     *     new CreateAgentRequestContent([
     *         'name' => 'name',
     *     ]),
     * );
     * ```
     *
     * @param CreateAgentRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AgentResponseContent
     */
    public function create(CreateAgentRequestContent $request, ?array $options = null): ?AgentResponseContent;

    /**
     * Get an agent
     *
     * Example:
     * ```php
     * $client->agents->read(
     *     'id',
     * );
     * ```
     *
     * @param string $id The agent ID
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AgentResponseContent
     */
    public function read(string $id, ?array $options = null): ?AgentResponseContent;

    /**
     * Delete an agent
     *
     * Example:
     * ```php
     * $client->agents->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The agent ID
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
     * Update an agent
     *
     * Example:
     * ```php
     * $client->agents->update(
     *     'id',
     *     new PatchAgentRequestParameters([]),
     * );
     * ```
     *
     * @param string $id The agent ID
     * @param PatchAgentRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AgentResponseContent
     */
    public function update(string $id, PatchAgentRequestParameters $request = new PatchAgentRequestParameters(), ?array $options = null): ?AgentResponseContent;
}
