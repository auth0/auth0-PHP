<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Auth0\SDK\Exception\EmptyOrInvalidParameterException;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Jobs.
 * Handles requests to the Jobs endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Jobs
 *
 * @package Auth0\SDK\API\Management
 */
class Jobs extends GenericResource
{
    /**
     * Retrieves a job. Useful to check its status.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $jobId   ID of the Job to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_jobs_by_id
     */
    public function get(
        string $jobId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('jobs', $jobId)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve error details of a failed job.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $jobId   Id of the Job to query.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/get_errors
     */
    public function getErrors(
        string $jobId,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('jobs', $jobId, 'errors')
            ->withOptions($options)
            ->call();
    }

    /**
     * Import users from a formatted file into a connection via a long-running job.
     * Required scopes:
     * - `create:users`
     * - `read:users`
     *
     * @param string              $filePath     Path to formatted file to import.
     * @param string              $connectionId Id of the Connection to use.
     * @param array               $query        Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_imports
     */
    public function importUsers(
        string $filePath,
        string $connectionId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $request = $this->apiClient->method('post', false)
            ->addPath('jobs', 'users-imports')
            ->addFile('users', $filePath)
            ->addFormParam('connection_id', $connectionId);

        foreach ($query as $key => $value) {
            $request->addFormParam($key, $value);
        }

        return $request->withOptions($options)
            ->call();
    }


    /**
     * Export all users to a file via a long-running job.
     * Required scope: `read:users`
     *
     * @param array               $query   Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_users_exports
     */
    public function exportUsers(
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('post')
            ->addPath('jobs', 'users-exports')
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create a verification email job.
     * Required scope: `update:users`
     *
     * @param string              $user_id User ID of the user to send the verification email to.
     * @param array               $query   Optional. Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws EmptyOrInvalidParameterException Thrown if any required parameters are empty or invalid.
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @return array|null
     *
     * @see https://auth0.com/docs/api/management/v2#!/Jobs/post_verification_email
     */
    public function sendVerificationEmail(
        string $userId,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'user_id' => $userId
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('jobs', 'verification-email')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }
}
