<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

interface KeysInterface
{
    /**
     * Delete the custom provided encryption key with the given ID and move back to using native encryption key.
     * Required scope: `delete:encryption_keys`.
     *
     * @param string              $kId     key (by it's ID) to query
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `grantId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/delete-encryption-key
     */
    public function deleteEncryptionKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve details of the encryption key with the given ID..
     * Required scopes: `read:encryption_key`.
     *
     * @param string              $kId     key (by it's ID) to query
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `kId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/get-encryption-key
     */
    public function getEncryptionKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve details of all the encryption keys associated with your tenant.
     * Required scope: `read:encryption_keys`.
     *
     * @param null|int[]|null[]|string[] $parameters Optional. Additional query parameters to pass with the API request. See @see for supported options.
     * @param null|RequestOptions        $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/get-encryption-keys
     */
    public function getEncryptionKeys(
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Create the new, pre-activated encryption key, without the key material.
     * Required scope: `create:encryption_keys`.
     *
     * @param array<mixed>        $body    Additional body content to pass with the API request. See @see for supported options.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/post-encryption
     */
    public function postEncryption(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Import wrapped key material and activate encryption key.
     * Required scope: `create:encryption_keys`.
     *
     * @param string              $kId     key (by it's ID) to query
     * @param array<mixed>        $body    Additional body content to pass with the API request. See @see for supported options.
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/post-encryption-key
     */
    public function postEncryptionKey(
        string $kId,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

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

    /**
     * Create the public wrapping key to wrap your own encryption key material.
     * Required scope: `create:encryption_keys`.
     *
     * @param string              $kId     key (by it's ID) to query
     * @param null|RequestOptions $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException  when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/keys/post-encryption-wrapping-key
     */
    public function postEncryptionWrappingKey(
        string $kId,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
