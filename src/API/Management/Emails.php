<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Helpers\Requests\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Emails.
 * Handles requests to the Emails endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Emails
 */
class Emails extends GenericResource
{
    /**
     * Create the email provider.
     * Required scope: `create:email_provider`
     *
     * @param string              $name        Name of the email provider to use.
     * @param array               $credentials Credentials required to use the provider. See @link for supported options.
     * @param array               $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/post_provider
     */
    public function createProvider(
        string $name,
        array $credentials,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($name, 'name');
        $this->validateArray($credentials, 'credentials');

        $payload = [
            'name' => $name,
            'credentials' => (object) $credentials,
        ] + $body;

        return $this->apiClient->method('post')
            ->addPath('emails', 'provider')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve email provider details.
     * Required scope: `read:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/get_provider
     */
    public function getProvider(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('get')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the email provider.
     * Required scope: `update:email_provider`
     *
     * @param string              $name        Name of the email provider to use.
     * @param array               $credentials Credentials required to use the provider. See @link for supported options.
     * @param array               $body        Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/patch_provider
     */
    public function updateProvider(
        string $name,
        array $credentials,
        array $body = [],
        ?RequestOptions $options = null
    ): ResponseInterface {
        $this->validateString($name, 'name');
        $this->validateArray($credentials, 'credentials');

        $payload = [
            'name' => $name,
            'credentials' => (object) $credentials,
        ] + $body;

        return $this->apiClient->method('patch')
            ->addPath('emails', 'provider')
            ->withBody((object) $payload)
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete the email provider.
     * Required scope: `delete:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When API request fails. Reason for failure provided in exception message.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/delete_provider
     */
    public function deleteProvider(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->apiClient->method('delete')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }
}
