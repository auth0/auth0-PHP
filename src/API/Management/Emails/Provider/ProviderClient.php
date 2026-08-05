<?php

namespace Auth0\SDK\API\Management\Emails\Provider;

use Psr\Http\Client\ClientInterface;
use Auth0\SDK\API\Management\Core\Client\RawClient;
use Auth0\SDK\API\Management\Emails\Provider\Requests\GetEmailProviderRequestParameters;
use Auth0\SDK\API\Management\Types\GetEmailProviderResponseContent;
use Auth0\SDK\API\Management\Exceptions\Auth0Exception;
use Auth0\SDK\API\Management\Exceptions\Auth0ApiException;
use Auth0\SDK\API\Management\Core\Json\JsonApiRequest;
use Auth0\SDK\API\Management\Environments;
use Auth0\SDK\API\Management\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Auth0\SDK\API\Management\Emails\Provider\Requests\CreateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\CreateEmailProviderResponseContent;
use Auth0\SDK\API\Management\Emails\Provider\Requests\UpdateEmailProviderRequestContent;
use Auth0\SDK\API\Management\Types\UpdateEmailProviderResponseContent;

class ProviderClient implements ProviderClientInterface
{
    /**
     * @var array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options @phpstan-ignore-next-line Property is used in endpoint methods via HttpEndpointGenerator
     */
    private array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        RawClient $client,
        ?array $options = null,
    ) {
        $this->client = $client;
        $this->options = $options ?? [];
    }

    /**
     * Retrieve details of the [email provider configuration](https://auth0.com/docs/customize/email/smtp-email-providers) in your tenant. A list of fields to include or exclude may also be specified.
     *
     * Example:
     * ```php
     * $client->emails->provider->get(
     *     new GetEmailProviderRequestParameters([
     *         'fields' => 'fields',
     *         'includeFields' => true,
     *     ]),
     * );
     * ```
     *
     * @param GetEmailProviderRequestParameters $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?GetEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function get(GetEmailProviderRequestParameters $request = new GetEmailProviderRequestParameters(), ?array $options = null): ?GetEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        $query = [];
        if ($request->getFields() != null) {
            $query['fields'] = $request->getFields();
        }
        if ($request->getIncludeFields() != null) {
            $query['include_fields'] = $request->getIncludeFields();
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
                    method: HttpMethod::GET,
                    query: $query,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return GetEmailProviderResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Create an [email provider](https://auth0.com/docs/email/providers). The `credentials` object
     * requires different properties depending on the email provider (which is specified using the `name` property):
     *
     * - `mandrill` requires `api_key`
     * - `sendgrid` requires `api_key`
     * - `sparkpost` requires `api_key`. Optionally, set `region` to `eu` to use
     *     the SparkPost service hosted in Western Europe; set to `null` to use the SparkPost service hosted in
     *     North America. `eu` or `null` are the only valid values for `region`.
     * - `mailgun` requires `api_key` and `domain`. Optionally, set `region` to
     *     `eu` to use the Mailgun service hosted in Europe; set to `null` otherwise. `eu` or
     *     `null` are the only valid values for `region`.
     * - `ses` requires `accessKeyId`, `secretAccessKey`, and `region`
     * - `smtp` requires `smtp_host`, `smtp_port`, `smtp_user`, and
     *     `smtp_pass`
     *
     * Depending on the type of provider it is possible to specify `settings` object with different configuration
     * options, which will be used when sending an email:
     *
     * - `smtp` provider, `settings` may contain `headers` object.
     *     - When using AWS SES SMTP host, you may provide a name of configuration set in
     *       `X-SES-Configuration-Set` header. Value must be a string.
     *     - When using Sparkpost host, you may provide value for
     *       `X-MSYS_API` header. Value must be an object.
     * - For `ses` provider, `settings` may contain `message` object, where you can provide
     *   a name of configuration set in `configuration_set_name` property. Value must be a string.
     *
     * Example:
     * ```php
     * $client->emails->provider->create(
     *     new CreateEmailProviderRequestContent([
     *         'name' => EmailProviderNameEnum::Mailgun->value,
     *         'credentials' => new EmailProviderCredentialsSchemaZero([
     *             'apiKey' => 'api_key',
     *         ]),
     *     ]),
     * );
     * ```
     *
     * @param CreateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?CreateEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function create(CreateEmailProviderRequestContent $request, ?array $options = null): ?CreateEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
                    method: HttpMethod::POST,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return CreateEmailProviderResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Delete the email provider.
     *
     * Example:
     * ```php
     * $client->emails->provider->delete();
     * ```
     *
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function delete(?array $options = null): void
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
                    method: HttpMethod::DELETE,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Update an [email provider](https://auth0.com/docs/email/providers). The `credentials` object
     * requires different properties depending on the email provider (which is specified using the `name` property):
     *
     * - `mandrill` requires `api_key`
     * - `sendgrid` requires `api_key`
     * - `sparkpost` requires `api_key`. Optionally, set `region` to `eu` to use
     *     the SparkPost service hosted in Western Europe; set to `null` to use the SparkPost service hosted in
     *     North America. `eu` or `null` are the only valid values for `region`.
     * - `mailgun` requires `api_key` and `domain`. Optionally, set `region` to
     *     `eu` to use the Mailgun service hosted in Europe; set to `null` otherwise. `eu` or
     *     `null` are the only valid values for `region`.
     * - `ses` requires `accessKeyId`, `secretAccessKey`, and `region`
     * - `smtp` requires `smtp_host`, `smtp_port`, `smtp_user`, and
     *     `smtp_pass`
     *
     * Depending on the type of provider it is possible to specify `settings` object with different configuration
     * options, which will be used when sending an email:
     *
     * - `smtp` provider, `settings` may contain `headers` object.
     *     - When using AWS SES SMTP host, you may provide a name of configuration set in
     *       `X-SES-Configuration-Set` header. Value must be a string.
     *     - When using Sparkpost host, you may provide value for
     *       `X-MSYS_API` header. Value must be an object.
     *
     *   For `ses` provider, `settings` may contain `message` object, where you can provide
     *   a name of configuration set in `configuration_set_name` property. Value must be a string.
     *
     * Example:
     * ```php
     * $client->emails->provider->update(
     *     new UpdateEmailProviderRequestContent([]),
     * );
     * ```
     *
     * @param UpdateEmailProviderRequestContent $request
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?UpdateEmailProviderResponseContent
     * @throws Auth0Exception
     * @throws Auth0ApiException
     */
    public function update(UpdateEmailProviderRequestContent $request = new UpdateEmailProviderRequestContent(), ?array $options = null): ?UpdateEmailProviderResponseContent
    {
        $options = array_merge($this->options, $options ?? []);
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Default_->value,
                    path: "emails/provider",
                    method: HttpMethod::PATCH,
                    body: $request,
                ),
                $options,
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                if (empty($json)) {
                    return null;
                }
                return UpdateEmailProviderResponseContent::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new Auth0Exception(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new Auth0Exception(message: $e->getMessage(), previous: $e);
        }
        throw new Auth0ApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
