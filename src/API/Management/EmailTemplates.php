<?php
/**
 * @package Auth0\SDK\API\Management
 */
namespace Auth0\SDK\API\Management;

/**
 * Class EmailTemplates.
 * Handles requests to the Email Templates endpoint of the v2 Management API.
 *
 * @package Auth0\SDK\API\Management\EmailTemplates
 */
class EmailTemplates extends GenericResource
{
    /**
     * Get an email template by name.
     * The email template needs to already exist or the response will be a 404.
     * An invalid template name will respond with a 400.
     * See docs @link below for valid names and fields.
     *
     * @param string $templateName - the email template name to get.
     *
     * @return array
     *
     * @throws \Exception - if a 200 response was not returned from the API.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/get_email_templates_by_templateName
     */
    public function get($templateName)
    {
        return $this->apiClient->method('get')
            ->addPath('email-templates', $templateName)
            ->call();
    }

    /**
     * Patch an email template by name.
     * This will update only the email template data fields provided (see HTTP PATCH).
     * See docs @link below for valid names and fields.
     *
     * @param string $templateName - the email template name to patch.
     * @param array $data - an array of data to update.
     *
     * @return array - updated data for the template name provided.
     *
     * @throws \Exception - if a 200 response was not returned from the API.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/patch_email_templates_by_templateName
     */
    public function patch($templateName, $data)
    {
        return $this->apiClient->method('patch')
            ->addPath('email-templates', $templateName)
            ->withBody(json_encode($data))
            ->call();
    }

    /**
     * Create an email template by name.
     * See docs @link below for valid names and fields.
     *
     * @param array $data - an array of data to use for the new email, including a valid template name.
     *
     * @return mixed|string
     *
     * @throws \Exception - if a 200 response was not returned from the API.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Email_Templates/post_email_templates
     */
    public function create($data)
    {
        return $this->apiClient->method('post')
            ->addPath('email-templates')
            ->withBody(json_encode($data))
            ->call();
    }
}