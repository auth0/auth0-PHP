<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Blacklists.
 * Handles requests to the Blacklists endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Blacklists
 */
class Blacklists extends GenericResource
{
    /**
     * Blacklist a token.
     * Required scope: `blacklist:tokens`
     *
     * @param string              $jti     jti (unique ID within aud) of the blacklisted JWT.
     * @param string|null         $aud     Optional. JWT's aud claim (the client_id to which the JWT was issued).
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/post_tokens
     */
    public function create(
        string $jti,
        ?string $aud = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($jti, 'jti');

        $request = [ 'jti' => $jti ];

        if ($aud !== null) {
            $this->validateString($aud, 'aud');
            $request['aud'] = $aud;
        }

        return $this->apiClient->method('post')
            ->addPath('blacklists', 'tokens')
            ->withBody((object) $request)
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
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Blacklists/get_tokens
     */
    public function get(
        ?string $aud = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($aud, 'aud');

        $client = $this->apiClient->method('get')
            ->addPath('blacklists', 'tokens');

        if ($aud !== null) {
            $client->withParam('aud', $aud);
        }

        return $client->withOptions($options)->call();
    }
}
