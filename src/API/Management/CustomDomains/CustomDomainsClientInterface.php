<?php

namespace Auth0\SDK\API\Management\CustomDomains;

use Auth0\SDK\API\Management\CustomDomains\Requests\ListCustomDomainsRequestParameters;
use Auth0\SDK\API\Management\Types\CustomDomain;
use Auth0\SDK\API\Management\CustomDomains\Requests\CreateCustomDomainRequestContent;
use Auth0\SDK\API\Management\Types\CreateCustomDomainResponseContent;
use Auth0\SDK\API\Management\Types\GetDefaultCustomDomainResponseContent;
use Auth0\SDK\API\Management\Types\GetDefaultCanonicalDomainResponseContent;
use Auth0\SDK\API\Management\CustomDomains\Requests\SetDefaultCustomDomainRequestContent;
use Auth0\SDK\API\Management\Types\UpdateDefaultCustomDomainResponseContent;
use Auth0\SDK\API\Management\Types\UpdateDefaultCanonicalDomainResponseContent;
use Auth0\SDK\API\Management\Types\GetCustomDomainResponseContent;
use Auth0\SDK\API\Management\CustomDomains\Requests\UpdateCustomDomainRequestContent;
use Auth0\SDK\API\Management\Types\UpdateCustomDomainResponseContent;
use Auth0\SDK\API\Management\Types\TestCustomDomainResponseContent;
use Auth0\SDK\API\Management\Types\VerifyCustomDomainResponseContent;

interface CustomDomainsClientInterface
{
    /**
     * Retrieve details on [custom domains](https://auth0.com/docs/custom-domains).
     *
     * @param ListCustomDomainsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<CustomDomain>
     */
    public function list(ListCustomDomainsRequestParameters $request = new ListCustomDomainsRequestParameters(), ?array $options = null): ?array;

    /**
     * Create a new custom domain.
     *
     * Note: The custom domain will need to be verified before it will accept
     * requests.
     *
     * Optional attributes that can be updated:
     *
     * - custom_client_ip_header
     * - tls_policy
     *
     * TLS Policies:
     *
     * - recommended - for modern usage this includes TLS 1.2 only
     *
     * @param CreateCustomDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateCustomDomainResponseContent
     */
    public function create(CreateCustomDomainRequestContent $request, ?array $options = null): ?CreateCustomDomainResponseContent;

    /**
     * Retrieve the tenant's default domain.
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    GetDefaultCustomDomainResponseContent
     *   |GetDefaultCanonicalDomainResponseContent
     * )|null
     */
    public function getDefault(?array $options = null): GetDefaultCustomDomainResponseContent|GetDefaultCanonicalDomainResponseContent|null;

    /**
     * Set the default custom domain for the tenant.
     *
     * @param SetDefaultCustomDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return (
     *    UpdateDefaultCustomDomainResponseContent
     *   |UpdateDefaultCanonicalDomainResponseContent
     * )|null
     */
    public function setDefault(SetDefaultCustomDomainRequestContent $request, ?array $options = null): UpdateDefaultCustomDomainResponseContent|UpdateDefaultCanonicalDomainResponseContent|null;

    /**
     * Retrieve a custom domain configuration and status.
     *
     * @param string $id ID of the custom domain to retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetCustomDomainResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetCustomDomainResponseContent;

    /**
     * Delete a custom domain and stop serving requests for it.
     *
     * @param string $id ID of the custom domain to delete.
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
     * Update a custom domain.
     *
     * These are the attributes that can be updated:
     *
     * - custom_client_ip_header
     * - tls_policy
     *
     * **Updating CUSTOM_CLIENT_IP_HEADER for a custom domain**
     *
     * To update the `custom_client_ip_header` for a domain, the body to
     * send should be:
     *
     * ```json
     * { "custom_client_ip_header": "cf-connecting-ip" }
     * ```
     *
     * **Updating TLS_POLICY for a custom domain**
     *
     * To update the `tls_policy` for a domain, the body to send should be:
     *
     * ```json
     * { "tls_policy": "recommended" }
     * ```
     *
     * TLS Policies:
     *
     * - recommended - for modern usage this includes TLS 1.2 only
     *
     * Some considerations:
     *
     * - The TLS ciphers and protocols available in each TLS policy follow industry recommendations, and may be updated occasionally.
     * - The `compatible` TLS policy is no longer supported.
     *
     * @param string $id The id of the custom domain to update
     * @param UpdateCustomDomainRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateCustomDomainResponseContent
     */
    public function update(string $id, UpdateCustomDomainRequestContent $request = new UpdateCustomDomainRequestContent(), ?array $options = null): ?UpdateCustomDomainResponseContent;

    /**
     * Run the test process on a custom domain.
     *
     * @param string $id ID of the custom domain to test.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?TestCustomDomainResponseContent
     */
    public function test(string $id, ?array $options = null): ?TestCustomDomainResponseContent;

    /**
     * Run the verification process on a custom domain.
     *
     * Note: Check the `status` field to see its verification status. Once verification is complete, it may take up to 10 minutes before the custom domain can start accepting requests.
     *
     * For `self_managed_certs`, when the custom domain is verified for the first time, the response will also include the `cname_api_key` which you will need to configure your proxy. This key must be kept secret, and is used to validate the proxy requests.
     *
     * [Learn more](https://auth0.com/docs/custom-domains#step-2-verify-ownership) about verifying custom domains that use Auth0 Managed certificates.
     * [Learn more](https://auth0.com/docs/custom-domains/self-managed-certificates#step-2-verify-ownership) about verifying custom domains that use Self Managed certificates.
     *
     * @param string $id ID of the custom domain to verify.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?VerifyCustomDomainResponseContent
     */
    public function verify(string $id, ?array $options = null): ?VerifyCustomDomainResponseContent;
}
