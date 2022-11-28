<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\DeviceCredentialsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class DeviceCredentials.
 * Handles requests to the Device Credentials endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Device_Credentials
 */
final class DeviceCredentials extends ManagementEndpoint implements DeviceCredentialsInterface
{
    public function create(
        string $deviceName,
        string $type,
        string $value,
        string $deviceId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$deviceName, $type, $value, $deviceId] = Toolkit::filter([$deviceName, $type, $value, $deviceId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$deviceName, \Auth0\SDK\Exception\ArgumentException::missing('deviceName')],
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
            [$value, \Auth0\SDK\Exception\ArgumentException::missing('value')],
            [$deviceId, \Auth0\SDK\Exception\ArgumentException::missing('deviceId')],
        ])->isString();

        /* @var array<mixed> $body */

        return $this->getHttpClient()->
            method('post')->
            addPath('device-credentials')->
            withBody(
                (object) Toolkit::merge([
                    'device_name' => $deviceName,
                    'type'        => $type,
                    'value'       => $value,
                    'device_id'   => $deviceId,
                ], $body),
            )->
            withOptions($options)->
            call();
    }

    public function get(
        string $userId,
        ?string $clientId = null,
        ?string $type = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$userId, $clientId, $type] = Toolkit::filter([$userId, $clientId, $type])->string()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
            [$clientId, \Auth0\SDK\Exception\ArgumentException::missing('clientId')],
            [$type, \Auth0\SDK\Exception\ArgumentException::missing('type')],
        ])->isString();

        $params = Toolkit::filter([
            [
                'user_id'   => $userId,
                'client_id' => $clientId,
                'type'      => $type,
            ],
        ])->array()->trim()[0];

        /* @var array<int|string|null> $params */

        return $this->getHttpClient()->
            method('get')->
            addPath('device-credentials')->
            withParams($params)->
            withOptions($options)->
            call();
    }

    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('device-credentials', $id)->
            withOptions($options)->
            call();
    }
}
