<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class DeviceCredentials.
 * Handles requests to the Device Credentials endpoint of the v2 Management API.
 *
 * https://auth0.com/docs/api/management/v2#!/Device_Credentials
 *
 * @package Auth0\SDK\API\Management
 */
class DeviceCredentials extends GenericResource
{
    /**
     * Retrieve device credential details for a given user_id.
     * Required scope: `read:device_credentials`
     *
     * @param string              $userId   User ID of the devices to retrieve.
     * @param string|null         $clientId Optional. Client ID of the devices to retrieve.
     * @param string|null         $type     Optional. Type of credentials to retrieve. Must be `public_key`, `refresh_token` or `rotating_refresh_token`. The property will default to `refresh_token` when paging is requested
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/get_device_credentials
     */
    public function get(
        string $userId,
        ?string $clientId = null,
        ?string $type = null,
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'user_id'     => $userId,
            'client_id' => $clientId,
        ];

        if (null !== $type) {
            $payload['type'] = $type;
        }

        return $this->apiClient->method('post')
            ->addPath('device-credentials')
            ->withParams($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a device public key credential.
     *
     * @param array               $query   Query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/post_device_credentials
     */
    public function create(
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('device-credentials')
            ->withBody($query)
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
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Device_Credentials/delete_device_credentials_by_id
     */
    public function delete(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('device-credentials', $id)
            ->withOptions($options)
            ->call();
    }
}
