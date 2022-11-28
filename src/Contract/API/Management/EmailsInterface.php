<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface EmailsInterface.
 */
interface EmailsInterface
{
    /**
     * Create the email provider.
     * Required scope: `create:email_provider`.
     *
     * @param  string  $name  name of the email provider to use
     * @param  array<string>  $credentials  Credentials required to use the provider. See @see for supported options.
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` or `credentials` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Emails/post_provider
     */
    public function createProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve email provider details.
     * Required scope: `read:email_provider`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Emails/get_provider
     */
    public function getProvider(
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update the email provider.
     * Required scope: `update:email_provider`.
     *
     * @param  string  $name  name of the email provider to use
     * @param  array<string>  $credentials  Credentials required to use the provider. See @see for supported options.
     * @param  array<mixed>|null  $body  Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `name` or `credentials` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Emails/patch_provider
     */
    public function updateProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Delete the email provider.
     * Required scope: `delete:email_provider`.
     *
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Emails/delete_provider
     */
    public function deleteProvider(
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
