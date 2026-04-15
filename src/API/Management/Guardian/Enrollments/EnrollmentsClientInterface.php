<?php

namespace Auth0\SDK\API\Management\Guardian\Enrollments;

use Auth0\SDK\API\Management\Guardian\Enrollments\Requests\CreateGuardianEnrollmentTicketRequestContent;
use Auth0\SDK\API\Management\Types\CreateGuardianEnrollmentTicketResponseContent;
use Auth0\SDK\API\Management\Types\GetGuardianEnrollmentResponseContent;

interface EnrollmentsClientInterface
{
    /**
     * Create a <a href="https://auth0.com/docs/secure/multi-factor-authentication/auth0-guardian/create-custom-enrollment-tickets">multi-factor authentication (MFA) enrollment ticket</a>, and optionally send an email with the created ticket, to a given user.
     * Create a <a href="https://auth0.com/docs/secure/multi-factor-authentication/auth0-guardian/create-custom-enrollment-tickets">multi-factor authentication (MFA) enrollment ticket</a>, and optionally send an email with the created ticket to a given user. Enrollment tickets can specify which factor users must enroll with or allow existing MFA users to enroll in additional factors.<br/>
     *
     * Note: Users cannot enroll in Email as a factor through custom enrollment tickets.
     *
     * @param CreateGuardianEnrollmentTicketRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateGuardianEnrollmentTicketResponseContent
     */
    public function createTicket(CreateGuardianEnrollmentTicketRequestContent $request, ?array $options = null): ?CreateGuardianEnrollmentTicketResponseContent;

    /**
     * Retrieve details, such as status and type, for a specific multi-factor authentication enrollment registered to a user account.
     *
     * @param string $id ID of the enrollment to be retrieve.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetGuardianEnrollmentResponseContent
     */
    public function get(string $id, ?array $options = null): ?GetGuardianEnrollmentResponseContent;

    /**
     * Remove a specific multi-factor authentication (MFA) enrollment from a user's account. This allows the user to re-enroll with MFA. For more information, review <a href="https://auth0.com/docs/secure/multi-factor-authentication/reset-user-mfa">Reset User Multi-Factor Authentication and Recovery Codes</a>.
     *
     * @param string $id ID of the enrollment to be deleted.
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     */
    public function delete(string $id, ?array $options = null): void;
}
