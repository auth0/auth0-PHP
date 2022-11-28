<?php

declare(strict_types=1);

namespace Auth0\SDK\Contract\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface EmailTemplatesInterface.
 */
interface EmailTemplatesInterface
{
    /**
     * Create an email template by name.
     * See docs @see below for valid names and fields.
     * Required scope: `create:email_templates`.
     *
     * @param  string  $template  The template name. See the @see for a list of templates available.
     * @param  string  $body  body of the email template
     * @param  string  $from  senders from email address
     * @param  string  $subject  subject line of the email
     * @param  string  $syntax  syntax of the template body
     * @param  bool  $enabled  whether the template is enabled (true) or disabled (false)
     * @param  array<string>|null  $additional  Additional body content to pass with the API request. See @see for supported options.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `template`, `body`, `from`, `subject`, or `syntax` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Email_Templates/post_email_templates
     */
    public function create(
        string $template,
        string $body,
        string $from,
        string $subject,
        string $syntax,
        bool $enabled,
        ?array $additional = null,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Get an email template by name.
     * See docs @see below for valid names and fields.
     * Required scope: `read:email_templates`.
     *
     * @param  string  $templateName  The email template name. See the @see for a list of templates available.
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `templateName` is provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Email_Templates/get_email_templates_by_templateName
     */
    public function get(
        string $templateName,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Update an email template by name.
     * This will replace the email template data.
     * See docs @see below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`.
     *
     * @param  string  $templateName  The email template name. See the @see for a list of templates available.
     * @param  array<mixed>  $body  replace existing template with this data
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `templateName` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Email_Templates/put_email_templates_by_templateName
     */
    public function update(
        string $templateName,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;

    /**
     * Patch an email template by name.
     * This will update only the email template data fields provided (see HTTP PATCH).
     * See docs @see below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`.
     *
     * @param  string  $templateName  The email template name. See the @see for a list of templates available.
     * @param  array<mixed>  $body  update existing template fields with this data
     * @param  RequestOptions|null  $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @see for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException when an invalid `templateName` or `body` are provided
     * @throws \Auth0\SDK\Exception\NetworkException when the API request fails due to a network error
     *
     * @see https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function patch(
        string $templateName,
        array $body,
        ?RequestOptions $options = null,
    ): ResponseInterface;
}
