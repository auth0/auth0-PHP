<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface DeviceCredentialsInterface.
 */
interface DeviceCredentialsInterface
{
    /**
     * Create a device public key credential.
     *
     * @param  string  $deviceName  name for this device easily recognized by owner
     * @param  string  $type  Type of credential. Must be public_key.
     * @param  string  $value  base64 encoded string containing the credential
     * @param  string  $deviceId  Unique identifier for the device. Recommend using Android_ID on Android and identifierForVendor.
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `deviceName`, `type`, `value`, or `deviceId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Device_Credentials/post_device_credentials
     */
    public function create(
        string $deviceName,
        string $type,
        string $value,
        string $deviceId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve device credential details for a given user_id.
     * Required scope: `read:device_credentials`.
     *
     * @param  string  $userId  user ID of the devices to retrieve
     * @param  string|null  $clientId  Optional. Client ID of the devices to retrieve.
     * @param  string|null  $type  Optional. Type of credentials to retrieve. Must be `public_key`, `refresh_token` or `rotating_refresh_token`. The property will default to `refresh_token` when paging is requested
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `userId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Device_Credentials/get_device_credentials
     */
    public function get(
        string $userId,
        ?string $clientId = null,
        ?string $type = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete a device credential
     * Required scope: `delete:device_credentials`.
     *
     * @param  string  $id  ID of the device credential to delete
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Device_Credentials/delete_device_credentials_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
