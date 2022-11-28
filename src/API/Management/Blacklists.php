<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Contract\API\Management\BlacklistsInterface;
use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Blacklists.
 * Handles requests to the Blacklists endpoint of the v2 Management API.
 *
 * @see https://auth0.com/docs/api/management/v2#!/Blacklists
 */
final class Blacklists extends ManagementEndpoint implements BlacklistsInterface
{
    public function create(
        string $jti,
        ?string $aud = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$jti, $aud] = Toolkit::filter([$jti, $aud])->string()->trim();

        Toolkit::assert([
            [$jti, \Auth0\SDK\Exception\ArgumentException::missing('jti')],
        ])->isString();

        return $this->getHttpClient()->
            method('post')->
            addPath('blacklists', 'tokens')->
            withBody(
                (object) Toolkit::filter([
                    [
                        'jti' => $jti,
                        'aud' => $aud,
                    ],
                ])->array()->trim()[0],
            )->
            withOptions($options)->
            call();
    }

    public function get(
        ?string $aud = null,
        ?RequestOptions $options = null,
    ): ResponseInterface {
        [$aud] = Toolkit::filter([$aud])->string()->trim();

        return $this->getHttpClient()->
            method('get')->
            addPath('blacklists', 'tokens')->
            withParam('aud', $aud)->
            withOptions($options)->
            call();
    }
}
