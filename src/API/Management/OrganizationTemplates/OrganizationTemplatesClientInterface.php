<?php

namespace Auth0\SDK\API\Management\OrganizationTemplates;

use Auth0\SDK\API\Management\OrganizationTemplates\Requests\ListOrganizationTemplatesRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationTemplate;
use Auth0\SDK\API\Management\OrganizationTemplates\Requests\CreateOrganizationTemplateRequestContent;
use Auth0\SDK\API\Management\OrganizationTemplates\Requests\UpdateOrganizationTemplateRequestContent;
use Auth0\SDK\API\Management\OrganizationTemplates\Requests\ListTemplateOrganizationsRequestParameters;
use Auth0\SDK\API\Management\Types\OrganizationTemplateAssignedOrganization;

interface OrganizationTemplatesClientInterface
{
    /**
     * Retrieve a list of Organization Templates. This endpoint supports Checkpoint pagination. Results are returned in a stable order, sorted by their identifier (`id`) in ascending order.
     *
     * Example:
     * ```php
     * $client->organizationTemplates->list(
     *     new ListOrganizationTemplatesRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param ListOrganizationTemplatesRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationTemplate>
     */
    public function list(ListOrganizationTemplatesRequestParameters $request = new ListOrganizationTemplatesRequestParameters(), ?array $options = null): Pager;

    /**
     * Create an Organization Template.
     *
     * Example:
     * ```php
     * $client->organizationTemplates->create(
     *     new CreateOrganizationTemplateRequestContent([
     *         'name' => 'name',
     *         'organizationDeletionBehavior' => OrganizationDeletionBehaviorEnum::Allow->value,
     *         'enforcePermissionCeiling' => true,
     *         'enforceSelfAssignmentRestriction' => true,
     *     ]),
     * );
     * ```
     *
     * @param CreateOrganizationTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationTemplate
     */
    public function create(CreateOrganizationTemplateRequestContent $request, ?array $options = null): ?OrganizationTemplate;

    /**
     * Retrieve details about a single Organization Template specified by ID.
     *
     * Example:
     * ```php
     * $client->organizationTemplates->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id Organization Template identifier.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationTemplate
     */
    public function get(string $id, ?array $options = null): ?OrganizationTemplate;

    /**
     * Update the details of a specific Organization Template.
     *
     * Example:
     * ```php
     * $client->organizationTemplates->update(
     *     'id',
     *     new UpdateOrganizationTemplateRequestContent([]),
     * );
     * ```
     *
     * @param string $id Organization Template identifier.
     * @param UpdateOrganizationTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?OrganizationTemplate
     */
    public function update(string $id, UpdateOrganizationTemplateRequestContent $request = new UpdateOrganizationTemplateRequestContent(), ?array $options = null): ?OrganizationTemplate;

    /**
     * Retrieve a list of organizations assigned to an Organization Template. This endpoint supports Checkpoint pagination. Results are returned in a stable order, sorted by their identifier (`id`) in ascending order.
     *
     * Example:
     * ```php
     * $client->organizationTemplates->listOrganizations(
     *     'id',
     *     new ListTemplateOrganizationsRequestParameters([
     *         'from' => 'from',
     *         'take' => 1,
     *     ]),
     * );
     * ```
     *
     * @param string $id The ID of the organization template.
     * @param ListTemplateOrganizationsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationTemplateAssignedOrganization>
     */
    public function listOrganizations(string $id, ListTemplateOrganizationsRequestParameters $request = new ListTemplateOrganizationsRequestParameters(), ?array $options = null): Pager;
}
