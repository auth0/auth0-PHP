<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use GuzzleHttp\Exception\RequestException;

/**
 * Class Emails.
 * Handles requests to the Emails endpoint of the v2 Management API.
 *
 * https://auth0.com/docs/api/management/v2#!/Emails
 *
 * @package Auth0\SDK\API\Management
 */
class Emails extends GenericResource
{
    /**
     * Retrieve email provider details.
     * Required scope: `read:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/get_provider
     */
    public function getProvider(
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('get')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }

    /**
     * Create the email provider.
     * Required scope: `create:email_provider`
     *
     * @param string              $name    Name of the email provider to use.
     * @param array               $query   Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/post_provider
     */
    public function configureProvider(
        string $name,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'name' => $name
        ] + $query;

        return $this->apiClient->method('post')
            ->addPath('emails', 'provider')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the email provider.
     * Required scope: `update:email_provider`
     *
     * @param string              $name    Name of the email provider to use.
     * @param array               $query   Additional query parameters to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/patch_provider
     */
    public function updateProvider(
        string $name,
        array $query = [],
        ?RequestOptions $options = null
    ): ?array {
        $payload = [
            'name' => $name
        ] + $query;

        return $this->apiClient->method('patch')
            ->addPath('emails', 'provider')
            ->withBody($payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete the email provider.
     * Required scope: `delete:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @return array|null
     *
     * @throws RequestException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/delete_provider
     */
    public function deleteProvider(
        ?RequestOptions $options = null
    ): ?array {
        return $this->apiClient->method('delete')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }
}
