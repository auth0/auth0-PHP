<?php

namespace Auth0\SDK\API\Management\Jobs\VerificationEmail;

use Auth0\SDK\API\Management\Jobs\VerificationEmail\Requests\CreateVerificationEmailRequestContent;
use Auth0\SDK\API\Management\Types\CreateVerificationEmailResponseContent;

interface VerificationEmailClientInterface
{
    /**
     * Send an email to the specified user that asks them to click a link to <a href="https://auth0.com/docs/email/custom#verification-email">verify their email address</a>.
     *
     * Note: You must have the `Status` toggle enabled for the verification email template for the email to be sent.
     *
     * @param CreateVerificationEmailRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateVerificationEmailResponseContent
     */
    public function create(CreateVerificationEmailRequestContent $request, ?array $options = null): ?CreateVerificationEmailResponseContent;
}
