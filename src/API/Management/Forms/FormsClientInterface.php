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
