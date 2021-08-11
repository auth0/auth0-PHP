<?php

declare(strict_types=1);

namespace Auth0\SDK\API\Management;

use Auth0\SDK\Utility\Request\RequestOptions;
use Auth0\SDK\Utility\Toolkit;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Emails.
 * Handles requests to the Emails endpoint of the v2 Management API.
 *
 * @link https://auth0.com/docs/api/management/v2#!/Emails
 */
final class Emails extends ManagementEndpoint
{
    /**
     * Create the email provider.
     * Required scope: `create:email_provider`
     *
     * @param string              $name        Name of the email provider to use.
     * @param array<string>       $credentials Credentials required to use the provider. See @link for supported options.
     * @param array<mixed>|null   $body        Optional. Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` or `credentials` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException  When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/post_provider
     */
    public function createProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$credentials, $body] = Toolkit::filter([$credentials, $body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        Toolkit::assert([
            [$credentials, \Auth0\SDK\Exception\ArgumentException::missing('credentials')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('post')
            ->addPath('emails', 'provider')
            ->withBody(
                (object) Toolkit::merge([
                    'name' => $name,
                    'credentials' => (object) $credentials,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Retrieve email provider details.
     * Required scope: `read:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/get_provider
     */
    public function getProvider(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('get')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }

    /**
     * Update the email provider.
     * Required scope: `update:email_provider`
     *
     * @param string              $name        Name of the email provider to use.
     * @param array<string>       $credentials Credentials required to use the provider. See @link for supported options.
     * @param array<mixed>|null   $body        Additional body content to pass with the API request. See @link for supported options.
     * @param RequestOptions|null $options     Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\ArgumentException When an invalid `name` or `credentials` are provided.
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/patch_provider
     */
    public function updateProvider(
        string $name,
        array $credentials,
        ?array $body = null,
        ?RequestOptions $options = null
    ): ResponseInterface {
        [$name] = Toolkit::filter([$name])->string()->trim();
        [$credentials, $body] = Toolkit::filter([$credentials, $body])->array()->trim();

        Toolkit::assert([
            [$name, \Auth0\SDK\Exception\ArgumentException::missing('name')],
        ])->isString();

        Toolkit::assert([
            [$credentials, \Auth0\SDK\Exception\ArgumentException::missing('credentials')],
        ])->isArray();

        return $this->getHttpClient()
            ->method('patch')
            ->addPath('emails', 'provider')
            ->withBody(
                (object) Toolkit::merge([
                    'name' => $name,
                    'credentials' => (object) $credentials,
                ], $body)
            )
            ->withOptions($options)
            ->call();
    }

    /**
     * Delete the email provider.
     * Required scope: `delete:email_provider`
     *
     * @param RequestOptions|null $options Optional. Additional request options to use, such as a field filtering or pagination. (Not all endpoints support these. See @link for supported options.)
     *
     * @throws \Auth0\SDK\Exception\NetworkException When the API request fails due to a network error.
     *
     * @link https://auth0.com/docs/api/management/v2#!/Emails/delete_provider
     */
    public function deleteProvider(
        ?RequestOptions $options = null
    ): ResponseInterface {
        return $this->getHttpClient()
            ->method('delete')
            ->addPath('emails', 'provider')
            ->withOptions($options)
            ->call();
    }
}
