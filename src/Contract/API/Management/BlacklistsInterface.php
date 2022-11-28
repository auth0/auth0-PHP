<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface BlacklistsInterface.
 */
interface BlacklistsInterface
{
    /**
     * Blacklist a token.
     * Required scope: `blacklist:tokens`.
     *
     * @param  string  $jti  jti (unique ID within aud) of the blacklisted JWT
     * @param  string|null  $aud  Optional. JWT's aud claim (the client_id to which the JWT was issued).
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `jti` or `aud` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens
     */
    public function create(
        string $jti,
        ?string $aud = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve the `jti` and `aud` of all tokens that are blacklisted.
     * Required scope: `blacklist:tokens`.
     *
     * @param  string|null  $aud  Optional. Filter on the JWT's aud claim (the client_id to which the JWT was issued).
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens
     */
    public function get(
        ?string $aud = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
