<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class DeviceCredentials.
 * Handles requests to the Device Credentials endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials
 */
final class DeviceCredentials extends ManagementEndpoint
{
    /**
     * Create a device public key credential.
     *
     * @param string              $deviceName Name for this device easily recognized by owner.
     * @param string              $type       Type of credential. Must be public_key.
     * @param string              $value      Base64 encoded string containing the credential.
     * @param string              $deviceId   Unique identifier for the device. Recommend using Android_ID on Android and identifierForVendor.
     * @param array<mixed>|null   $body       Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `deviceName`, `type`, `value`, or `deviceId` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/post_device_credentials
     */
    public function create(
        string $deviceName,
        string $type,
        string $value,
        string $deviceId,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$deviceName, $type, $value, $deviceId] = Toolkit::filter([$deviceName, $type, $value, $deviceId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$deviceName, \Auth0\SDK\Exception\ArgumentException::missing('deviceName')],
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
            [$value, \Auth0\SDK\Exception\ArgumentException::missing('value')],
            [$deviceId, \Auth0\SDK\Exception\ArgumentException::missing('deviceId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('device-credentials')
            ->withBody(
                (object) Toolkit::merge([
                    'device_name' => $deviceName,
                    'type' => $type,
                    'value' => $value,
                    'device_id' => $deviceId,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve device credential details for a given user_id.
     * Required scope: `read:device_credentials`
     *
     * @param string              $userId   User ID of the devices to retrieve.
     * @param string|null         $clientId Optional. Client ID of the devices to retrieve.
     * @param string|null         $type     Optional. Type of credentials to retrieve. Must be `public_key`, `refresh_token` or `rotating_refresh_token`. The property will default to `refresh_token` when paging is requested
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `userId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/get_device_credentials
     */
    public function get(
        string $userId,
        ?string $clientId = null,
        ?string $type = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$userId, $clientId, $type] = Toolkit::filter([$userId, $clientId, $type])->string()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('device-credentials')
            ->withParams(Toolkit::filter([
                [
                    'user_id' => $userId,
                    'client_id' => $clientId,
                    'type' => $type,
                ],
            ])->array()->trim()[0])
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete a device credential
     * Required scope: `delete:device_credentials`
     *
     * @param string              $id      ID of the device credential to delete.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/delete_device_credentials_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')
            ->addPath('device-credentials', $id)
            ->withOptions($options)
            ->call();
    }
}
