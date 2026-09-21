<?php

namespace Auth0\SDK\API\Management\Organizations\OrganizationTemplate;

use Auth0\SDK\API\Management\Types\OrganizationTemplate;

interface OrganizationTemplateClientInterface
{
    /**
     * Retrieve the organization template assigned to a specific organization. Returns the template object if one is explicitly assigned, or a 404 if no template is assigned.
     *
     * Example:
     * ```php
     * $client->organizations->organizationTemplate->get(
     *     'id',
     * );
     * ```
     *
     * @param string $id ID of the organization.
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
     * Assign an Organization Template to an organization.
     *
     * Example:
     * ```php
     * $client->organizations->organizationTemplate->assignOrganizationTemplate(
     *     'id',
     *     'template_id',
     * );
     * ```
     *
     * @param string $id The ID of the organization.
     * @param string $templateId The ID of the organization template to assign.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function assignOrganizationTemplate(string $id, string $templateId, ?array $options = null): void;

    /**
     * Remove an Organization Template assignment from an organization.
     *
     * Example:
     * ```php
     * $client->organizations->organizationTemplate->unassignOrganizationTemplate(
     *     'id',
     *     'template_id',
     * );
     * ```
     *
     * @param string $id The ID of the organization.
     * @param string $templateId The ID of the organization template to unassign.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function unassignOrganizationTemplate(string $id, string $templateId, ?array $options = null): void;
}
