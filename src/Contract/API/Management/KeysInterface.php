<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface KeysInterface
{
    /**
     * Perform rekeying operation on the key hierarchy.
     * Required scope: `create:encryption_keys`, `update:encryption_keys`.
     *
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/post-encryption-rekey
     */
    public function postEncryptionRekey(
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
