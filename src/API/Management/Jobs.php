<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;

/**
 * Class Jobs.
 * Handles requests to the Jobs endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Jobs
 */
class Jobs extends GenericResource
{
    /**
     * Import users from a formatted file into a connection via a long-running job.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $filePath     Path to formatted file to import.
     * @param string              $connectionId Id of the Connection to use.
     * @param array               $parameters   Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports
     */
    public function createImportUsers(
        string $filePath,
        string $connectionId,
        array $parameters = [],
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($filePath, 'filePath');
        $this->validateString($connectionId, 'connectionId');

        $request = $this->apiClient->method('post', false)
            ->addPath('jobs', 'users-imports')
            ->addFile('users', $filePath)
            ->addFormParam('connection_id', $connectionId);

        foreach ($parameters as $key => $value) {
            $request->addFormParam($key, $value);
        }

        return $request->withOptions($options)
            ->call();
    }

    /**
     * Export all users to a file via a long-running job.
     * Required scope: `read:users`
     *
     * @param array               $body    Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports
     */
    public function createExportUsers(
        array $body = [],
        ?RequestOptions $options = null
    ): ?array {
        $this->validateArray($body, 'body');

        return $this->apiClient->method('post')
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
     * @param array               $body    Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email
     */
    public function createSendVerificationEmail(
        string $userId,
        array $body = [],
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($userId, 'userId');

        $payload = [
            'user_id' => $userId,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('jobs', 'verification-email')
            ->withBody((object) $payload)
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
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id
     */
    public function get(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
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
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_errors
     */
    public function getErrors(
        string $id,
        ?RequestOptions $options = null
    ): ?array {
        $this->validateString($id, 'id');

        return $this->apiClient->method('get')
            ->addPath('jobs', $id, 'errors')
            ->withOptions($options)
            ->call();
    }
}
