<?php

namespace Auth0\SDK\API\Management\DeviceCredentials;

use Auth0\SDK\API\Management\DeviceCredentials\Requests\ListDeviceCredentialsRequestParameters;
use Auth0\SDK\API\Management\Core\Pagination\Pager;
use Auth0\SDK\API\Management\Types\DeviceCredential;
use Auth0\SDK\API\Management\DeviceCredentials\Requests\CreatePublicKeyDeviceCredentialRequestContent;
use Auth0\SDK\API\Management\Types\CreatePublicKeyDeviceCredentialResponseContent;

interface DeviceCredentialsClientInterface
{
    /**
     * Retrieve device credential information (`public_key`, `refresh_token`, or `rotating_refresh_token`) associated with a specific user.
     *
     * @param ListDeviceCredentialsRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return Pager<DeviceCredential>
     */
    public function list(ListDeviceCredentialsRequestParameters $request = new ListDeviceCredentialsRequestParameters(), ?array $options = null): Pager;

    /**
     * Create a device credential public key to manage refresh token rotation for a given `user_id`. Device Credentials APIs are designed for ad-hoc administrative use only and paging is by default enabled for GET requests.
     *
     * When refresh token rotation is enabled, the endpoint becomes consistent. For more information, read [Signing Keys](https://auth0.com/docs/get-started/tenant-settings/signing-keys).
     *
     * @param CreatePublicKeyDeviceCredentialRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreatePublicKeyDeviceCredentialResponseContent
     */
    public function createPublicKey(CreatePublicKeyDeviceCredentialRequestContent $request, ?array $options = null): ?CreatePublicKeyDeviceCredentialResponseContent;

    /**
     * Permanently delete a device credential (such as a refresh token or public key) with the given ID.
     *
     * @param string $id ID of the credential to delete.
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
}
