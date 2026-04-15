<?php

namespace Auth0\SDK\API\Management\Users\Enrollments;

use Auth0\SDK\API\Management\Types\UsersEnrollment;

interface EnrollmentsClientInterface
{
    /**
     * Retrieve the first <a href="https://auth0.com/docs/secure/multi-factor-authentication/multi-factor-authentication-factors">multi-factor authentication</a> enrollment that a specific user has confirmed.
     *
     * @param string $id ID of the user to list enrollments for.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?array<UsersEnrollment>
     */
    public function get(string $id, ?array $options = null): ?array;
}
