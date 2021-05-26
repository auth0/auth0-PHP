<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class EmailTemplates.
 * Handles requests to the Email Templates endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Email_Templates
 */
final class EmailTemplates extends ManagementEndpoint
{
    /**
     * Create an email template by name.
     * See docs @link below for valid names and fields.
     * Required scope: `create:email_templates`
     *
     * @param string              $template   The template name. See the @link for a list of templates available.
     * @param string              $body       Body of the email template.
     * @param string              $from       Senders from email address.
     * @param string              $subject    Subject line of the email.
     * @param string              $syntax     Syntax of the template body.
     * @param bool                $enabled    Whether the template is enabled (true) or disabled (false).
     * @param array               $additional Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options    Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/post_email_templates
     */
    public function create(
        string $template,
        string $body,
        string $from,
        string $subject,
        string $syntax,
        bool $enabled,
        array $additional = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($template, 'template');
        $this->validateString($body, 'body');
        $this->validateString($from, 'from');
        $this->validateString($subject, 'subject');
        $this->validateString($syntax, 'syntax');

        $payload = [
            'template' => $template,
            'body' => $body,
            'from' => $from,
            'subject' => $subject,
            'syntax' => $syntax,
            'enabled' => $enabled,
        ] + $additional;

        return $this->apiClient->method('post')
            ->addPath('email-templates')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Get an email template by name.
     * See docs @link below for valid names and fields.
     * Required scope: `read:email_templates`
     *
     * @param string              $templateName The email template name. See the @link for a list of templates available.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/get_email_templates_by_templateName
     */
    public function get(
        string $templateName,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($templateName, 'templateName');

        return $this->apiClient->method('get')
            ->addPath('email-templates', $templateName)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update an email template by name.
     * This will replace the email template data.
     * See docs @link below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`
     *
     * @param string              $templateName The email template name. See the @link for a list of templates available.
     * @param array               $body         Replace existing template with this data.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function update(
        string $templateName,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($templateName, 'templateName');
        $this->validateArray($body, 'body');

        return $this->apiClient->method('put')
            ->addPath('email-templates', $templateName)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }

    /**
     * Patch an email template by name.
     * This will update only the email template data fields provided (see HTTP PATCH).
     * See docs @link below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`
     *
     * @param string              $templateName The email template name. See the @link for a list of templates available.
     * @param array               $body         Update existing template fields with this data.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function patch(
        string $templateName,
        array $body,
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($templateName, 'templateName');
        $this->validateArray($body, 'body');

        return $this->apiClient->method('patch')
            ->addPath('email-templates', $templateName)
            ->withBody((object) $body)
            ->withOptions($options)
            ->call();
    }
}
