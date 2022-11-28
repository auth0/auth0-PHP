<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\UserBlocksInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class UserBlocks.
 * Handles requests to the User Blocks endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/User_Blocks
 */
final class UserBlocks extends ManagementEndpoint implements UserBlocksInterface
{
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('user-blocks', $id)->
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
            addPath('user-blocks', $id)->
            withOptions($options)->
            call();
    }

    public function getByIdentifier(
        string $identifier,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        return $this->getHttpClient()->
            method('get')->
            addPath('user-blocks')->
            withParam('identifier', $identifier)->
            withOptions($options)->
            call();
    }

    public function deleteByIdentifier(
        string $identifier,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$identifier] = Toolkit::filter([$identifier])->string()->trim();

        Toolkit::assert([
            [$identifier, \Auth0\SDK\Exception\ArgumentException::missing('identifier')],
        ])->isString();

        return $this->getHttpClient()->
            method('delete')->
            addPath('user-blocks')->
            withParam('identifier', $identifier)->
            withOptions($options)->
            call();
    }
}
