<?php

namespace Auth0\SDK\API\Management\Flows;

use Auth0\SDK\API\Management\Flows\Requests\ListFlowsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FlowSummary;
use Auth0\SDK\API\Management\Flows\Requests\CreateFlowRequestContent;
use Auth0\SDK\API\Management\Types\CreateFlowResponseContent;
use Auth0\SDK\API\Management\Flows\Requests\GetFlowRequestParameters;
use Auth0\SDK\API\Management\Types\GetFlowResponseContent;
use Auth0\SDK\API\Management\Flows\Requests\UpdateFlowRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFlowResponseContent;
use Auth0\SDK\API\Management\Flows\Executions\ExecutionsClientInterface;
use Auth0\SDK\API\Management\Flows\Vault\VaultClientInterface;

interface FlowsClientInterface
{
    /**
     * @param ListFlowsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FlowSummary>
     */
    public function list(ListFlowsRequestParameters $request = new ListFlowsRequestParameters(), ?array $options = null): Pager;

    /**
     * @param CreateFlowRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFlowResponseContent
     */
    public function create(CreateFlowRequestContent $request, ?array $options = null): ?CreateFlowResponseContent;

    /**
     * @param string $id Flow identifier
     * @param GetFlowRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFlowResponseContent
     */
    public function get(string $id, GetFlowRequestParameters $request = new GetFlowRequestParameters(), ?array $options = null): ?GetFlowResponseContent;

    /**
     * @param string $id Flow id
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
     * @param string $id Flow identifier
     * @param UpdateFlowRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFlowResponseContent
     */
    public function update(string $id, UpdateFlowRequestContent $request = new UpdateFlowRequestContent(), ?array $options = null): ?UpdateFlowResponseContent;

    /**
     * @return ExecutionsClientInterface
     */
    public function getExecutions(): ExecutionsClientInterface;

    /**
     * @return VaultClientInterface
     */
    public function getVault(): VaultClientInterface;
}
