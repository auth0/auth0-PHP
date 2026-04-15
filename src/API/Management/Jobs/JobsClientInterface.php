<?php

namespace Auth0\SDK\API\Management\Jobs;

use Auth0\SDK\API\Management\Types\GetJobResponseContent;
use Auth0\SDK\API\Management\Jobs\UsersExports\UsersExportsClientInterface;
use Auth0\SDK\API\Management\Jobs\UsersImports\UsersImportsClientInterface;
use Auth0\SDK\API\Management\Jobs\VerificationEmail\VerificationEmailClientInterface;
use Auth0\SDK\API\Management\Jobs\Errors\ErrorsClientInterface;

interface JobsClientInterface
{
    /**
     * Retrieves a job. Useful to check its status.
     *
     * @param string $id ID of the job.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetJobResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetJobResponseContent;

    /**
     * @return UsersExportsClientInterface
     */
    public function getUsersExports(): UsersExportsClientInterface;

    /**
     * @return UsersImportsClientInterface
     */
    public function getUsersImports(): UsersImportsClientInterface;

    /**
     * @return VerificationEmailClientInterface
     */
    public function getVerificationEmail(): VerificationEmailClientInterface;

    /**
     * @return ErrorsClientInterface
     */
    public function getErrors(): ErrorsClientInterface;
}
