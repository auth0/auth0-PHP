<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\GuardianInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Guardian.
 * Handles requests to the Guardian endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Guardian
 */
final class Guardian extends ManagementEndpoint implements GuardianInterface
{
    public function getFactors(
        ?RequestOptions $options = null,
    ): ResponseInterface {
        return $this->getHttpClient()->
            method('get')->
            addPath('guardian', 'factors')->
            withOptions($options)->
            call();
    }

    public function getEnrollment(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('guardian', 'enrollments', $id)->
            withOptions($options)->
            call();
    }

    public function deleteEnrollment(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('guardian', 'enrollments', $id)->
            withOptions($options)->
            call();
    }
}
