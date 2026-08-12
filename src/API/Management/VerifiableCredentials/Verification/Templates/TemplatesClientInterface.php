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
     * List verifiable credential templates.
     *
     * Example:
     * ```php
     * $client->verifiableCredentials->verification->templates->list(
     *     new ListVerifiableCredentialTemplatesRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
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
     * Example:
     * ```php
     * $client->verifiableCredentials->verification->templates->create(
     *     new CreateVerifiableCredentialTemplateRequestContent([
     *         'name' => 'name',
     *         'type' => 'type',
     *         'dialect' => 'dialect',
     *         'presentation' => new MdlPresentationRequest([
     *             'orgIso1801351MDl' => new MdlPresentationRequestProperties([
     *                 'orgIso1801351' => new MdlPresentationProperties([]),
     *             ]),
     *         ]),
     *         'wellKnownTrustedIssuers' => 'well_known_trusted_issuers',
     *     ]),
     * );
     * ```
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
     * Example:
     * ```php
     * $client->verifiableCredentials->verification->templates->get(
     *     'id',
     * );
     * ```
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
     * Example:
     * ```php
     * $client->verifiableCredentials->verification->templates->delete(
     *     'id',
     * );
     * ```
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
     * Example:
     * ```php
     * $client->verifiableCredentials->verification->templates->update(
     *     'id',
     *     new UpdateVerifiableCredentialTemplateRequestContent([]),
     * );
     * ```
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
