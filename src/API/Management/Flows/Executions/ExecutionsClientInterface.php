<?php

namespace Auth0\SDK\API\Management\Flows\Executions;

use Auth0\SDK\API\Management\Flows\Executions\Requests\ListFlowExecutionsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FlowExecutionSummary;
use Auth0\SDK\API\Management\Flows\Executions\Requests\GetFlowExecutionRequestParameters;
use Auth0\SDK\API\Management\Types\GetFlowExecutionResponseContent;

interface ExecutionsClientInterface
{
    /**
     * @param string $flowId Flow id
     * @param ListFlowExecutionsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FlowExecutionSummary>
     */
    public function list(string $flowId, ListFlowExecutionsRequestParameters $request = new ListFlowExecutionsRequestParameters(), ?array $options = null): Pager;

    /**
     * @param string $flowId Flow id
     * @param string $executionId Flow execution id
     * @param GetFlowExecutionRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFlowExecutionResponseContent
     */
    public function get(string $flowId, string $executionId, GetFlowExecutionRequestParameters $request = new GetFlowExecutionRequestParameters(), ?array $options = null): ?GetFlowExecutionResponseContent;

    /**
     * @param string $flowId Flows id
     * @param string $executionId Flow execution identifier
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $flowId, string $executionId, ?array $options = null): void;
}
