<?php

namespace Auth0\SDK\API\Management\Organizations\DiscoveryDomains;

use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\ListOrganizationDiscoveryDomainsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\OrganizationDiscoveryDomain;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\CreateOrganizationDiscoveryDomainRequestContent;
use Auth0\SDK\API\Management\Types\CreateOrganizationDiscoveryDomainResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationDiscoveryDomainByNameResponseContent;
use Auth0\SDK\API\Management\Types\GetOrganizationDiscoveryDomainResponseContent;
use Auth0\SDK\API\Management\Organizations\DiscoveryDomains\Requests\UpdateOrganizationDiscoveryDomainRequestContent;
use Auth0\SDK\API\Management\Types\UpdateOrganizationDiscoveryDomainResponseContent;

interface DiscoveryDomainsClientInterface
{
    /**
     * Retrieve list of all organization discovery domains associated with the specified organization.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param ListOrganizationDiscoveryDomainsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<OrganizationDiscoveryDomain>
     */
    public function list(string $id, ListOrganizationDiscoveryDomainsRequestParameters $request = new ListOrganizationDiscoveryDomainsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a new discovery domain for an organization.
     *
     * @param string $id ID of the organization.
     * @param CreateOrganizationDiscoveryDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateOrganizationDiscoveryDomainResponseContent
     */
    public function create(string $id, CreateOrganizationDiscoveryDomainRequestContent $request, ?array $options = null): ?CreateOrganizationDiscoveryDomainResponseContent;

    /**
     * Retrieve details about a single organization discovery domain specified by domain name.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomain Domain name of the discovery domain.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationDiscoveryDomainByNameResponseContent
     */
    public function getByName(string $id, string $discoveryDomain, ?array $options = null): ?GetOrganizationDiscoveryDomainByNameResponseContent;

    /**
     * Retrieve details about a single organization discovery domain specified by ID.
     * This endpoint is subject to eventual consistency; newly created, updated, or deleted discovery domains may not immediately appear in the response.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetOrganizationDiscoveryDomainResponseContent
     */
    public function get(string $id, string $discoveryDomainId, ?array $options = null): ?GetOrganizationDiscoveryDomainResponseContent;

    /**
     * Remove a discovery domain from an organization. This action cannot be undone.
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, string $discoveryDomainId, ?array $options = null): void;

    /**
     * Update the verification status and/or use_for_organization_discovery for an organization discovery domain. The <code>status</code> field must be either <code>pending</code> or <code>verified</code>. The <code>use_for_organization_discovery</code> field can be <code>true</code> or <code>false</code> (default: <code>true</code>).
     *
     * @param string $id ID of the organization.
     * @param string $discoveryDomainId ID of the discovery domain to update.
     * @param UpdateOrganizationDiscoveryDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateOrganizationDiscoveryDomainResponseContent
     */
    public function update(string $id, string $discoveryDomainId, UpdateOrganizationDiscoveryDomainRequestContent $request = new UpdateOrganizationDiscoveryDomainRequestContent(), ?array $options = null): ?UpdateOrganizationDiscoveryDomainResponseContent;
}
