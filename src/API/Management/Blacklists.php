<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Blacklists.
 * Handles requests to the Blacklists endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Blacklists
 */
final class Blacklists extends ManagementEndpoint
{
    /**
     * Blacklist a token.
     * Required scope: `blacklist:tokens`
     *
     * @param string              $jti     jti (unique ID within aud) of the blacklisted JWT.
     * @param string|null         $aud     Optional. JWT's aud claim (the client_id to which the JWT was issued).
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `jti` or `aud` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens
     */
    public function create(
        string $jti,
        ?string $aud = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$jti, $aud] = Toolkit::filter([$jti, $aud])->string()->trim();

        Toolkit::assert([
            [$jti, \Auth0\SDK\Exception\ArgumentException::missing('jti')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('blacklists', 'tokens')
            ->withBody(
                (object) Toolkit::filter([
                    [
                        'jti' => $jti,
                        'aud' => $aud,
                    ],
                ])->array()->trim()[0]
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve the `jti` and `aud` of all tokens that are blacklisted.
     * Required scope: `blacklist:tokens`
     *
     * @param string|null         $aud     Optional. Filter on the JWT's aud claim (the client_id to which the JWT was issued).
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens
     */
    public function get(
        ?string $aud = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$aud] = Toolkit::filter([$aud])->string()->trim();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('blacklists', 'tokens')
            ->withParam('aud', $aud)
            ->withOptions($options)
            ->call();
    }
}
