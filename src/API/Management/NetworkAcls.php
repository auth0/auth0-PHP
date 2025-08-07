<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\NetworkAclsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Handles requests to the Network Acls endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Network_Acls
 */
final class NetworkAcls extends ManagementEndpoint implements NetworkAclsInterface
{
    public function create(
        string $description,
        bool $active,
        int $priority,
        array $rule,
        ?array $additional = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$description] = Toolkit::filter([$description])->string()->trim();
        [$rule, $additional] = Toolkit::filter([$rule, $additional])->array()->trim();

        Toolkit::assert([
            [$description, \Auth0\SDK\Exception\ArgumentException::missing('description')],
        ])->isString();

        Toolkit::assert([
            [$active, \Auth0\SDK\Exception\ArgumentException::missing('active')],
        ])->isBoolean();

        Toolkit::assert([
            [$priority, \Auth0\SDK\Exception\ArgumentException::missing('priority')],
        ])->isInteger();

        Toolkit::assert([
            [$rule, \Auth0\SDK\Exception\ArgumentException::missing('rule')],
        ])->isArray();

        /** @var array<mixed> $additional */

        return $this->getHttpClient()
            ->method('post')->addPath(['network-acls'])
            ->withBody(
                (object) Toolkit::merge([[
                    'description' => $description,
                    'active' => $active,
                    'priority' => $priority,
                    'rule' => (object) $rule,
                ], $additional]),
            )
            ->withOptions($options)
            ->call();
    }

    public function delete(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('delete')->addPath(['network-acls', $id])
            ->withOptions($options)
            ->call();
    }

    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')->addPath(['network-acls', $id])
            ->withOptions($options)
            ->call();
    }

    public function getAll(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath(['network-acls'])
            ->withOptions($options)
            ->call();
    }

    public function patch(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')->addPath(['network-acls', $id])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    public function update(
        string $id,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('put')->addPath(['network-acls', $id])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
