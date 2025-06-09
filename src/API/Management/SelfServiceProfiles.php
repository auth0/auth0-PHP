<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\SelfServiceProfilesInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Handles requests to the Self Service Profiles endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2/self-service-profiles
 */
final class SelfServiceProfiles extends ManagementEndpoint implements SelfServiceProfilesInterface
{
    public function create(
        string $name,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        /** @var array<mixed> $body */

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['self-service-profiles'])
            ->withBody(
                (object) Toolkit::merge([[
                    'name' => $name,
                ], $body]),
            )
            ->withOptions($options)
            ->call();
    }

    public function createSsoTicket(
        string $id,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        /** @var array<mixed> $body */

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['self-service-profiles', $id, 'sso-ticket'])
            ->withBody((object) $body)
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
            ->method('delete')
            ->addPath(['self-service-profiles', $id])
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
            ->method('get')
            ->addPath(['self-service-profiles', $id])
            ->withOptions($options)
            ->call();
    }

    public function getAll(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        /** @var array<null|int|string> $parameters */

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['self-service-profiles'])
            ->withParams($parameters)
            ->withOptions($options)
            ->call();
    }

    public function getCustomTextForProfile(
        string $id,
        string $language,
        string $page,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$language] = Toolkit::filter([$language])->string()->trim();
        [$page] = Toolkit::filter([$page])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$language, \Auth0\SDK\Exception\ArgumentException::missing('language')],
            [$page, \Auth0\SDK\Exception\ArgumentException::missing('page')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath(['self-service-profiles', $id, 'custom-text', $language, $page])
            ->withOptions($options)
            ->call();
    }

    public function revokeSsoTicket(
        string $profileId,
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$profileId, $id] = Toolkit::filter([$profileId, $id])->string()->trim();

        Toolkit::assert([
            [$profileId, \Auth0\SDK\Exception\ArgumentException::missing('profileId')],
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath(['self-service-profiles', $profileId, 'sso-ticket', $id, 'revoke'])
            ->withOptions($options)
            ->call();
    }

    public function setCustomTextForProfile(
        string $id,
        string $language,
        string $page,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();
        [$language] = Toolkit::filter([$language])->string()->trim();
        [$page] = Toolkit::filter([$page])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
            [$language, \Auth0\SDK\Exception\ArgumentException::missing('language')],
            [$page, \Auth0\SDK\Exception\ArgumentException::missing('page')],
        ])->isString();

        return $this->getHttpClient()
            ->method('PUT')
            ->addPath(['self-service-profiles', $id, 'custom-text', $language, $page])
            ->withOptions($options)
            ->withBody($body ?? [])
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
            ->method('patch')
            ->addPath(['self-service-profiles', $id])
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
