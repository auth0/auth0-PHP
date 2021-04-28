<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class EmailTemplates.
 * Handles requests to the Email Templates endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Email_Templates
 *
 * @package Auth0\SDK\API\Management
 */
class EmailTemplates extends GenericResource
{
    /**
     * Get an email template by name.
     * See docs @link below for valid names and fields.
     * Required scope: `read:email_templates`
     *
     * @param string              $templateName The email template name.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/get_email_templates_by_templateName
     */
    public function get(
        string $templateName,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('email-templates', $templateName)
            ->withOptions($options)
            ->call();
    }

    /**
     * Patch an email template by name.
     * This will update only the email template data fields provided (see HTTP PATCH).
     * See docs @link below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`
     *
     * @param string              $templateName The email template name.
     * @param array               $query        Update existing template fields with this data.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function patch(
        string $templateName,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('patch')
            ->addPath('email-templates', $templateName)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update an email template by name.
     * This will replace the email template data.
     * See docs @link below for valid names, fields, and possible responses.
     * Required scope: `update:email_templates`
     *
     * @param string              $templateName The email template name.
     * @param array               $query        Replace existing template with this data.
     * @param RequestOptions|null $options      Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function update(
        string $templateName,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('put')
            ->addPath('email-templates', $templateName)
            ->withBody($query)
            ->withOptions($options)
            ->call();
    }

    /**
     * Create an email template by name.
     * See docs @link below for valid names and fields.
     * Required scope: `create:email_templates`
     *
     * @param string              $template The template name.
     * @param array               $query    Body of the request to send.
     * @param RequestOptions|null $options  Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/post_email_templates
     */
    public function create(
        string $templateName,
        array $query,
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'template' => $templateName
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('email-templates')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }
}
