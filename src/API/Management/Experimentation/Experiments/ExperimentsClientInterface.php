<?php

namespace Auth0\SDK\API\Management\Experimentation\Experiments;

use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\ListExperimentsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\ExperimentListItem;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\CreateExperimentRequestContent;
use Auth0\SDK\API\Management\Types\CreateExperimentResponseContent;
use Auth0\SDK\API\Management\Types\GetExperimentResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\UpdateExperimentRequestParameters;
use Auth0\SDK\API\Management\Types\UpdateExperimentResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\AdvanceRampRequestContent;
use Auth0\SDK\API\Management\Types\AdvanceRampResponseContent;
use Auth0\SDK\API\Management\Experimentation\Experiments\Requests\UpdateExperimentStatusRequestContent;
use Auth0\SDK\API\Management\Types\UpdateExperimentStatusResponseContent;
use Auth0\SDK\API\Management\Types\ValidateExperimentResponseContent;

interface ExperimentsClientInterface
{
    /**
     * Retrieve a paginated list of experiments for the tenant, with optional filters.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->list(
     *     new ListExperimentsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *         'status' => ExperimentStatusEnum::Draft->value,
     *         'authenticationFlow' => 'authentication_flow',
     *         'featureFlagId' => 'feature_flag_id',
     *     ]),
     * );
     * ```
     *
     * @param ListExperimentsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<ExperimentListItem>
     */
    public function list(ListExperimentsRequestParameters $request = new ListExperimentsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new experiment for A/B testing.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->create(
     *     new CreateExperimentRequestContent([
     *         'name' => 'name',
     *         'featureFlagId' => 'feature_flag_id',
     *         'authenticationFlow' => AuthenticationFlowEnum::Authentication->value,
     *     ]),
     * );
     * ```
     *
     * @param CreateExperimentRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateExperimentResponseContent
     */
    public function create(CreateExperimentRequestContent $request, ?array $options = null): ?CreateExperimentResponseContent;

    /**
     * Retrieve a single experiment with its allocations by ID.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetExperimentResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetExperimentResponseContent;

    /**
     * Permanently delete an experiment and its allocations by ID. Active experiments cannot be deleted; pause or complete first. Idempotent: returns 204 even if the experiment does not exist.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to delete.
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
     * Partially update an experiment by ID. Only provided fields are updated. Providing allocations replaces the entire allocations set.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->update(
     *     'id',
     *     new UpdateExperimentRequestParameters([]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to update.
     * @param UpdateExperimentRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateExperimentResponseContent
     */
    public function update(string $id, UpdateExperimentRequestParameters $request = new UpdateExperimentRequestParameters(), ?array $options = null): ?UpdateExperimentResponseContent;

    /**
     * Increments the current ramp index to the requested target level. Up-only: the target must be the immediate next level in the schedule. Idempotent: calling with the current level returns success without writing anything.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->advanceRamp(
     *     'id',
     *     new AdvanceRampRequestContent([
     *         'targetLevel' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to advance.
     * @param AdvanceRampRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?AdvanceRampResponseContent
     */
    public function advanceRamp(string $id, AdvanceRampRequestContent $request, ?array $options = null): ?AdvanceRampResponseContent;

    /**
     * Transitions an experiment through its lifecycle: draft → active, active → paused, paused → active, active/paused → completed. Activation runs full readiness validation.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->updateStatus(
     *     'id',
     *     new UpdateExperimentStatusRequestContent([
     *         'status' => ExperimentTransitionStatusEnum::Active->value,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the experiment to transition.
     * @param UpdateExperimentStatusRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateExperimentStatusResponseContent
     */
    public function updateStatus(string $id, UpdateExperimentStatusRequestContent $request, ?array $options = null): ?UpdateExperimentStatusResponseContent;

    /**
     * Checks whether an experiment is ready to be activated. Returns is_valid boolean and an errors array describing any blockers. Read-only; no state is modified.
     *
     * Example:
     * ```php
     * $client->experimentation->experiments->validate(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the experiment to validate.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?ValidateExperimentResponseContent
     */
    public function validate(string $id, ?array $options = null): ?ValidateExperimentResponseContent;
}
