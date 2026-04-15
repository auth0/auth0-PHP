<?php

namespace Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates;

use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\Requests\ListVerifiableCredentialTemplatesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\VerifiableCredentialTemplateResponse;
use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\Requests\CreateVerifiableCredentialTemplateRequestContent;
use Auth0\SDK\API\Management\Types\CreateVerifiableCredentialTemplateResponseContent;
use Auth0\SDK\API\Management\Types\GetVerifiableCredentialTemplateResponseContent;
use Auth0\SDK\API\Management\VerifiableCredentials\Verification\Templates\Requests\UpdateVerifiableCredentialTemplateRequestContent;
use Auth0\SDK\API\Management\Types\UpdateVerifiableCredentialTemplateResponseContent;

interface TemplatesClientInterface
{
    /**
     * List a verifiable credential templates.
     *
     * @param ListVerifiableCredentialTemplatesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<VerifiableCredentialTemplateResponse>
     */
    public function list(ListVerifiableCredentialTemplatesRequestParameters $request = new ListVerifiableCredentialTemplatesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a verifiable credential template.
     *
     * @param CreateVerifiableCredentialTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateVerifiableCredentialTemplateResponseContent
     */
    public function create(CreateVerifiableCredentialTemplateRequestContent $request, ?array $options = null): ?CreateVerifiableCredentialTemplateResponseContent;

    /**
     * Get a verifiable credential template.
     *
     * @param string $id ID of the template to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetVerifiableCredentialTemplateResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetVerifiableCredentialTemplateResponseContent;

    /**
     * Delete a verifiable credential template.
     *
     * @param string $id ID of the template to retrieve.
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
     * Update a verifiable credential template.
     *
     * @param string $id ID of the template to retrieve.
     * @param UpdateVerifiableCredentialTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateVerifiableCredentialTemplateResponseContent
     */
    public function update(string $id, UpdateVerifiableCredentialTemplateRequestContent $request = new UpdateVerifiableCredentialTemplateRequestContent(), ?array $options = null): ?UpdateVerifiableCredentialTemplateResponseContent;
}
