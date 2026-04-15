<?php

namespace Auth0\SDK\API\Management\EmailTemplates;

use Auth0\SDK\API\Management\EmailTemplates\Requests\CreateEmailTemplateRequestContent;
use Auth0\SDK\API\Management\Types\CreateEmailTemplateResponseContent;
use Auth0\SDK\API\Management\Types\EmailTemplateNameEnum;
use Auth0\SDK\API\Management\Types\GetEmailTemplateResponseContent;
use Auth0\SDK\API\Management\EmailTemplates\Requests\SetEmailTemplateRequestContent;
use Auth0\SDK\API\Management\Types\SetEmailTemplateResponseContent;
use Auth0\SDK\API\Management\EmailTemplates\Requests\UpdateEmailTemplateRequestContent;
use Auth0\SDK\API\Management\Types\UpdateEmailTemplateResponseContent;

interface EmailTemplatesClientInterface
{
    /**
     * Create an email template.
     *
     * @param CreateEmailTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEmailTemplateResponseContent
     */
    public function create(CreateEmailTemplateRequestContent $request, ?array $options = null): ?CreateEmailTemplateResponseContent;

    /**
     * Retrieve an email template by pre-defined name. These names are `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, and `async_approval`. The names `change_password`, and `password_reset` are also supported for legacy scenarios.
     *
     * @param value-of<EmailTemplateNameEnum> $templateName Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEmailTemplateResponseContent
     */
    public function get(string $templateName, ?array $options = null): ?GetEmailTemplateResponseContent;

    /**
     * Update an email template.
     *
     * @param value-of<EmailTemplateNameEnum> $templateName Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
     * @param SetEmailTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?SetEmailTemplateResponseContent
     */
    public function set(string $templateName, SetEmailTemplateRequestContent $request, ?array $options = null): ?SetEmailTemplateResponseContent;

    /**
     * Modify an email template.
     *
     * @param value-of<EmailTemplateNameEnum> $templateName Template name. Can be `verify_email`, `verify_email_by_code`, `reset_email`, `reset_email_by_code`, `welcome_email`, `blocked_account`, `stolen_credentials`, `enrollment_email`, `mfa_oob_code`, `user_invitation`, `async_approval`, `change_password` (legacy), or `password_reset` (legacy).
     * @param UpdateEmailTemplateRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateEmailTemplateResponseContent
     */
    public function update(string $templateName, UpdateEmailTemplateRequestContent $request = new UpdateEmailTemplateRequestContent(), ?array $options = null): ?UpdateEmailTemplateResponseContent;
}
