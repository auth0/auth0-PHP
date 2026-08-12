<?php

namespace Auth0\SDK\API\Management\Forms;

use Auth0\SDK\API\Management\Forms\Requests\ListFormsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\FormSummary;
use Auth0\SDK\API\Management\Forms\Requests\CreateFormRequestContent;
use Auth0\SDK\API\Management\Types\CreateFormResponseContent;
use Auth0\SDK\API\Management\Forms\Requests\GetFormRequestParameters;
use Auth0\SDK\API\Management\Types\GetFormResponseContent;
use Auth0\SDK\API\Management\Forms\Requests\UpdateFormRequestContent;
use Auth0\SDK\API\Management\Types\UpdateFormResponseContent;

interface FormsClientInterface
{
    /**
     * Example:
     * ```php
     * $client->forms->list(
     *     new ListFormsRequestParameters([
     *         'page' => 1,
     *         'perPage' => 1,
     *         'includeTotals' => true,
     *         'hydrate' => [
     *             FormsRequestParametersHydrateEnum::FlowCount->value,
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param ListFormsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<FormSummary>
     */
    public function list(ListFormsRequestParameters $request = new ListFormsRequestParameters(), ?array $options = null): Pager;

    /**
     * Example:
     * ```php
     * $client->forms->create(
     *     new CreateFormRequestContent([
     *         'name' => 'name',
     *     ]),
     * );
     * ```
     *
     * @param CreateFormRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateFormResponseContent
     */
    public function create(CreateFormRequestContent $request, ?array $options = null): ?CreateFormResponseContent;

    /**
     * Example:
     * ```php
     * $client->forms->get(
     *     'id',
     *     new GetFormRequestParameters([
     *         'hydrate' => [
     *             FormsRequestParametersHydrateEnum::FlowCount->value,
     *         ],
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the form to retrieve.
     * @param GetFormRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetFormResponseContent
     */
    public function get(string $id, GetFormRequestParameters $request = new GetFormRequestParameters(), ?array $options = null): ?GetFormResponseContent;

    /**
     * Example:
     * ```php
     * $client->forms->delete(
     *     'id',
     * );
     * ```
     *
     * @param string $id The ID of the form to delete.
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
     * Example:
     * ```php
     * $client->forms->update(
     *     'id',
     *     new UpdateFormRequestContent([]),
     * );
     * ```
     *
     * @param string $id The ID of the form to update.
     * @param UpdateFormRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateFormResponseContent
     */
    public function update(string $id, UpdateFormRequestContent $request = new UpdateFormRequestContent(), ?array $options = null): ?UpdateFormResponseContent;
}
