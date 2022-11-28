<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface JobsInterface.
 */
interface JobsInterface
{
    /**
     * Import users from a formatted file into a connection via a long-running job.
     * Required scopes:
     * - `create:users`
     * - `read:users`.
     *
     * @param  string  $filePath  path to formatted file to import
     * @param  string  $connectionId  id of the Connection to use
     * @param  array<string,bool|int|string>|null  $parameters  Optional.Additional query parameters to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `filePath` or `connectionId` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports
     */
    public function createImportUsers(
        string $filePath,
        string $connectionId,
        ?array $parameters = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Export all users to a file via a long-running job.
     * Required scope: `read:users`.
     *
     * @param  array<mixed>  $body  Body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports
     */
    public function createExportUsers(
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Create a verification email job.
     * Required scope: `update:users`.
     *
     * @param  string  $userId  user ID of the user to send the verification email to
     * @param  array<mixed>|null  $body  Optional. Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `userId` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email
     */
    public function createSendVerificationEmail(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieves a job. Useful to check its status.
     * Required scopes:
     * - `create:users`
     * - `read:users`.
     *
     * @param  string  $id  job (by it's ID) to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Retrieve error details of a failed job.
     * Required scopes:
     * - `create:users`
     * - `read:users`.
     *
     * @param  string  $id  job (by it's ID) to query
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `id` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_errors
     */
    public function getErrors(
        string $id,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
