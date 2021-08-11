<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Jobs.
 * Handles requests to the Jobs endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Jobs
 */
final class Jobs extends ManagementEndpoint
{
    /**
     * Import users from a formatted file into a connection via a long-running job.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string                             $filePath     Path to formatted file to import.
     * @param string                             $connectionId Id of the Connection to use.
     * @param array<string,bool|int|string>|null $parameters   Optional.Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null                $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `filePath` or `connectionId` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports
     */
    public function createImportUsers(
        string $filePath,
        string $connectionId,
        ?array $parameters = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$filePath, $connectionId] = Toolkit::filter([$filePath, $connectionId])->string()->trim();
        [$parameters] = Toolkit::filter([$parameters])->array()->trim();

        Toolkit::assert([
            [$filePath, \Auth0\SDK\Exception\ArgumentException::missing('filePath')],
            [$connectionId, \Auth0\SDK\Exception\ArgumentException::missing('connectionId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('jobs', 'users-imports')
            ->addFile('users', $filePath)
            ->withFormParam('connection_id', $connectionId)
            ->withFormParams($parameters)
            ->withOptions($options)
            ->call();
    }

    /**
     * Export all users to a file via a long-running job.
     * Required scope: `read:users`
     *
     * @param array<mixed>        $body    Body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports
     */
    public function createExportUsers(
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$body, \Auth0\SDK\Exception\ArgumentException::missing('body')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('jobs', 'users-exports')
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a verification email job.
     * Required scope: `update:users`
     *
     * @param string              $userId  User ID of the user to send the verification email to.
     * @param array<mixed>|null   $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `userId` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email
     */
    public function createSendVerificationEmail(
        string $userId,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$userId] = Toolkit::filter([$userId])->string()->trim();
        [$body] = Toolkit::filter([$body])->array()->trim();

        Toolkit::assert([
            [$userId, \Auth0\SDK\Exception\ArgumentException::missing('userId')],
        ])->isString();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('jobs', 'verification-email')
            ->withBody(
                (object) Toolkit::merge([
                    'user_id' => $userId,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieves a job. Useful to check its status.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $id      Job (by it's ID) to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('jobs', $id)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve error details of a failed job.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $id      Job (by it's ID) to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `id` is provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Jobs/get_errors
     */
    public function getErrors(
        string $id,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$id] = Toolkit::filter([$id])->string()->trim();

        Toolkit::assert([
            [$id, \Auth0\SDK\Exception\ArgumentException::missing('id')],
        ])->isString();

        return $this->getHttpClient()
            ->method('get')
            ->addPath('jobs', $id, 'errors')
            ->withOptions($options)
            ->call();
    }
}
